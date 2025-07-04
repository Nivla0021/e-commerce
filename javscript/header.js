function submit(id) {
    let form = document.getElementById(id);
    form.submit();
}

function confirmLogout() {
    return confirm("Confirm logging out?");
}