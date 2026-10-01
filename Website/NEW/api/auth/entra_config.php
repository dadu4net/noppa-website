<?php
// Noppa-New/api/auth/entra_config.php

return [
    // Voor Entra External ID vul je hier je unieke tenant string/ID in
    'tenant_id'     => 'vul_in_jouw_tenant_id', 
    'client_id'     => 'vul_in_jouw_client_id',
    'client_secret' => 'vul_in_jouw_client_secret',
    
    // Zorg dat deze exacte URL is toegevoegd aan Entra "Redirect URIs"
    'redirect_uri'  => 'https://jouwdomein.nl/api/auth/callback.php', 
    
    // Voor B2C of External ID heb je mogelijk een specifieke policy/flow
    'authority'     => 'https://login.microsoftonline.com/',
];
