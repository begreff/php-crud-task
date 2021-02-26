<h1 class='my-3'>Students</h1>
<table id='studentsTable' class='table table-bordered text-center'>
    <thead class='thead-light'>
        <tr>
            <th>Student</th>
            <th>Group</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    <?php if (count($students) > 0) : ?>
        <?php foreach($students as $student) : ?>
        <tr>
            <td><?= $student['firstname'] . " " . $student['lastname'] ?></td>
            <?php if ($student['group_number']) : ?>
                <td>Group #<?= $student['group_number'] ?></td>
            <?php else : ?>
                <td>-</td>
            <?php endif; ?>
            <td>
                <input type='hidden' name='project_id' id='project_id' value="$project_id">
                <button type='button' name='delete' class='btn
                                    btn-danger btn-xs delete' id=<?= $student['id'] ?>>
                    Delete
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan='4'>No Students Found</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
