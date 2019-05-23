<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 21/05/2019
 * Time: 22:12
 */

//require_once '/../../vendor/autoload.php';

//require_once "../../vendor/autoload.php";

require_once '../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
    ->setUsername('contatoelaw@gmail.com')
    ->setPassword('%%bb0791');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Test Subject')
    ->setFrom(array('contatoelaw@gmail.com' => 'ABC'))
    ->setTo(array('contatoelaw@gmail.com'))
    ->setBody('This is a test mail.');

$result = $mailer->send($message);