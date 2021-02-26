<h1 class='my-3'>Add New Student</h1>
<div class='card my-3'>
    <div class='card-body'>
        <form method='post' id='studentForm'>
            <div class='form-group'>
                <label>Enter First Name</label>
                <input type='text' name='firstname' id='firstname' class='form-control' required />
            </div>
            <div class='form-group'>
                <label>Enter Last Name</label>
                <input type='text' name='lastname' id='lastname' class='form-control' required />
            </div>
            <input type='hidden' name='projectID' id='projectID' value=<?= $projectID ?>>
            <input type='submit' name='button_action' id='button_action' class='btn btn-primary' value='Create' />
        </form>
    </div>
</div>
