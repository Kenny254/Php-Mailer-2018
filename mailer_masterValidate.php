<?php
    if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "pecraig@moneymovers.com";
    $email_subject = "Mailing List Form";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you
       submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

   // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['company']) ||
        !isset($_POST['street']) ||
        !isset($_POST['city']) ||
        !isset($_POST['state']) ||
        !isset($_POST['zip'])) {
        died('We are sorry, but there appears to be a problem with the form you 
    submitted.');      
    }

    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['telephone']; // required
    $company = $_POST['company']; // required
    $street = $_POST['street']; // required
    $city = $_POST['city']; // required
    $state = $_POST['state']; // required
    $zip = $_POST['zip']; // required

    $error_message = "";
    $string_exp = "/^[A-Za-z0-9 .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }  
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$company)) {
    $error_message .= 'The Company you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$street)) {
    $error_message .= 'The Street you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$city)) {
    $error_message .= 'The City you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$state)) {
    $error_message .= 'The State you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$zip)) {
    $error_message .= 'The Zip Code you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Response from Mailing List Page.  Please enter in database.\n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Company: ".clean_string($company)."\n";
    $email_message .= "Street: ".clean_string($street)."\n";
    $email_message .= "City: ".clean_string($city)."\n";
    $email_message .= "State: ".clean_string($state)."\n";
    $email_message .= "Zip: ".clean_string($zip)."\n";


// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);

?>

<!-- include your own success html here -->

Thanks for subscribing to our mailing list



<?php
}
?>
