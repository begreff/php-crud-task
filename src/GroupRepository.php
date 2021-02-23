<?php

namespace src;

class GroupRepository
{
    private $db_conn;

    public function __construct($db_conn)
    {
        $this->db_conn = $db_conn;
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
}
