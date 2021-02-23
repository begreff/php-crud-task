<h1 class="my-3">Create New Project</h1>
<div class="card my-3">
    <div class="card-body">
        <form action="../../actions/new_project_action.php" method="post">
            <div class="form-group">
                <label for="title">Project Title</label>
                <input type="text" class="form-control" id="title" name="titleInput" placeholder="Enter project title" required>
            </div>
            <div class="form-group">
                <label for="numOfGroups">Number of Groups</label>
                <input type="number" min="1" class="form-control" id="numOfGroups" name="numOfGroupsInput"  placeholder="Enter the number of groups" required>
            </div>
            <div class="form-group">
                <label for="studentsPerGroup">Students per Group</label>
                <input type="number" min="1" class="form-control" id="studentsPerGroup" name="studentsPerGroupInput" placeholder="Enter the number of students per group" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
