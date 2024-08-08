
document.addEventListener('DOMContentLoaded', (event) => {
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');

    // Open file dialog when clicking on dropzone
    dropzone.addEventListener('click', () => fileInput.click());

    // Handle file selection
    fileInput.addEventListener('change', handleFiles);

    // Handle drag and drop
    dropzone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropzone.style.backgroundColor = '#f1f1f1';
    });

    dropzone.addEventListener('dragleave', (event) => {
        event.preventDefault();
        dropzone.style.backgroundColor = 'white';
    });

    dropzone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropzone.style.backgroundColor = 'white';
        const files = event.dataTransfer.files;
        handleFiles({ target: { files } });
    });

    function handleFiles(event) {
        const files = event.target.files;
        fileList.innerHTML = '';
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item');
            fileItem.textContent = file.name;
            fileList.appendChild(fileItem);
        }
    }
});
