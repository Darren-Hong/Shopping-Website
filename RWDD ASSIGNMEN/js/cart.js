function updatePrice(key) {
    const quantitySelect = document.querySelector(`select[name="quantities[${key}]"]`);
    const quantity = parseInt(quantitySelect.value);
    const priceCell = document.querySelector(`#price-${key}`);
    const price = parseFloat(priceCell.getAttribute('data-price'));
    const newTotal = (price * quantity).toFixed(2);
    priceCell.textContent = `$${newTotal}`;
    updateOverallTotal();
}

function updateOverallTotal() {
    let overallTotal = 0;
    const priceCells = document.querySelectorAll('[id^="price-"]');
    priceCells.forEach(cell => {
        overallTotal += parseFloat(cell.textContent.replace('$', ''));
    });
    document.querySelector('#overall-total').textContent = `$${overallTotal.toFixed(2)}`;
}