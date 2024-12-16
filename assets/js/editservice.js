// When the edit button is clicked, populate the modal fields with the current data
document.addEventListener('DOMContentLoaded', function() {
    var editModal = document.getElementById('editServiceModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var serviceId = button.getAttribute('data-id');
        var serviceName = button.getAttribute('data-name');
        var serviceDescription = button.getAttribute('data-description');
        var servicePrice = button.getAttribute('data-price');
        var serviceDuration = button.getAttribute('data-duration');
        
        // Populate the modal fields with the service data
        document.getElementById('edit_service_id').value = serviceId;
        document.getElementById('edit_service_name').value = serviceName;
        document.getElementById('edit_service_description').value = serviceDescription;
        document.getElementById('edit_service_price').value = servicePrice;
        document.getElementById('edit_service_duration').value = serviceDuration;
    });
});
