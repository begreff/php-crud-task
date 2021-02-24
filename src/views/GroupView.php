<?php

namespace src\views;

use src\models\GroupRepository;

class GroupView
{
    private GroupRepository $repo;

    public function __construct(GroupRepository $repo)
    {
        $this->repo = $repo;
    }

    /*
     * Displays a list of all groups on the project.
     */
    public function list($project)
    {
        $students = $this->repo->all($project['id']);
        $unassignedStudents = $this->filterUnassigned($students);

        $output = "<div class='row'>";

        // Display all groups.
        for ($groupNumber = 1; $groupNumber <= $project['num_groups']; $groupNumber++) {
            // Filter group members.
            $groupStudents = $this->filterGroupMembers($students, $groupNumber);
            $emptySlots = $project['students_per_group'] - count($groupStudents);

            // Display table header.
            $output .= "
            <div class='col-sm'>
                <table class='table table-bordered'>
                <thead class='thead-light'>
                    <tr>
                        <th>";

            // Display table title.
            if ($emptySlots == 0) {
                $output .= "Group ".$groupNumber." - FULL";
            } else {
                $output .= "Group ".$groupNumber;
            }

            $output .= "</th>
                </tr>
            </thead>
            <tbody>";

            // List students that have been assigned to this group.
            $output .= $this->listAssigned($groupStudents);

            // Display a dropdown of students that have not been assigned yet.
            for ($i = 0; $i < $emptySlots; $i++) {
                $output .=
                    "<tr><td>"
                        .$this->dropdown($unassignedStudents, $groupNumber)
                    ."</td></tr>";
            }

            $output .= "</tbody></table></div>";
        }

        $output .= "</div>";
        echo $output;
    }

    private function listAssigned($students)
    {
        $output = "";
        foreach ($students as $student) {
            $output .=
                "<tr><td>"
                .$student['firstname']." ".$student['lastname']
                ."</td></tr>";
        }
        return $output;
    }

    /*
     * Displays a dropdown with unassigned students.
     */
    private function dropdown($students, $groupNumber)
    {
        // Display a dropdown form.
        $output = "
        <form action='src/actions/update_group_action.php?group_number={$groupNumber}' method='post'>
            <select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>
                <option value=''>Assign student</option>";

        // Display an option for every unassigned student.
        foreach ($students as $student) {
            $output .=
                "<option value=".$student['id'].">"
                    .$student['firstname']." ".$student['lastname']
                ."</option>";
        }

        $output .= "</select></form>";

        return $output;
    }

    /*
     * Filters students that have not been assigned to a group.
     */
    private function filterUnassigned($students)
    {
        return array_filter($students, function ($student) {
            return $student['group_number'] == null;
        });
    }

    /*
     * Filters students that have been assigned to a specific group.
     */
    private function filterGroupMembers($students, $groupNumber)
    {
        return array_filter($students, function ($student) use ($groupNumber) {
            return $student['group_number'] == $groupNumber;
        });
    }
}
