<?php
$receiving_email_address = 'designateads@gmail.com';

// Check if the PHP Email Form library exists
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create an instance of the PHP_Email_Form class
$contact = new PHP_Email_Form;
$contact->ajax = true; // Enable AJAX

// Set recipient and sender details
$contact->to = $receiving_email_address;
$contact->from_name = isset($_POST['name']) ? $_POST['name'] : 'No Name';
$contact->from_email = isset($_POST['email']) ? $_POST['email'] : 'No Email';
$contact->subject = isset($_POST['subject']) ? $_POST['subject'] : 'No Subject';

// Uncomment this section if you want to use SMTP
/*
$contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_username',
    'password' => 'your_password',
    'port' => '587'
);
*/

// Add messages to the email
$contact->add_message($contact->from_name, 'From');
$contact->add_message($contact->from_email, 'Email');
$contact->add_message(isset($_POST['message']) ? $_POST['message'] : 'No Message', 'Message', 10);

// Send the email and handle the response
$response = $contact->send();
if ($response) {
    echo json_encode(['status' => 'success', 'message' => 'Your message has been sent. Thank you!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send your message.']);
}
?>
