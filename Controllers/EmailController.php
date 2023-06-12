<?php


    namespace Controllers;
    use Lib\Pages;
    use Lib\Captcha;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/Exception.php';
    require './PHPMailer/PHPMailer.php';
    require './PHPMailer/SMTP.php';

    class EmailController {
        private Pages $pages;
        private Captcha $captcha;

        public function __construct() {
            $this->pages = new Pages();
            $this->captcha = new Captcha();
        }

        public function sendEmail() {

            // Comentar Captcha si da error.
            if ($this->captcha->checkCaptcha($_POST['h-captcha-response'])) {
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try{
                    // Server Settings.
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->CharSet = 'UTF-8';
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'test.carlos.321@gmail.com';                     //SMTP username
                    $mail->Password   = 'kphuoxdkpntgaymw';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('test.carlos.321@gmail.com', 'Contact-Form-Library');
                    $email = $_POST['email'];
                    $mail->addAddress($email);


                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Library-Contact_Form';

                    // $cuerpo = $_POST['mensaje'];

                    // $mail->Body = $cuerpo;


                    $mail->Body = $mail->Body = '
                    <html>
                    <head>
                    </head>
                    <body>
                    <div style="width:600px;margin:0 auto;font-family:Helvetica"><div class="adM">

                    <div>
                      <div style="padding:50px 20px 20px;border:0 solid #eee;background-color:#f7f7f7;width:560px;margin:0 auto">
                        <h1 style="color:#092935;display:block;font-family:Times New Roman;font-size:40px;font-style:normal;font-weight:bold;line-height:1.1;letter-spacing:0.2px;margin:0;margin-bottom:20px;text-align:center">¡Bienvenido a BookCloud!</h1>
                    
                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left">Respaldamos cada modelo que compra con nuestra <b>Garantía de confianza total:</b></p>
                    
                        <ul>
                            <li style="margin-bottom:5px;color:#75808f;text-align:left;line-height:1.5em"><b>Mejor precio garantizado</b> - revisamos activamente nuestros modelos para asegurarle los mejores precios y garantizarle que nunca encontrara una oferta mejor.</li>
                            <li style="margin-bottom:5px;color:#75808f;text-align:left;line-height:1.5em"><b>Devoluciones simples</b> - compraste un modelo que no funciona para su proyecto? No hay problema, le daremos un reembolso.</li>
                            <li style="margin-bottom:5px;color:#75808f;text-align:left;line-height:1.5em"><b>Soporte 24/7</b> - Estamos aqui para ayudar. Contactenos en cualquier momento, antes o despues de una compra, y avisenos si tiene alguna pregunta.</li>
                            <li style="margin-bottom:5px;color:#75808f;text-align:left;line-height:1.5em"><b>Proteccion de compra de clase mundial</b> - lideramos la industria en indemnizacion disponible en sus compras de libros.</li>
                        </ul>
                    
                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left">Gracias por unirse a nuestra comunidad.</p>
                    
                        <p style="text-align:center">
                        <a href="https://www.bookcloud.es" style="word-wrap:break-word;max-width:100%;font-weight:normal;line-height:100%;text-align:center;text-decoration:none;color:#fff;font-size:16px;text-decoration:none;display:inline-block;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;color:#ffffff;letter-spacing:0px;font-weight:bold;font-size:16px;background-color:#ff8135;border-radius:5px;margin:10px 0" target="_blank"
                        data-saferedirecturl="https://www.google.com/url?q=https://www.bookcloud.es">Empezar</a></p>

                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left">Recibirás una respuesta por un agente de su cuestión a este mismo correo.</p>
                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left"><b>Pregunta:</b> '.$_POST['mensaje'].'</p>

                      </div>
                    
                    </div>
                    </body>
                    </html>
                ';

                    $mail->send();


                    $this->pages->render('Home/home', ['correct_response_email' => 'El mensaje se ha enviado.']);

                } catch (Exception $e) {

                    $this->pages->render('Home/home', ['bad_response_email' => "Mailer Error: {$mail->ErrorInfo}"]);

                }
            }else{
                $this->pages->render('Home/home', ['bad_response_email' => "Captcha incorrecto."]);
            }

            
        }

        public function sendEmailReserva($email, $titulo) {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try{
                // Server Settings.
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->CharSet = 'UTF-8';
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'test.carlos.321@gmail.com';                     //SMTP username
                $mail->Password   = 'kphuoxdkpntgaymw';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('test.carlos.321@gmail.com', 'Contact-Form-Library');
                $mail->addAddress($email);


                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Library-Contact_Form';

                $mail->Body = '
                <html>
                <head>
                </head>
                <body>
                <div style="width:600px;margin:0 auto;font-family:Helvetica"><div class="adM">

                    <div>
                        <div style="padding:50px 20px 20px;border:0 solid #eee;background-color:#f7f7f7;width:560px;margin:0 auto">
                        <h1 style="color:#092935;display:block;font-family:Times New Roman;font-size:40px;font-style:normal;font-weight:bold;line-height:1.1;letter-spacing:0.2px;margin:0;margin-bottom:20px;text-align:center">
                            ¡Bienvenido a BookCloud!
                        </h1>
                    
                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left">
                            Hola Sr/Sra, le contactamos para darle una <b>buena noticia.</b>
                        </p>

                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left">
                           Se ha repuesto Stock en nuestra página y ya puedes acceder al libro para recojer la reserva.
                        </p>
                        <p> <b>Titulo:</b> '.$titulo.'</p>

                        <p>
                            <a href="http://www.bookcloud.es/libros" style="word-wrap:break-word;max-width:100%;font-weight:normal;line-height:100%;text-align:center;text-decoration:none;color:#fff;font-size:16px;text-decoration:none;display:inline-block;padding-top:15px;padding-bottom:15px;padding-left:15px;padding-right:15px;color:#ffffff;letter-spacing:0px;font-weight:bold;font-size:16px;background-color:#ff8135;border-radius:5px;margin:10px 0" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://email.turbosquid.com/ls/click?upn%3Da3xwlb8QqJ9yGEFyWBr4z2J-2Ft0iwuIhjmbpPEOuVKXvtLCyZsnn0EO7FpAqSkG12iYahtuiCu-2F3Kz6tzfGY7mlmuPRWxXrqArFcXXWaU7Z4mizRQ86cBsXYJ8r2Sca32H-2BQekf21VvFAI8TyN4B-2Fpx0vqN2HrnkSBd6XA4mFOJk-3D780C_hDJouvxlUmw3EfsHzrHB9Jrhppml9Gp1DtVDZjxQ-2Ftwj4pRW-2FTH2nghcbZZUhruG-2BhCPHZz8dkSgXTLE5dgxZzNihG0I6-2BhOHmzCSYMoCO2KkGNgNEfMGtjEi7Eiq6rRPCpgdj-2BjQao80YLKtBE2mTrRsT8uj7P-2F8tRPDN-2FoxjgGY2d39sk98dsFvJ4yiIGKkzLL-2BhtoRszG69w6meiKUyuUMKiWVo8ee-2BK8McTnv484B5qYMisn-2BnsqDExOMHXaRTM2rpEtUXKOjsuw2ZYFloliWnebu1RSAzcLFZhb-2FgA-3D&amp;source=gmail&amp;ust=1685705135526000&amp;usg=AOvVaw3Ir_crDlufCS6SFtWLLKt7">Ver Libros</a></p>
                        </p>
                    
                        <p style="color:#75808f;font-size:13px;line-height:150%;letter-spacing:0.1px;text-align:left">
                            Gracias por confiar en nuestra comunidad.
                        </p>

                    </div>
                
                </div>
                </body>
                </html>
            ';

                $mail->send();

                header('Location: '.$_ENV['BASE_URL'].'home');


            } catch (Exception $e) {

                header('Location: '.$_ENV['BASE_URL'].'home');

            }

            
        }


    }

    