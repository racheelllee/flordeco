#!/usr/bin/perl
$path="/mnt/stor11-wc2-dfw1/496430/587580/corpbravo.webpoint.mx/web/content";
system("/usr/bin/php ".$path."/bin/cake.php genera_pdf_cotizaciones");

for($a=0; $a<30; $a++) {
    sleep 10;
    system("/usr/bin/php ".$path."/bin/cake.php genera_pdf_cotizaciones");
}