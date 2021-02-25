<div class='row'>
    <?php foreach ($collection as $groupNumber => $group) : ?>
    <div class='col-sm'>
        <table class='table table-bordered'>
            <thead class='thead-light'>
            <tr>
                <th>
                    <!-- Display group number and whether it is full -->
                    Group <?= $groupNumber ?>
                    <?php if ($group['spacesAvailable'] == 0) :?>
                        - FULL
                    <?php endif; ?>
                </th>
            </tr>
            </thead>
            <tbody>
                <!-- List students that have been assigned to this group.-->
                <?php foreach ($group['members'] as $student) : ?>
                <tr><td>
                        <?= $student['firstname']." ".$student['lastname'] ?>
                </td></tr>
                <?php endforeach; ?>

                <!-- Display a dropdown of students that have not been assigned yet.-->
                <?php for ($i = 0; $i < $group['spacesAvailable']; $i++) : ?>
                <tr>
                    <td>
                        <!-- Display a dropdown form.-->
                        <form action='src/actions/update_group.php?group_number=<?= $groupNumber ?>' method='post'>
                            <select onchange='this.form.submit()' name='studentSelected' id='studentSelected'>
                                <option value=''>Assign student</option>

                                <!--    Display an option for every unassigned student.-->
                                <?php foreach ($unassigned as $student) : ?>
                                <option value="<?= $student['id'] ?>">
                                    <?= $student['firstname']." ".$student['lastname'] ?>
                                </option>
                                <?php endforeach; ?>

                            </select>
                        </form>
                    </td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>
</div>

