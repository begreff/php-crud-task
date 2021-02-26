<?php

namespace src\models;

class ProjectRepository
{
    private $db_conn;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    /*
     * Retrieves all projects.
     */
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

    /*
     * Adds a project to the projects table.
     */
    public function create($title, $numGroups, $studentsPerGroup)
    {
        $sql = "INSERT INTO projects (title, num_groups, students_per_group)
                VALUES (:title, :num_groups, :students_per_group)";
        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($title, $numGroups, $studentsPerGroup));
            return $this->db_conn->lastInsertID();
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Retrieves a specific project from the database.
     */
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
