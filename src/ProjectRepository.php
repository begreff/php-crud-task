<?php

namespace src;

class ProjectRepository
{
    private $db_conn;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    public function all()
    {
        $sql = "SELECT * FROM projects";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function create($parameters)
    {
        $sql = "INSERT INTO projects (title, num_groups, students_per_group)
                VALUES (:title, :num_groups, :students_per_group)";
        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array(
                'title' => $parameters['title'],
                'num_groups' => $parameters['num_groups'],
                'students_per_group' => $parameters['students_per_group'],
            ));
            return $this->db_conn->lastInsertID();
        } catch (\Exception $e) {
            print_r($e->getMessage());
            return null;
        }
    }

    public function read($id)
    {
        $sql = "SELECT * FROM projects WHERE id = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($id));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
