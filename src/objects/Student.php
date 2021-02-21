<?php

namespace src\objects;

class Student
{
    // database connection and table
    private $db_conn;

    // project properties
    public $firstname;
    public $lastname;
    public $group_number;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    function all()
    {
        $sql = "SELECT * FROM students";
        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function create($firstname, $lastname, $project_id)
    {
        $sql = "INSERT INTO students (firstname, lastname, project_id) 
                VALUES (:firstname, :lastname, :project_id)";

        try {
            $stmt = $this->db_conn->prepare($sql);
            return $stmt->execute(array(
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':project_id' => $project_id
            ));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function read($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($id));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function update($id, $group_number)
    {
        $sql = "UPDATE students 
                SET group_number = :group_number
                WHERE id = :id";
        try {
            $statement = $this->db_conn->prepare($sql);
            return $statement->execute(array(
                ':id' => $id,
                ':group_number' => $group_number
            ));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function delete($id)
    {
        $sql = "DELETE FROM students WHERE id = ?";
        try {
            $stmt = $this->db_conn->prepare($sql);
            return $stmt->execute(array($id));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}

