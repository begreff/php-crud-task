<?php

$project_id = $_GET["project_id"];
$api_url = "http://localhost/nfq-internship-task/api_routes.php?action=all&project_id=" . $project_id;
$client = curl_init($api_url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
$students = json_decode($response);

$output = '';

if(count($students) > 0) {
    echo "
    <thead class='thead-light'>
        <tr>
            <th>Student</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
        </thead>";
    foreach($students as $student) {
        $output .= '
		<tr>
			<td>' . $student->firstname . ' ' . $student->lastname . '</td>
			<td>' . $student->group_number . '</td>
			<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="' . $student->id .  '">Delete</button></td>
		</tr>';
    }
} else {
    $output .= '
	<tr>
		<td colspan="4">No Students Found</td>
	</tr>';
}

echo $output;
