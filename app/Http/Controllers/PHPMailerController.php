<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
class PHPMailerController extends Controller {
 
    // =============== [ Email ] ===================
    public function email() {
        return view("email");
    }
 
    // ========== [ Compose Email ] ================
    public function composeEmail(Request $request) {
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
 
            $mail->setFrom('aladser@mail.ru', 'Shop Admin');
            $mail->addAddress($request->emailRecipient);
            $mail->addReplyTo('aladser@mail.ru', 'Shop Admin'); // sender email, sender name
 
            $mail->isHTML(true);                // Set email content format to HTML
 
            $mail->Subject = $request->emailSubject;
            $mail->Body    = $request->emailBody;
 
            // $mail->AltBody = plain text version of email body;
 
            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            } else {
                return back()->with("success", "Email has been sent.");
            }
 
        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }
    }
}