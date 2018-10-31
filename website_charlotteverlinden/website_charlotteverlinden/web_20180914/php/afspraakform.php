<?php
if(isset($_POST['Email'])) {
     
    // CHANGE THE TWO LINES BELOW
    
    $email_to = "info@bravalco.be";
    //$email_to = "charlotte@wecare-boechout.be"; 

    $email_subject = "website afspraak formulier";
     
     
    function died($error) {
        // your error code can go here
        echo "Er is een fout opgetreden bij het versturen van de email, gelieve opnieuw te proberen. ";
        echo "Onderstaande error(s) zijn voorgekomen.<br /><br />";
        echo $error."<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['Achternaam']) ||
        !isset($_POST['Voornaam']) ||
        !isset($_POST['Email']) ||
	!isset($_POST['Telefoon']) ||
	!isset($_POST['Datum']) ||
        !isset($_POST['Therapie'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $first_name = $_POST['Voornaam']; // required
    $last_name = $_POST['Achternaam']; // required
    $email = $_POST['Email']; // required
    $telefoon = $_POST['Telefoon']; // required
    $therapie = $_POST['Therapie']; // required
    $datum = $_POST['Datum']; // required
      
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    
  /* proberen beter schrijven
  if(!preg_match("/^[0-9/.]{9,18}/", $telefoon)) {
    $error_message .= 'The phone number you entered does not appear to be valid.<br />';
  }
  */
   
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Voornaam: ".clean_string($first_name)."\n";
    $email_message .= "Achternaam: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Telefoon: ".clean_string($telefoon)."\n";
    $email_message .= "Therapie: ".clean_string($therapie)."\n";
    $email_message .= "Gekozen datum afspraak: ".clean_string($datum)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
//echo "U bericht is succesvol verzonden!";

?>
 
<!-- place your own success html below -->
<?php
//header("Location: http://www.charlotteverlinden.be/index.html");
header("Location: http://charlotteverlinden.bravalco.be/index.html");
?>

<?php
}
die();
?>
