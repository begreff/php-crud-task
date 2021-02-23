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

    /*
     * Retrieves all group info from the database.
     */
    public function all($projectID)
    {
        $sql = "SELECT id, firstname, lastname, group_number 
            FROM students
            WHERE project_id = ?
            ORDER BY id";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($projectID));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
