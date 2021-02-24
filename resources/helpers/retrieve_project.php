<?php

$project_id = (int) $_GET['id'];

$project = $projectRepo->read($project_id);
