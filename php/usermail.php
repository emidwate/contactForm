<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $filters = array (
        "first-name" => FILTER_SANITIZE_SPECIAL_CHARS,
        "last-name" => FILTER_SANITIZE_SPECIAL_CHARS,
        "email" => FILTER_VALIDATE_EMAIL,
        "phone-number" => FILTER_VALIDATE_INT,
        "choice" => FILTER_SANITIZE_SPECIAL_CHARS,
        "message" => FILTER_SANITIZE_SPECIAL_CHARS
    );
    
    $validatedValues = filter_input_array(INPUT_POST, $filters);

    $firstName = $validatedValues["first-name"];
    $lastName = $validatedValues["last-name"];
    $email = $validatedValues["email"];
    $phoneNumber = $validatedValues["phone-number"];
    $webChoice = $validatedValues["choice"];
    $message = $validatedValues["message"];

    $mail = new PHPMailer(true);

    try {

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'myemail@gmail.com';                     
        $mail->Password   = 'privatepassword';    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                           
        $mail->Port       = 465;                                    

        //Recipients
        $mail->setFrom("myemail@gmail.com");
        $mail->addAddress($email);     

        //Content
        $mail->isHTML(true);
        $mail->Subject = $webChoice;
        $mail->Body    = 
                        "<h3>Potwierdzenie wyslania wiadomosci</h3>\n
                            <p>Wkrotce skontaktujemy sie z Toba</p>
                            <hr>
                            <p>Wiadomosc wygenerowana automatycznie 
                            prosimy na nia nieodpowiadac</p>
                        ";

        $mail->send();
        echo "Message has been sent \n";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} \n";
    }
?>