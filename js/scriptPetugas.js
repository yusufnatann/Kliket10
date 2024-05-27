function updateStatus(button, status) {
    var row = button.parentNode.parentNode;
    var statusCell = row.querySelector('.status');
    statusCell.textContent = status;

    // AJAX request to update the status in the database (implement if needed)
    var tiketID = row.querySelector('td:nth-child(4)').textContent;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "database/updateStatus.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Handle response if needed
            console.log(xhr.responseText);
        }
    };
    xhr.send("tiketID=" + tiketID + "&status=" + status);
}
