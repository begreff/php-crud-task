<?php

namespace src\objects;

class Group
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

    public function all($project_id)
    {
        $sql = "SELECT * FROM student_groups WHERE project_id = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($project_id));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function read($project_id, $group_number)
    {
        $sql = "SELECT * FROM student_groups WHERE project_id = ? AND group_number = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($project_id, $group_number));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
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
            print_r($e->getMessage());
        }
    }



}
