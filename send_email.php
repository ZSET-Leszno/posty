<?php
if (($_SERVER["REQUEST_METHOD"] == "POST")) {
    // odbierz dane z formularza
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // walidacja danych
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Proszę wypełnić wszystkie pola formularza i podać poprawny adres e-mail.";
        exit;
    }
    $to = "k.michalski@zset.leszno.pl";
    $subject = "Wiadomość od $name";
    $body = "Od: $name\n\nAdres e-mail: $email\n\nWiadomość:\n$message";
    $headers = "From: $name <$email>\r\nReply-To: $email\r\n";
    if (mail($to, $subject, $body, $headers)) {
        http_response_code(200);
        echo "Wiadomość została wysłana.";
    } else {
        http_response_code(500);
        echo "Wystąpił btd podczas wysyłania wiadomości.";
    }
} else {
    http_response_code(403);
    echo "Wystąpił btd podczas przetwarzania formularza.";
}
?>