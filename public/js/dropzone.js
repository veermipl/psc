// Disable auto-discovery to enable manual setup
Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function() {
    // Initialize Dropzone
    var myDropzone = new Dropzone("#my-dropzone", {
        url: "{{ route('register') }}", // Ensure this route exists in your web.php
        paramName: "supported_files", // Ensure this matches your form input name
        maxFilesize: 5, // MB
        acceptedFiles: "application/pdf", // Restrict to PDF files
        addRemoveLinks: true, // Allow users to remove files
        dictDefaultMessage: "Drop files here or click to upload",
        success: function(file, response) {
            console.log('File uploaded successfully');
        },
        error: function(file, response) {
            console.error('Error uploading file');
        }
    });
});
