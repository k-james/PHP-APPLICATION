
  
  <?php
define('TITLE', 'Upload');
// Include the header file.
include('templates/header.php');
    //CHECK IF FORM IS SUBMITTED
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //SHOW INFORMATION ABOUT THE FILE 
        $file = $_FILES['the_file']; //THE_FILE COMES FROM FORM
        print_r($file);
        
        //MOVE UPLOADED FILE FROM TEMPORARY FILE TO DESTINATION FOLDER.
        //FILE PROPERTIES WE WANT TO ACCESS FROM THE $_FILE[ARRAY]
        if (move_uploaded_file ($_FILES['the_file'] ['tmp_name'], "../uploads/ {$_FILES['the_file'] ['name']}")) {
            print '<p>Your file has been Uploaded</p>';
        } else {
            print '<p style="color:red;">Your File Could Not be Uploaded because: </p>';
            //PRINT MESSAGE BASED UPON THE FILES ERROR CODES
            switch ($_FILES['the_file'] ['error']) {
                case 1:
                    print 'The file exceeds the upload_max_filesize setting in php.ini.';
                    break;
                case 2:
                    print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form';
                    break;
                case 3:
                    print 'The file was partially uploaded';
                case 4:
                    print 'No file was uploaded';
                case 6:
                    print 'The temporary folder does not exist.';
                    break;
                default:
                    print 'Something unforseen happened.';
            }
            print '.</p>'; //COMPLETE PARAGRAPH
        } //END OF MOVE_UPLOADED_FILE() IF
    } //END SUBMISSION IF
    ?>
   <form action = "" enctype="multipart/form-data" method="post">
       
       <!--ONLY FILES SMALLER THAN 300KB SHOULD BE ALLOWED BY SETTING MAX_FILE_SIZE RESTRICTION-->
       <input type="hidden" name="MAX_FILE_SIZE" value="300000">
       
       <!--FILE INPUT NAME VALUE MUST EXACTLY MATCH THE INDEX IN THE $_FILES VARIABLE-->
       <p><input type="file" name="the_file"></p>
       <p><input type="submit" name="submit" value="Upload This File"></p>
       
   </form>
<?php
// Include the footer file.
include('templates/footer.php');
?>