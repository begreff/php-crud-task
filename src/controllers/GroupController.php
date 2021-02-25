<?php

namespace src\controllers;

use src\models\GroupRepository;

class GroupController
{
    private GroupRepository $repo;

    public function __construct(GroupRepository $repo)
    {
        $this->repo = $repo;
    }

    /*
     * Returns a collection of groups and their members.
     */
    public function all($projectID)
    {
        $collection = [];
        $groups = $this->repo->all($projectID);
        $students = $this->repo->students($projectID);

        foreach ($groups as $group) {
            // Add group members to the collection.
            $groupMembers = $this->findMembers($students, $group['number']);
            $collection[$group['number']]['members'] = $groupMembers;

            // Add the spaces left in the group to the collection.
            $spacesAvailable = $group['capacity'] - count($groupMembers);
            $collection[$group['number']]['spacesAvailable'] = $spacesAvailable;
        }

        $unassigned = $this->findMembers($students, null);

        require __DIR__ . '/../../views/group/list.php';
    }

    /*
     * Filters the students array to find group members.
     */
    private function findMembers($students, $groupNumber)
    {
        return array_filter($students, function ($student) use ($groupNumber) {
            return $student['group_number'] == $groupNumber;
        });
    }
}
