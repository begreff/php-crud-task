<?php foreach ($groupMembers as $groupMember) : ?>
    <tr>
        <td><?= $groupMember['firstname'] ?> <?= $groupMember['lastname'] ?></td>
    </tr>
<?php endforeach; ?>
