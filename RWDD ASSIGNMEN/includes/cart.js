document.addEventListener('DOMContentLoaded', () => {
    const removeButtons = document.querySelectorAll('.remove-btn');
    const quantityInputs = document.querySelectorAll('.spinner');

    // Remove item
    removeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to remove item.');
                }
            });
        });
    });

    // Update quantity
    quantityInputs.forEach(input => {
        input.addEventListener('change', () => {
            const id = input.getAttribute('data-id');
            const quantity = input.value;
            fetch('update_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id, quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Failed to update quantity.');
                }
            });
        });
    });
});