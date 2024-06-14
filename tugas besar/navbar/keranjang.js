
        function updateQty(button, change) {
            var input = button.parentNode.querySelector('input');
            var qty = parseInt(input.value) + change;
            if (qty < 1) qty = 1;
            input.value = qty;

            var priceCell = button.closest('tr').querySelectorAll('td')[3];
            var price = parseInt(priceCell.innerText.replace('Rp ', '').replace('.', ''));

            var totalCell = button.closest('tr').querySelector('.item-total');
            var newTotal = price * qty;
            totalCell.innerText = newTotal.toLocaleString('id-ID');

            updateGrandTotal();
        }

        function removeItem(button) {
            var row = button.closest('tr');
            row.parentNode.removeChild(row);
            updateGrandTotal();
        }

        function updateGrandTotal() {
            var grandTotal = 0;
            document.querySelectorAll('.item-total').forEach(function(itemTotal) {
                grandTotal += parseInt(itemTotal.innerText.replace('.', ''));
            });
            document.getElementById('grand-total').innerText = grandTotal.toLocaleString('id-ID');
        }

        function openModal() {
            document.getElementById('paymentModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('paymentModal').style.display = 'none';
        }

        function showVirtualAccount(method) {
            var virtualAccountNumber = generateVirtualAccountNumber(method);
            document.getElementById('virtualAccountNumber').innerText = virtualAccountNumber;
            document.getElementById('virtualAccountDisplay').style.display = 'block';
        }

        function generateVirtualAccountNumber(method) {
            // Logic to generate virtual account number based on method
            switch(method) {
                case 'BNI':
                    return "VA123456789 (BNI)";
                case 'MANDIRI':
                    return "VA987654321 (MANDIRI)";
                case 'BCA':
                    return "VA567890123 (BCA)";
                default:
                    return "";
            }
        }
    