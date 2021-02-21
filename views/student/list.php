<h1 class="my-3">Students</h1>
<table id="studentsTable" class='table table-bordered'>
    <tbody>
    <thead class='thead-light'>
    <tr>
        <th>Student</th>
        <th>Group</th>
        <th>Actions</th>
    </tr>
    </thead>
    <?php if (count($students) > 0) : ?>
        <?php foreach($students as $student) : ?>
            <tr>
                <td><?= $student['firstname'] ?> <?= $student['lastname'] ?></td>
                <td><?= $student['group_number'] ?></td>
                <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="<?= $student['id'] ?>">Delete</button></td>
            </tr>
        <?php endforeach; ?>
    <?php else :?>
        <tr>
            <td colspan="4">No Students Found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
<div class="pt-3 pb-4">
    <button type="button" class="btn btn-primary"><a class="text-light" href="../../new_student.php?project_id=<?= $project_id ?>">Add Student</a></button>
</div>
