<?php
error_reporting(E_ALL ^ E_WARNING ^E_NOTICE);
//Seteo la zona horaria
date_default_timezone_set("America/Mexico_City");

    $host = 'mail.soporteg.com.mx';
    $username = 'gp\noreply';
    $password = '654321sg';
    $head = '-H Method: POST" -H "Connection: Keep-Alive" -H "User-Agent: PHP-SOAP-CURL" -H "Content-Type: text/xml; charset=utf-8" -H "SOAPAction: \'http://schemas.microsoft.com/exchange/services/2006/messages/FindItem\'';
    $location = "https://mail.soporteg.com.mx/EWS/Exchange.asmx";
    $wsdl = "https://mail.soporteg.com.mx/EWS/Services.wsdl";
    $debug=0;
    $error=0;
    

   

//Tomo todos los correos en el Inbox
$command = <<<C
curl -X POST -w "%{http_code}" --ntlm -u gp/noreply:654321sg -d '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"
  xmlns:t="http://schemas.microsoft.com/exchange/services/2006/types">
  <soap:Body>
    <CreateItem MessageDisposition="SendAndSaveCopy" xmlns="http://schemas.microsoft.com/exchange/services/2006/messages">
      <SavedItemFolderId>
        <t:DistinguishedFolderId Id="sentitems" />
      </SavedItemFolderId>
      <Items>
        <t:Message>
          <t:ItemClass>IPM.Note</t:ItemClass>
          <t:Subject>Prueba</t:Subject>
          <t:Body BodyType="Text">prueba de correo</t:Body>
          <t:ToRecipients>
            <t:Mailbox>
              <t:EmailAddress>daniel.jasso@webpoint.mx</t:EmailAddress>
            </t:Mailbox>
          </t:ToRecipients>
          <t:IsRead>false</t:IsRead>
        </t:Message>
      </Items>
    </CreateItem>
  </soap:Body>
</soap:Envelope>
'  -H "Method: POST" -H "Connection: Keep-Alive" -H "User-Agent: PHP-SOAP-CURL" -H "Content-Type: text/xml; charset=utf-8" -H "SOAPAction: 'http://schemas.microsoft.com/exchange/services/2006/messages/CreateItem'" --insecure https://mail.soporteg.com.mx/EWS/Exchange.asmx
C;
    echo $command;

    
    $response = shell_exec($command);
    echo $response;

?>