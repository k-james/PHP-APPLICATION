<?php
/*
* Script 11.6 - register.php (modified from Script 8.9)
* This page lets people register for the site.
* It stores user information in a text file and creates a directory
* for them on the server.
*/
// Use a constant to set the page title.
define('TITLE', 'Register');
// Include the header file.
include('templates/header.php');
// Identify the directory and file to use.
$dir = '../users/';
$file = $dir . 'users.txt';
// Print some introductory text.
print '<h2>Registration Form</h2>';
// Check if the form has been submitted i.e. via POST request.
// If so, validate the submitted values.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 // Flag variable to indicate if submitted values are valid or not.
 $problem = false;
 if (empty($_POST['username'])) {
 $problem = true;
 print '<p class="text--error">Please enter a username!</p>';
 }
 if (empty($_POST['password1'])) {
 $problem = true;
 print '<p class="text--error">Please enter a password!</p>';
 } elseif ($_POST['password1'] != $_POST['password2']) {
 $problem = true;
 print '<p class="text--error">Your password did not match your confirmed password!</p>';
 }
 // If all values are valid, register the user.
 // Otherwise, display a message to try again.
 if (!$problem) {
 // Check if the user file exists and is writable.
 if (is_writable($file)) {
 // Add the user data to the user text file, make a directory for
 // the user on the server, and notify the user that he/she is
 // registered.
 // Create the user subdirectory name and data to be written.
 $subdir = time() . rand(0, 4596);
 $data = $_POST['username'] . "\t" . sha1(trim($_POST['password1'])) . "\t" . $subdir
. PHP_EOL;
 // Write the data.
 file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
 // Create the directory.
 mkdir ($dir . $subdir);
 print '<p>You are now registered!</p>';
 } else { // Couldn't write to the file.
 print '<p class="error">You could not be registered due to a system error.</p>';
 }
 // Clear the posted values so that they are not redisplayed in the form.
 $_POST = [];
 } else {
 print '<p class="text--error">Please try again!</p>';
 }
}
// Display a sticky form.
?>
<form action="register.php" method="post" class="form--inline">
 <p>
 <label for="username">Username:</label>
 <input type="text" name="username" size="20"
 value="<?php if (isset($_POST['username'])) { print htmlspecialchars($_POST['username']); }
?>">
 </p>
<p>
 <label for="password1">Password:</label>
 <input type="password" name="password1" size="20"
 value="<?php if (isset($_POST['password1'])) { print htmlspecialchars($_POST['password1']);
} ?>">
 </p>
<p>
 <label for="password2">Confirm Password:</label>
 <input type="password" name="password2" size="20"
 value="<?php if (isset($_POST['password2'])) { print htmlspecialchars($_POST['password2']);
} ?>">
 </p>
<p><input type="submit" name="submit" value="Register!" class="button--pill"></p>
</form>
<?php
// Include the footer file.
include('templates/footer.php');
?>