document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.add-to-cart-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            const productId = this.dataset.id;

            fetch('/cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: productId })
            })
            .then(response => response.json())
            .then(data => {
                // Mensagem de sucesso
                alert(data.message);
            })
            .catch(error => console.error('Erro ao adicionar ao carrinho:', error));
        });
    });
});
