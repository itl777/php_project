document.addEventListener('DOMContentLoaded', function() {
    const orderStatusSelect = document.getElementById('orderStatus');

    fetch('api/order-status-api.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            data.forEach((status) => {
                let option = new Option (status.order_status_name, status.id);
                orderStatusSelect.add(option);
            });
        })
        .catch(error => {
            console.error('Error loading the order statuses:', error);
        });
});

