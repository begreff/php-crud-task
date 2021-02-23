// Delete student
$(document).on('click', '.delete', function(){
    let id = $(this).attr("id");
    let pID = document.getElementById("project_id").value;
    if(confirm("Are you sure you want to remove this student?")) {
        $.ajax({
            url: "../actions/students_api.php?id=" + id,
            type: "DELETE",
            success: function(response) {
                alert(response);
                window.location.href = "project_view.php?id=" + pID;
            }
        });
    }
});
