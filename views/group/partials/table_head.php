<div class='col-sm'>
<table class='table table-bordered'>
    <thead class='thead-light'>
    <tr>
        <th>
            Group <?= $groupNumber ?>
            <?php if ($project['students_per_group'] == count($groupMembers)) :?>
                - FULL
            <?php endif; ?>
        </th>
    </tr>
    </thead>
    <tbody>
