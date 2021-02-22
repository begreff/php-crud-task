<?php

function listProjects($projects) {
    echo "<h1 class='my-3'>All Projects</h1>";

    if ($projects) {
        foreach ($projects as $project) {
            echo "
            <div class='card my-3'>
                <div class='card-body'>
                    <li><a href='../../project_view.php?id=".$project['id']."'>".$project['title']."</a></li>
                </div>
            </div>";
        }
    } else {
        echo "<p>There are no projects yet.</p>";
    }
}

function showDetail($project) {
    echo "
    <h1 class='my-3'>".$project['title']."</h1>
    <p>Project: <strong>".$project['title']."</strong></p>
    <p>Number of groups: <strong>".$project['num_groups']."</strong></p>
    <p>Students per group: <strong>".$project['students_per_group']."</strong></p>
    ";
}
