document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('donation-form');
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        try {
            const response = await fetch('send-message.php', {
                method: 'POST',
                body: formData
            });
            
            const data = await response.json();
            
            if (data.success) {
                alert(data.message);
                form.reset();
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente.');
        }
    });
});

function showThankYouMessage(data) {
    const message = `
        ¡Gracias por tu mensaje, ${data.name}!
        
        Tu mensaje de apoyo ha sido recibido:
        "${data.message}"
        
        Si deseas hacer una donación, puedes usar el alias:
        marte.relax.lemon
    `;

    alert(message);
} 