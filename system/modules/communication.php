<?php
namespace Modules;

class communicationModule
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function sendMail(string $title, string $subject, string $message, string $whom)
    {
        include_once(MODULES_DIR . "/phpMailer/class.phpmailer.php");
        $mailConfig = $this->config["MAIL"];
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $mailConfig["SECURITY_PROTOCOL"];
        $mail->Host = $mailConfig['HOST'];
        $mail->Port = $mailConfig['PORT'];
        $mail->IsHTML(true);
        $mail->SetLanguage($mailConfig['LANG_CODE'], "phpmailer/language");
        $mail->CharSet = $mailConfig['CHARSET'];
        $mail->Username = $mailConfig['ADDRESS'];
        $mail->Password = $mailConfig['PASSWORD'];
        $mail->SetFrom($mailConfig['ADDRESS'], $title);
        $mail->addAddress($whom);
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->Send();
    }
}
