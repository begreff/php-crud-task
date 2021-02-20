<?php

namespace src\objects;

class Project
{
    // database connection and table
    private $db_conn;

    // project properties
    public $id;
    public $title;
    public $numOfGroups;
    public $studentsPerGroup;

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

    public function create($parameters)
    {
        $sql = "INSERT INTO projects (title, num_groups, students_per_group)
                VALUES (:title, :num_groups, :students_per_group)";
        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute(array(
                'title' => $parameters['title'],
                'num_groups' => $parameters['num_groups'],
                'students_per_group' => $parameters['students_per_group'],
            ));
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    public function update($id, $parameters)
    {
        $columns = array();

        foreach($parameters as $column => $value)
        {
            $columns[] = "$column = '$value'";
        }

        $sql = "UPDATE projects SET" . implode(', ', $columns) . "WHERE ?";

        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute(array($id));
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM projects WHERE id = ?";

        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute(array($id));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
