<?php

namespace src;

class GroupRepository
{
    private $db_conn;

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

    public function all($projectID, $groupNumber)
    {
        $sql = "SELECT id, firstname, lastname, group_number 
            FROM students
            WHERE project_id = ? AND group_number = ?
            ORDER BY id";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID, $groupNumber));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function unassigned($projectID)
    {
        $sql = "SELECT id, firstname, lastname, group_number 
            FROM students
            WHERE project_id = ? AND group_number IS NULL
            ORDER BY id";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function projectInfo($projectID)
    {
        $sql = "SELECT id, num_groups AS total, students_per_group AS capacity
                FROM projects
                WHERE id = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
