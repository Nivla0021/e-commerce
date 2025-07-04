document.getElementById('searchInput').addEventListener('input', function() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
});


function toggleSidebar() {
    const container = document.getElementById('container');
    container.classList.toggle('sidebar-open');

    const closeBtn = document.querySelector('.close-btn');
    const imgElement = closeBtn.querySelector('img');

    imgElement.src = container.classList.contains('sidebar-open') ? 'pics/right-arrow.png' : 'pics/left-arrow.png';
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this user?");
}