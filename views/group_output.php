<?php

function groupList($groups, $students, $unassignedStudents) {
    echo "
    <div class='row'>";
    foreach ($groups as $group) {
        groupView($group, $students, $unassignedStudents);
    }
    echo "</div>";
}

function groupView($group, $students, $unassignedStudents) {
    echo "    
        <div class='col-sm'>
        <table class='table table-bordered'>
        <thead class='thead-light'>
            <tr>
                <th>";
                    groupTitle($group);
                echo "    
                </th>
            </tr>
        </thead>
        <tbody>";
        groupMembers($students, $group['group_number']);
        unassignedMembersDropdown($group, $unassignedStudents);
        echo "
        </tbody>
        </table>
    </div>
    ";
}

function groupTitle($group) {
    echo "
    Group ".$group['group_number'];
    if ($group['capacity'] == $group['count']) {
        echo " - FULL";
    }
}

function groupMembers($students, $groupNumber) {
    // TODO: use array filter
    foreach ($students as $student) {
        if ($student['group_number'] == $groupNumber) {
            echo "
            <tr>
                <td>".$student['firstname']." ".$student['lastname']."</td>
            </tr>
            ";
        }
    }
}

function unassignedMembersDropdown($group, $unassignedStudents) {
    $difference = $group['capacity'] - $group['count'];
    for ($i = 0; $i < $difference; $i++) {
        $output = "<tr>";
        $output .= "<td>";
        $output .= "<form action='update_group_action.php?group_number={$group['group_number']}' method='post'>";
        $output .= "<select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>";
        $output .= "<option value=''>Assign student</option>";
        echo $output;

        foreach ($unassignedStudents as $student) {
            $fullname = $student['firstname']." ".$student['lastname'];
            echo "<option value=".$student['id'].">".$fullname."</option>";
        }

        echo
            "</select>
           </form>
          </td>
        </tr>";
    }
}

