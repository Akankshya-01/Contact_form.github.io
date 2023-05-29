<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Contact Form</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="contact-form">
    <h2>CONTACT US</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="phone" placeholder="Phone no" required>
        <input type="email" name="email" placeholder="Your Email Id" required>
        <textarea name="message" placeholder="Your message"></textarea>
        <div class="g-recaptcha" data-sitekey="6LfeKEQmAAAAAEQduD7htP1EOfryLDzDuZu88S8R"></div>

        <input type="submit" name="submit" value="Send Message" class="submit-btn">
    </form>

    <div class="status">
        <?php
        if(isset($_POST['submit']))
        {
            $User_name = $_POST['name'];
            $phone = $_POST['phone'];
            $user_email = $_POST['email'];
            $user_message = $_POST['message'];

            $email_from = 'akankshyaparida50@gmail.com';
            $email_subject = "submission";
            $email_body = "Name: $User_name.\n".
                          "Phone no.: $phone.\n".
                          "Email id: $user_email.\n".
                          "User Message: $user_message.\n";
            $to_email = "akankshyaparida50@gmail.com";
            $headers = "From: $email_from \r\n";
            $headers .= "Reply-to: $user_email \r\n";

            $secretKey ="6LfeKEQmAAAAAPdhRctS0eeuC0mm7JTIzjm6zKww";
            $responseKey = $_POST['g-recaptcha-response'];
            $UserIP = $_SERVER['REMOTE_ADDR'];
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$UserIP";

            $response = file_get_contents($url);
            $response = json_decode($response);

            if ($response) {
                mail($to_email,$email_subject,$email_body,$headers);
                echo "message sent successfully";
            }
            else{
                echo " <span>invalid captcha. Please try again.</span>";
            }
                          
        }
        ?>

    </div>

    </div>
   
</body>
</html>