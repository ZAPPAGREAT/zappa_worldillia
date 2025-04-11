<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    $to = "zappagreat@yahoo.co.jp";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $email_content = "お名前: " . $name . "\n";
    $email_content .= "メールアドレス: " . $email . "\n";
    $email_content .= "件名: " . $subject . "\n";
    $email_content .= "内容:\n" . $message;
    
    if (mail($to, $subject, $email_content, $headers)) {
        header("Location: thank_you.html");
    } else {
        header("Location: error.html");
    }
}
?> 