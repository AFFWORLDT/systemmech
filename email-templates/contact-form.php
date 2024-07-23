<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

    if ($name && $email && $comment) {
 
        $to = "shivanjalisociety17002@gmail.com"; 
        $subjectToOwner = $subject ? $subject : "Feedback from " . $name;
        $bodyToOwner = "Name: " . $name . "\n";
        $bodyToOwner .= "Email: " . $email . "\n";
        $bodyToOwner .= "Phone: " . $phone . "\n";
        $bodyToOwner .= "Message: " . $comment . "\n";

        $headersToOwner = "From:shivanjalisociety17002@gmail.com\r\n";
        $headersToOwner .= "Reply-To: " . $email . "\r\n";

    
        $subjectToUser = "Thank You for Your Feedback";
        $bodyToUser = "Dear " . $name . ",\n\n";
        $bodyToUser .= "Thank you for getting in touch! We appreciate you contacting us. One of our colleagues will get back in touch with you soon! Have a great day!\n\n";
        $bodyToUser .= "Best regards,\nSystmech Solutions."; 
        $headersToUser = "From:no-reply@systmechsolutions.com\r\n";


        $mailToOwner = mail($to, $subjectToOwner, $bodyToOwner, $headersToOwner);
        $mailToUser = mail($email, $subjectToUser, $bodyToUser, $headersToUser);

        if ($mailToOwner && $mailToUser) {
            echo "Feedback successfully sent!";
        } else {
            echo "Failed to send feedback. Please try again.";
        }
    } else {
        echo "Invalid input. Please check your details and try again.";
    }
} else {
    echo "Invalid request method.";
}
?>

