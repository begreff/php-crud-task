<?php

namespace src;

class GroupRepository
{
    private $db_conn;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    public function all($projectID)
    {
        $sql = "SELECT p.id AS project_id, s.group_number, s.firstname, 
                    s.lastname
                FROM student_groups g
                INNER JOIN students s ON g.project_id = s.project_id 
                    AND s.group_number = g.group_number
                INNER JOIN projects p on s.project_id = p.id
                WHERE s.project_id = ?";
        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
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

    public function count($projectID)
    {
        $sql = "SELECT p.id AS project,
                       p.students_per_group AS capacity,
                       count(s.id) AS count, s.group_number
                FROM students s 
                INNER JOIN projects p on s.project_id = p.id
                WHERE s.project_id = ?
                    AND s.group_number IS NOT NULL
                GROUP BY s.group_number";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
