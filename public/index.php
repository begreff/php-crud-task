<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NFQ Challenge</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">NFQ Challenge</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<div class="container">

    <?php

    require '../vendor/autoload.php';
    use config\Database;
    use src\objects\Project;

    $config = require '../config/config.php';
    $db = new Database($config['database']);

    $projectGateway = new Project($db->getConnection());
    $projects = $projectGateway->all();

    ?>

    <h1 class="my-3">All Projects</h1>

    <?php if ($projects) : ?>
        <?php foreach ($projects as $project) :?>
            <div class="card my-3">
                <div class="card-body">
                    <li><a href="project_view.php?id=<?= $project['id']?>"> <?= $project['title'] ?> </a></li>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>There are no projects yet.</p>
    <?php endif ?>

    <button type="button" class="btn btn-primary"><a href="new_project.php" class="text-light">Add New Project</a></button>

</div>
<footer class="my-4"></footer>
</body>
</html>
