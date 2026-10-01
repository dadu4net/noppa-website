<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

function sendAssessmentEmail($to, $subject, $body, $replyTo = null) {
    $config = require __DIR__ . '/smtp_config.php';
    
    // Check if password is still the placeholder
    if ($config['password'] === 'VUL_HIER_JE_WACHTWOORD_IN') {
        // Fallback to standard mail() if SMTP is not configured yet
        $headers = "From: " . $config['from_email'] . "\r\n";
        if ($replyTo) {
            $headers .= "Reply-To: " . $replyTo . "\r\n";
        }
        $headers .= "X-Mailer: PHP/" . phpversion();
        return mail($to, $subject, $body, $headers);
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $config['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['username'];
        $mail->Password   = $config['password'];
        $mail->SMTPSecure = $config['encryption'] === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = $config['port'];

        // Recipients
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($to);
        if ($replyTo) {
            $mail->addReplyTo($replyTo);
        }

        // Content
        $mail->isHTML(false); // Set to plain text, but can be changed if HTML is needed
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}
