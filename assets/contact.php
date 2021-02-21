<?php

function __($str, $lang = null)
{
  if (!isset($lang)) :
    $lang = "es";
  endif;
  if (file_exists('../lang/' . $lang . '.php')) :
    include('../lang/' . $lang . '.php');
    if (isset($texts[$str])) {
      $str = $texts[$str];
    }
  endif;
  return $str;
}


$lang = $_POST["lang"];
$msgOk = __('contact-section-sendOk', $lang);
$msgBad = __('contact-section-sendBad', $lang);
// Only process POST reqeusts.
$jsondata = array();
$jsondata["mensaje"] = "Nothing";
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
    $jsondata["code"] = 200;
    $jsondata["mensaje"] = $msgOk;
  } else {
    $jsondata["code"] = 300;
    $jsondata["mensaje"] = $msgBad;
  }
} else {
  $jsondata["code"] = 300;
  $jsondata["mensaje"] = $msgBad;
}
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
