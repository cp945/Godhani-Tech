<?php
// Define variables and initialize with empty values
$name = $email = $phone = $message = "";
$name_err = $email_err = $phone_err = $message_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter a message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // If no errors, send the email
    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($message_err)) {
        
        // Recipient's email address (website owner's email)
        $to = "youremail@example.com"; // Replace with your email address

        // Subject of the email
        $subject = "New Quote Request from $name";

        // Message body of the email
        $body = "You have received a new quote request.\n\n".
                "Name: $name\n".
                "Email: $email\n".
                "Phone: $phone\n".
                "Message: \n$message";

        // Additional headers
        $headers = "From: $email";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "<p>Thank you! Your quote request has been submitted.</p>";
        } else {
            echo "<p>Oops! Something went wrong and we couldn't send your message. Please try again later.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Submission Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #0056b3;
        }
        p {
            font-size: 1.2rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quote Request Submitted</h1>
        <?php
            if (!empty($name_err) || !empty($email_err) || !empty($phone_err) || !empty($message_err)) {
                echo "<p>There were errors with your submission:</p>";
                echo "<ul>";
                echo !empty($name_err) ? "<li>$name_err</li>" : "";
                echo !empty($email_err) ? "<li>$email_err</li>" : "";
                echo !empty($phone_err) ? "<li>$phone_err</li>" : "";
                echo !empty($message_err) ? "<li>$message_err</li>" : "";
                echo "</ul>";
            }
        ?>
    </div>
</body>
</html>
