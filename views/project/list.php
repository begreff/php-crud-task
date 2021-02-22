<h1 class="my-3">All Projects</h1>

<?php if ($projects) : ?>
    <?php foreach ($projects as $project) :?>
        <div class="card my-3">
            <div class="card-body">
                <li><a href="../../project_view.php?id=<?= $project['id']?>"> <?= $project['title'] ?> </a></li>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>There are no projects yet.</p>
<?php endif ?>

<button type="button" class="btn btn-primary"><a href="../../new_project.php" class="text-light">Add New Project</a></button>
