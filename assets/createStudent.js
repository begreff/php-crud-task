// Create student
$('#studentForm').on('submit', function (event) {
    event.preventDefault();
    let form_data = $(this).serialize();
    let project_id = document.getElementById("project_id").value;
    $.ajax({
        url: "students.php",
        type: "POST",
        data: form_data,
        success: function (response) {
            alert(response);
            window.location.href = "project_view.php?id=" + project_id;
        }
    });
});
