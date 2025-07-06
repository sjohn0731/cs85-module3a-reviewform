<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
</head>
<body>
    <?php
    function validateInput($data, $fieldName) {
        global $errorCount;
        if (empty($data)) {
            echo "\"$fieldName\" is a required field.<br />\n";
            ++$errorCount;
            $retval = "";
        }
        else { //Only clean up the input if it isn't empty
            $retval = trim($data);
            $retval = stripslashes($retval);
        }

        return($retval);
            /*
            From what I can tell, the validateInput() function:
            -takes in the $data and $fieldName parameters
            -creates the global variable $errorCount
            -if statement that checks the input field and throws an error message if there is no 
                data to interact with and iterates through each input field
            -else statement that "cleans up" any data for security/humans to read and understand
                by using the trim() function to eliminate any excess whitespace and the stripslashes() function
                to eliminate and backslashes and place it in the $retval variable
            */
    }

    function validateEmail($data, $fieldName) {
        global $errorCount;

        if (empty($data)) {
            echo "\"$fieldName\" is a required field.<br />\n";
            ++$errorCount; $retval = "";
        }
        else {
            $retval = filter_var($data, FILTER_SANITIZE_EMAIL);

            if (!filter_var($retval, FILTER_VALIDATE_EMAIL)) {
                echo "\"$fieldName\" is not a valid e-mail address.<br />\n";
            }
        }
    return($retval);
    /*
    The function validateEmail() is very similar to validateInput() where it checks the input field for email and will:
        -throw an error messeage if there is no input data
        -nest an if statement in the else statement that, once the Email input field has data:
            -the filter_var() function checks to see if the input field has a valid email and the FILTER_SANITIZE_EMAIL() function
            will eliminate any illegal characters that aren't part of a valid email address (to avoid XSS)
            -If the data ISN'T a valid email via the filter_var() function, an error message demanding a valid email address pops up
        -End result is returned in the $retval variable at the end of the function

    */
    }
    function displayForm($Sender, $Email, $Subject, $Message) {
        ?> <h2 style="text-align: center;">Contact Me</h2>
        <form name="contact" action="ContactForm.php" method="post">
            <p>Your Name:
                <input type="text" name="Sender" value="<?php echo $Sender; ?>" /></p>
            <p>Your Email:
                <input type="text" name="Email" value="<?php echo $Email; ?>" /></p>
            <p>Subject:
                <input type="text" name="Subject" value="<?php echo $Subject; ?>" /></p>
            <p>Message:<br />
                <textarea name="Message"><?php echo $Message; ?></textarea></p>
            <p><input type="reset" name="Clear Form" />&nbsp; &nbsp;
                <input type="submit" name="Submit" value="Send Form"></p>
        </form>
            /*
            This function works to:
            -Build the form in html code
            -utilize php to validate and sanitize any input data so only email addresses with the proper
            format are able to be submitted, Only letters (not numbers or special chars) can be entered into the Name field, etc.
            -have a "Clear Form" button that wipes any data that is in the input field at that moment
            -have a Submit button to send the message

            */
        
    <?php }
    $ShowForm = TRUE;
    $errorCount = 0;
    $Sender = "";
    $Email = "";
    $Subject = "";
    $Message = "";
    /*
    -Once outside the loop, create the variables that will be affected by the PHP logic:
        -A variable with a Boolean value of true
        -Multiple variables that contain empty strings 
    */

    if (isset($_POST['Submit'])) {
        $Sender = validateInput($_POST['Sender'],"Your Name");
        $Email = validateEmail($_POST['Email'],"Your E-mail");
        $Subject = validateInput($_POST['Subject'],"Subject");
        $Message = validateInput($_POST['Message'],"Message");
        if ($errorCount==0)
            $ShowForm = FALSE;
        else
            $ShowForm -= TRUE;

    } /*This code block seems to validate all the information input and introduce the showForm variable, which will (if the $errorCount is 0) 
    not appear on the screen or shows an error message to the user (if $errorCount is more than 0) 
     */

    if ($ShowForm == TRUE) {
        if ($errorCount>0)
            echo "<p>Please re-enter the form information below:</p>\n";
            displayForm($Sender, $Email, $Subject, $Message);
        }
        else
            {
            $SenderAddess = "$Sender <$Email>";
            $Headers = "From: $SenderAddress\nCC: $SenderAddress\n";

            $result = mail("recipient@example.com", $Subject, $Message, $Headers);

            if ($result)
                echo "<p>Your message has been sent. Thank you, " . $Sender . ".</p>\n";
            else
                                echo "<p>There was an error sending your message, " . $Sender . ".</p>\n";
            }
        /*
        If the errorcount is over 0 when the form is submitted, $ShowForm initiates and displays an error message on the webpage displaying the 
        corrosponding error(s).
        Otherwise, an email is sent to the sender either confirming a sent message or informing the sender an error occured during submission.

        */


    /*
    REFLECTION:

    */
    ?>
</body>
</html>