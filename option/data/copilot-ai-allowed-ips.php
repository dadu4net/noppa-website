<?php
/* =========================================================================
 * Noppa Solutions & Consultants — IP-allowlist voor de Copilot AI Experience tellerweergave
 *
 *  De teller op /copilot-ai-experience.html is uitsluitend zichtbaar voor
 *  bezoekers waarvan het IP-adres hieronder staat. Bewerk deze lijst om
 *  toegang te geven of in te trekken — geen herstart of cache-flush nodig.
 *
 *  Ondersteund:
 *    - Losse IPv4-adressen   ('203.0.113.42')
 *    - Losse IPv6-adressen   ('2001:db8::1')
 *    - CIDR-ranges           ('203.0.113.0/24', '2001:db8::/32')
 *
 *  Laat het kantoor-IP eventueel als CIDR-range staan zodat alle werkplekken
 *  achter dezelfde gateway automatisch toegang krijgen.
 * ========================================================================= */

return [
    // TODO Rik — vul de 3 toegestane IP-adressen in:
    // '145.131.191.167/32',     // bv. kantoor 's-Hertogenbosch
    // '188.91.17.94/32',     // bv. thuiswerk Rik
];
