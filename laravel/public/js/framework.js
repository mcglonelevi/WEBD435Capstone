document.addEventListener("DOMContentLoaded", function() {
    // Add onclick attributes to open modals on modal link classes
    var modalLinks = document.getElementsByClassName('modal-link');
    for (var link of modalLinks) {
        var id = link.getAttribute('data-target');
        link.setAttribute('onclick', 'openModal("' +  id + '")');
    }

    // Add alert close attributes to close alerts
    var alertCloses = document.getElementsByClassName('close-alert');
    for (var close of alertCloses) {
        // Get closest parent with "alert" class and assign the onclick
        var myAlert = close.closest('.alert').getAttribute('id');
        close.setAttribute('onclick', 'closeAlert("' + myAlert +'")');
    }
});

function closeAlert(alertId) {
    var myAlert = document.getElementById(alertId);
    myAlert.parentNode.removeChild(myAlert);
}

function closeModal(modalId) {
    // Hide modal
    var modal = document.getElementById(modalId);
    //modal.style.visibility = 'hidden';
    modal.className = 'modal';
    // Remove page overlay
    var overlay = document.getElementById('page-overlay');
    document.body.removeChild(overlay);
}

function openModal(modalId) {
    // Set modal as visible
    var modal = document.getElementById(modalId);
    modal.className = 'modal-open';

    // Add close events to close buttons inside modal
    var closeLinks = modal.getElementsByClassName('close-modal');
    for (var link of closeLinks) {
        link.setAttribute('onclick', 'closeModal("' + modalId + '")');
    }

    // Create div to gray out the page content while modal opened
    var div = document.createElement("div");
    document.body.insertBefore(div, document.body.firstChild);
    div.setAttribute('id', 'page-overlay');

    // Allow modal close when clicking outside of modal
    div.setAttribute('onclick', 'closeModal("' + modalId + '")');
}