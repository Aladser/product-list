<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PHPMailerController extends Controller
{
    // ========== [ Compose Email ] ================
    public static function composeEmail(string $message)
    {
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.mail.ru';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'aladser@mail.ru';   //  sender username
            $mail->Password = 'BEt7tei0Nc2YhK4s1jix';       // sender password
            $mail->SMTPSecure = 'ssl';                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('aladser@mail.ru', 'Shop admin');
            $mail->addAddress('aladser@gmail.com');
            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = 'Shop: new product';
            $mail->Body = $message;

            // $mail->AltBody = plain text version of email body;

            if (!$mail->send()) {
                return back()->with('failed', 'Email not sent.')->withErrors($mail->ErrorInfo);
            } else {
                return back()->with('success', 'Email has been sent.');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Message could not be sent.');
        }
    }
}
