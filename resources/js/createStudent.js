// Create student
$('#studentForm').on('submit', function (event) {
    event.preventDefault();
    let formData = $(this).serialize();
    $.ajax({
        url: "../../src/actions/students_api.php",
        type: "POST",
        data: formData,
        success: function (response) {
            alert(response);
            window.location = document.referrer;
        }
    });
});
