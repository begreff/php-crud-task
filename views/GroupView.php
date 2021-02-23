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
        $output = "
        <div class='row'>";
            for ($i = 1; $i <= $details['total']; $i++) {
                $output .= "    
            <div class='col-sm'>
            <table class='table table-bordered'>
            <thead class='thead-light'>
                <tr>
                    <th>";
                $groupStudents = $this->controller->groupStudents($projectID, $i);
                $output .= $this->title($i, $details['capacity'], count($groupStudents));

        $output .= "    
                    </th>
                </tr>
            </thead>
            <tbody>";

            foreach ($groupStudents as $student) {
                $output .= "
                <tr>
                    <td>".$student['firstname']." ".$student['lastname']."</td>
                </tr>
                ";
                    }
                    $difference = $details['capacity'] - count($groupStudents);
                    for ($j = 0; $j < $difference; $j++) {
                        $output .= "
                <tr>
                    <td>";
                        $output .= $this->unassignedDropdown($projectID, $i);
                        $output .= "
                  </td>
                </tr>";
                    }
                $output .= "
                </tbody>
                </table>
            </div>
            ";
        }
        $output .= "</div>";
        echo $output;
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
        $unassignedStudents = $this->controller->unassignedStudents($projectID);
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
