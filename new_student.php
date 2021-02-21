<?php

include 'templates/header.php';
require 'vendor/autoload.php';
require 'config/conn.php';

use src\ProjectRepository;

$projectGateway = new ProjectRepository($db->getConnection());
$project_id = (int) $_GET['project_id'];
$project = $projectGateway->read($project_id);

?>

<h1 class="my-3">Add New Student to <?= $project['title'] ?></h1>

<div class="card my-3">
    <div class="card-body">
        <form method="post" id="studentForm">

            <div class="form-group">
                <label>Enter First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Enter Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control" required />
            </div>

            <input type="hidden" name="project_id" id="project_id" value="<?= $project_id ?>">
            <input type="hidden" name="action" id="action" value="create" />
            <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Create" />
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    // Create student
    $('#studentForm').on('submit', function (event) {
        event.preventDefault();
        let form_data = $(this).serialize();
        let project_id = document.getElementById("project_id").value;
        $.ajax({
            url: "students.php",
            type: "POST",
            data: form_data,
            success: function (response) {
                alert(response);
                window.location.href = "project_view.php?id=" + project_id;
            }
        });
    });
</script>

<?php include("templates/footer.php"); ?>


