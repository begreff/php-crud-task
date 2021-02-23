<?php

namespace views;

use controllers\GroupController;
use src\GroupRepository;

class GroupView
{
    private GroupRepository $repo;
    private GroupController $controller;

    public function __construct(GroupRepository $repo, GroupController $controller)
    {
        $this->repo = $repo;
        $this->controller = $controller;
    }

    public function list($projectID)
    {
        $details = $this->repo->projectInfo($projectID);
        $output = "<div class='row'>";
        for ($i = 1; $i <= $details['total']; $i++) {
            $output .= $this->view($projectID, $i);
        }
        $output .= "</div>";
        echo $output;
    }

    private function view($projectID, $groupNumber)
    {
        $details = $this->repo->projectInfo($projectID);
        $groupStudents = $this->controller->groupStudents($projectID, $groupNumber);
        $title = $this->title($groupNumber, $details['capacity'], count($groupStudents));
        $placesAvailable = $details['capacity'] - count($groupStudents);

        $output = "
        <div class='col-sm'>
            <table class='table table-bordered'>
            <thead class='thead-light'>
                <tr>
                    <th>".$title."
                    </th>
                </tr>
            </thead>
            <tbody>";

        foreach ($groupStudents as $student) {
            $output .= $this->tableRow($student['firstname']." ".$student['lastname']);
        }

        for ($j = 0; $j < $placesAvailable; $j++) {
            $output .= $this->tableRow($this->unassignedDropdown($projectID, $groupNumber));
        }

        $output .= "
            </tbody>
          </table>
        </div>";

        return $output;
    }


    private function tableRow($data)
    {
        return "<tr><td>".$data."</td></tr>";
    }

    private function title($number, $capacity, $taken)
    {
        $output = "Group ".$number;
        if ($taken == $capacity) {
            $output .= " - FULL";
        }
        return $output;
    }

    private function unassignedDropdown($projectID, $groupNumber)
    {
        $unassignedStudents = $this->repo->unassigned($projectID);
        $output = "
        <form action='actions/update_group_action.php?group_number={$groupNumber}' method='post'>
                    <select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>
                        <option value=''>Assign student</option>";

        foreach ($unassignedStudents as $student) {
            $fullname = $student['firstname']." ".$student['lastname'];
            $output .= "<option value=".$student['id'].">".$fullname."</option>";
        }

        $output .= "</select>
           </form>
        ";

        return $output;
    }
}
