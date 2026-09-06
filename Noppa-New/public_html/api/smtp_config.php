<?php
// api/smtp_config.php
// Vul hier de SMTP gegevens van Noppa Solutions & Consultants (Office 365 / Exchange) in.

return [
    'host'       => 'smtp.office365.com',   // Voorbeeld voor Office 365
    'port'       => 587,                    // STARTTLS poort
    'encryption' => 'tls',                  // 'tls' of 'ssl'
    'username'   => 'info@noppa.nl',    // Je SMTP e-mailadres
    'password'   => 'VUL_HIER_JE_WACHTWOORD_IN', // Je SMTP wachtwoord of App Password
    'from_email' => 'info@noppa.nl',
    'from_name'  => 'Noppa Solutions & Consultants Assessment'
];
