<?php 

$cod_random	= @$_POST['cod_random'];

if (!isset($cod_random))
{
    $cod_random = '';
}

$email	= @$_POST['email'];

if (!isset($email))
{
    $email = '';
}

if ($email == '' or $cod_random == '')
{
    echo 'erro';
    return false;
}

$login	= @$_POST['login'];

if (!isset($login))
{
    $login = 'Usuário';
}

// Utilizando o Composer
require_once("vendor/autoload.php");

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPSecure = "tls";

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "senacpi2.2019@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "!g@[HpzR";

//Set who the message is to be sent from
$mail->setFrom('senacpi2.2019@gmail.com', 'Gamer Shopping');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress($email, $login);

//Set the subject line
$mail->Subject = 'Gamer Shopping - Recuperar senha';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('emailrec.htm'), __DIR__);

//$mensagem_corpo = '';
//$mensagem_corpo = file_get_contents('emailrec.htm');
//$mensagem_corpo = str_replace('[[CODIGO]]',$cod_random,$mensagem_corpo)

$mail->msgHTML("Seu codigo: $cod_random", __DIR__);

//Replace the plain text body with one created manually
$mail->AltBody = "Seu codigo: $cod_random";

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "erro";
  //  echo "Mailer Error: " . $mail->ErrorInfo;
} else 
{
    //echo "Message sent!";
    echo "ok";
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
/*function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}

*/

?>