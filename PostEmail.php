<?php

$to_email = 'projetandoofuturo@gmai.com ';
$subject = 'Testando PHP Mail';
$message = 'Este e-mail é enviado usando a função de e-mail do PHP';
$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers .= 'From: Miguel <miguelsilvalves.2015@gmail.com>' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 


mail($to_email, $subject,$message, $headers);

?>