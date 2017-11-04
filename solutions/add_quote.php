
   <?php
    // Use a constant to set the page title.
define('TITLE', 'Add Quote');
// Include the header file.
include('templates/header.php');
   //Identify the file to use
    $file = '../users/quotes.txt';
    
    //CHECK FOR SUBMISSION
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //HANDLE FORM
        if (!empty($_POST['quote']) && ($_POST['quote'] != 'Enter your quotation here')) { //SOMETHING TO WRITE TO
            if (is_writable($file)) { //CONFIRM FILE IS WRITEABLE TO AVOID PERMISSION ERRORS
                file_put_contents($file, $_POST['quote'] . PHP_EOL, FILE_APPEND | LOCK_EX); //WRITE DATA
                
                //PRINT MESSAGE
                print '<p>Your quotation has been stored.</p>';
            } else { //COULD NOT OPEN FIILE
                print '<p style="color:red;">Your Quotation could not be stored due to a system error.</p>';
            }
        } else { //FAIL TO ENTER QUOTATION
            print '<p style="color:red;">Please enter a quotation!</p>';
        }
    }// END OF SUBMITTED IF
   
   
   //LEAVE PHP AND DISPLAY FORM
   ?>
   
   <form action="#" method="post">
       <textarea name="quote" rows="5" cols="30">Enter your Quotation here.</textarea><br>
       <input type="submit" name="submit" value="Add this Quote!">
   </form>

<?php
// Include the footer file.
include('templates/footer.php');
?>
    
