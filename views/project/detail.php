<h1 class="my-3"><?= $project['title'] ?></h1>
<p>Project: <strong><?= $project['title'] ?></strong></p>
<p>Number of groups: <strong><?=  $project['num_groups'] ?></strong></p>
<p>Students per group: <strong><?=  $project['students_per_group'] ?></strong></p>
<input type="hidden" name="project_id" id="project_id" value="<?= $project_id ?>">
