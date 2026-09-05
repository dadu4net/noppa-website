<?php
// api/config.php

// ---------------------------------------------------------
// Noppa - Assessment API Configuration
// ---------------------------------------------------------
// WARNING: Do not commit this file with real secrets!
// Add api/config.php to your .gitignore.

return [
    // Microsoft Entra ID (Azure AD) App Registration Details
    'TENANT_ID'    => 'VUL_HIER_JE_TENANT_ID_IN',
    'CLIENT_ID'    => 'VUL_HIER_JE_CLIENT_ID_IN',
    'CLIENT_SECRET'=> 'VUL_HIER_JE_CLIENT_SECRET_IN',
    
    // SharePoint Site & List Information
    // You can get the site ID using Graph Explorer: https://graph.microsoft.com/v1.0/sites/noppa.sharepoint.com:/sites/Management-Directie
    'SITE_ID'      => 'VUL_HIER_JE_SITE_ID_IN',
    
    // You can get the List ID using Graph Explorer: https://graph.microsoft.com/v1.0/sites/{site-id}/lists
    'LIST_ID'      => 'VUL_HIER_JE_LIST_ID_IN',

    // Fallback MySQL Settings (Optional)
    'USE_MYSQL_FALLBACK' => false,
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'burogekko_assessments'
];


