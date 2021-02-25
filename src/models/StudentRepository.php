<?php

namespace src\models;

class StudentRepository
{
    private $db_conn;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
    }

    /*
     * Returns all students on a project.
     */
    function all($project_id) {
        $sql = "SELECT id, firstname, lastname, group_number 
                FROM students
                WHERE project_id = ?
                ORDER BY id";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($project_id));
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Checks if a student with this name already exists.
     */
    function find($firstname, $lastname) {
        $sql = "SELECT 1
                FROM students
                WHERE firstname = ? AND lastname = ?";

        try {
            $stmt = $this->db_conn->prepare($sql);
            $stmt->execute(array($firstname, $lastname));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Adds a student to the students table.
     */
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

    /*
     * Updates student information on the database.
     */
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

    /*
     * Deletes a student from the database.
     */
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

