<?php

// Only process POST reqeusts.
$jsondata = "Nothing";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get the form fields and remove whitespace.
  $name = strip_tags(trim($_POST["name"]));
  $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  //$doctor = trim($_POST["doctor"]);
  //$input_date = trim($_POST["input_date"]);
  $subject = trim($_POST["subject"]);
  $message = trim($_POST["message"]);

  // Set the recipient email address.
  // FIXME: Update this to your desired email address.
  $recipient = "davidbermudezmoreno@fp.iesromerovargas.com";



  // Build the email content.
  $email_content = "Full Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Subject: $subject\n\n";
  //$email_content .= "Doctor Name: $doctor\n\n";
  //$email_content .= "Appoinment Date: $input_date\n\n";
  $email_content .= "Message:\n$message\n";

  //
  // Set the email subject.
  $subject = "New contact from $name";

  // Build the email headers.
  $email_headers = "From: $name <$email>";

  // Send the email.
  if (mail($recipient, $subject, $email_content, $email_headers)) {
    $jsondata = 'Nos pondremos en contacto contigo lo antes posible';
  } else {
    $jsondata = "Oops! Something went wrong and we couldn't send your message.";
  }
} else {
  $jsondata = "There was a problem with your submission, please try again.";
}
echo $jsondata;
