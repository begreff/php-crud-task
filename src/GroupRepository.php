<?php

namespace src;

class GroupRepository
{
    // database connection and table
    private $db_conn;

    // project properties
    public $id;
    public $project_id;
    public $group_number;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    public function create($parameters)
    {
        $sql = "INSERT INTO student_groups (project_id, group_number)
                VALUES (:project_id, :group_number)";
        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute(array(
                'project_id' => $parameters['project_id'],
                'group_number' => $parameters['group_number'],
            ));
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function all($project_id)
    {
        $data = [];
        $groups = $this->getAllGroups($project_id);
        foreach ($groups as $group) {
            $groupMembers = $this->getGroupMembers($project_id, $group['group_number']);
            $data[$group['group_number']] = $groupMembers;
        }
        return $data;
    }

    private function getAllGroups($project_id): array
    {
        $sql = "SELECT project_id, group_number  
                FROM student_groups
                WHERE project_id = ? ";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($project_id));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    private function getGroupMembers($projectID, $groupNumber): array
    {
        $sql = "SELECT student_groups.group_number, students.firstname, students.lastname  
                FROM student_groups
                INNER JOIN students 
                    ON student_groups.project_id = students.project_id AND student_groups.group_number = students.group_number
                WHERE student_groups.project_id = ? AND student_groups.group_number = ? ";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID, $groupNumber));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
