// Create student
$('#studentForm').on('submit', function (event) {
    event.preventDefault();
    let formData = $(this).serialize();
    let pID = document.getElementById("project_id").value;
    $.ajax({
        url: "../actions/students_api.php",
        type: "POST",
        data: formData,
        success: function (response) {
            alert(response);
            window.location.href = "project_view.php?id=" + pID;
        }
    });
});
