document.addEventListener('DOMContentLoaded', () => {
    const uploadInput = document.getElementById('upload-input');
    const profilePic = document.getElementById('profile-pic');

    profilePic.addEventListener('click', () => {
        uploadInput.click();
    });

    uploadInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                profilePic.src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
});