<?php
// Use a constant to set the page title.
define('TITLE', 'Login');
// Include the header file.
include('templates/header.php');
?>
   <h1>Login</h1>
   <?php
    
    //IDENTIFY THE FILE TO USE
    $file = '../users/users.txt';
    //CONDITIONAL TESTS IF SUBMITTED
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //$LOGGEDIN FOR CORRECT USERNAME/PASSWORD
        $loggedin = FALSE;
            //ENABLE AUTO_DETECT
            ini_set('auto_detect_line_endings', 1);
//$FP = FILE POINTER. POINTER RETURNED BY THE FOPEN(). R IS READ ONLY, B FLAG FILES TO BE OPENED IN BINARY MODE        
        $fp = fopen($file, 'rb');
//LOOP THROUGH FILE
        while ($line = fgetcsv($fp, 200, "\t") ) {
            if ( ($line[0] == $_POST['username']) AND ($line[1] == sha1(trim($_POST['password']))) ) {
                
                print_r($line);
                $loggedin = TRUE;
                
                break;
            } //END IF
        } //END WHILE
        fclose(sfp);
        
        if($loggedin) {
            print '<p>You are now logged in.</p>';
        } else {
            print '<p style="color: red;">The username and password you entered do not match those on file.</p>';
        }
    } 
    else {
  
    ?>
    
    <form action ="login.php" method="post">
        <p>Username: <input type="text" name="username" size="20"></p>
        <p>Password: <input type="password" name="password" size="20"></p>
        <input type="submit" name="submit" value="Login">
    </form>
    <? }//END SUBMISSION IF ?>
    
<?php
// Include the footer file.
include('templates/footer.php');
?>