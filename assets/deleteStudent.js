// Delete student
$(document).on('click', '.delete', function(){
    let id = $(this).attr("id");
    if(confirm("Are you sure you want to remove this student?")) {
        $.ajax({
            url: "../src/actions/students_api.php?id=" + id,
            type: "DELETE",
            success: function(response) {
                alert(response);
                window.location.reload();
            }
        });
    }
});
