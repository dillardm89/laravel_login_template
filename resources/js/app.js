import './bootstrap';

if (document.querySelector('#avatar-form')) {
    document.querySelector('#avatar-form').addEventListener('submit', (event) => {
        const fileInput = document.getElementById('avatar');
        const file = fileInput.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (file && file.size > maxSize) {
            event.preventDefault();
            document.getElementById('size-error').classList.remove('d-none');
            document.getElementById('size-error').textContent = 'Max size allowed is 2 MB';
        }
    });
}
