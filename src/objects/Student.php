<?php

namespace src\objects;

class Student
{
    // database connection and table
    private $db_conn;

    // project properties
    public $firstname;
    public $lastname;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    function all($project_id)
    {
        $sql= "SELECT * FROM students WHERE project_id = ?";
        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute(array($project_id));
            return $statement->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function create()
    {
        $sql = "INSERT INTO students (firstname, lastname, project_id) 
                VALUES (:firstname, :lastname, :project_id)";

        try {
            $stmt = $this->db_conn->prepare($sql);
            return $stmt->execute(array(
                ':firstname' => $_POST['firstname'],
                ':lastname' => $_POST['lastname'],
                ':project_id' => $_POST['project_id']
            ));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    function read($id)
    {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->db_conn->prepare($sql);
        $stmt->execute(array($id));
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updateGroup($table, $id, $parameters)
    {
        $sql = "UPDATE {$table} SET";
        $comma = " ";
        foreach($parameters as $key => $val) {
            if( ! empty($val)) {
                $sql .= $comma . $key . " = '" . $val . "'";
                $comma = ", ";
            }
        }
        $sql .= "WHERE id = {$id}";

        try {
            $statement = $this->db_conn->prepare($sql);
            $statement->execute($parameters);
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    function update()
    {
        $sql = "UPDATE students 
                SET firstname = :firstname, lastname = :lastname 
                WHERE id = :id";
        try {
            $statement = $this->db_conn->prepare($sql);
            return $statement->execute(array(
                ':firstname' => $_POST['firstname'],
                ':lastname' => $_POST['lastname'],
                ':id' => $_POST['hidden_id']
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

