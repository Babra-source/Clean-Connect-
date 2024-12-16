
function deleteService(serviceId) {
    if (confirm('Are you sure you want to delete this service?')) {
        // Create a form dynamically
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = ''; // Current page

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'service_id';
        input.value = serviceId;
        form.appendChild(input);

        var deleteInput = document.createElement('input');
        deleteInput.type = 'hidden';
        deleteInput.name = 'deleteservice';
        deleteInput.value = '1';
        form.appendChild(deleteInput);

        document.body.appendChild(form);
        form.submit();
    }
}
