function populateEditModal(serviceId) {
    // Find the current row of the service being edited
    const row = document.querySelector(`button[onclick='populateEditModal(${serviceId})']`).closest('tr');

    // Extract service details from the table row
    const serviceName = row.cells[0].textContent;
    const serviceDescription = row.cells[1].textContent;
    const servicePrice = row.cells[2].textContent;
    const serviceImage = row.cells[4].querySelector('img').src;

    // Some rows might not have a duration displayed. In such case, we'll leave it blank
    const serviceDuration = row.cells[4] ? row.cells[4].textContent : '';

    // Populate the edit modal fields
    document.getElementById('edit_service_id').value = serviceId;
    document.getElementById('edit_service_name').value = serviceName;
    document.getElementById('edit_service_description').value = serviceDescription;
    document.getElementById('edit_service_price').value = parseFloat(servicePrice);
    
    // Optional: If you want to show the current image
    // Note: This is a display-only feature and won't be sent with the form
    const currentImageDisplay = document.createElement('img');
    currentImageDisplay.src = serviceImage;
    currentImageDisplay.style.maxWidth = '100px';
    currentImageDisplay.style.marginBottom = '10px';
    
    // Remove any existing preview images
    const existingPreview = document.getElementById('current-image-preview');
    if (existingPreview) {
        existingPreview.remove();
    }

    // Insert the current image preview before the file input
    currentImageDisplay.id = 'current-image-preview';
    const imageInput = document.getElementById('edit_service_image');
    imageInput.parentNode.insertBefore(currentImageDisplay, imageInput);
}