<?php

namespace src\models;

class GroupRepository
{
    private $db_conn;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    /*
     * Adds a group to the student_groups table.
     */
    public function create($projectID, $groupNumber)
    {
        $sql = "INSERT INTO student_groups (project_id, group_number)
                VALUES (:project_id, :group_number)";
        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute(array($projectID, $groupNumber));
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Retrieves all group numbers and their capacity from the database.
     */
    public function all($projectID)
    {
        $sql = "SELECT s.group_number AS number, 
                       p.students_per_group AS capacity
                FROM student_groups s 
                INNER JOIN projects p on s.project_id = p.id
                WHERE project_id = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Retrieves students on a project from the database.
     */
    public function students($projectID)
    {
        $sql = "SELECT id, firstname, lastname, group_number
                FROM students 
                WHERE project_id = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
