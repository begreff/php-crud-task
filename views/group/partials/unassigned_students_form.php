<?php

$difference = $project['students_per_group'] - count($groupMembers);
for ($j = 0; $j < $difference; $j++) {
    $output = "<tr>";
    $output .= "<td>";
    $output .= "<form action='update_group_action.php?project_id={$project_id}&group_number={$groupNumber}' method='post'>";
    $output .= "<select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>";
    $output .= "<option value=''>Assign student</option>";
    echo $output;

    foreach ($unassignedStudents as $student) {
        $fullname = $student['firstname']." ".$student['lastname'];
        echo "<option value=".$student['id'].">".$fullname."</option>";
    }

    echo "</select>
        </form>
      </td>
    </tr>";
}

echo "
    </tbody>
  </table>
</div>";
