<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $message = $_POST['message'] ?? '';
    
    if (empty($name) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos']);
        exit;
    }

    $to = 'julianluchellifassa@gmail.com';
    $subject = 'Nuevo mensaje de apoyo - JLF Clases de Bajo';
    
    $email_content = "Nombre: $name\n\n";
    $email_content .= "Mensaje:\n$message\n\n";
    $email_content .= "Enviado desde: " . $_SERVER['HTTP_REFERER'];
    
    $headers = "From: $name <noreply@jlfclasesdebajo.com>\r\n";
    $headers .= "Reply-To: $name\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $email_content, $headers)) {
        echo json_encode(['success' => true, 'message' => '¡Gracias por tu mensaje!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Hubo un error al enviar el mensaje. Por favor, intenta nuevamente.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?> 