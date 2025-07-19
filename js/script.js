$(document).ready(function () {
    $('#myModalCheckbox').change(function () {
        if ($(this).is(':checked')) {
            $('#myModal').modal('show');
        } else {
            $('#myModal').modal('hide');
        }
    });
});


// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

function displayImage() {
    var fileInput = document.getElementById('fileInput');
    var selectedImage = document.getElementById('selectedImage');

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            // Set the source of the image to the data URL
            selectedImage.src = e.target.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(fileInput.files[0]);
    }
}