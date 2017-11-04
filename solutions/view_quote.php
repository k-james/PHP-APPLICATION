<?php
// Use a constant to set the page title.
define('TITLE', 'View Quote');
// Include the header file.
include('templates/header.php');
?>

   <h1>Random Quotation</h1>
   
   <?php
    
    //READ THE FILES CONTENTS AND STORE IN ARRRAY.
    //EACH ELEMENT OF $DATA IS A STRING, SHICH IS THE SUBMITTED 
    $data = file('../users/quotes.txt');
    
    //COUNT THE NUMBER OF ITEMS IN ARRAY
    $n = count($data);
    
    //PICK A RANDOM ITEM BASED ON THE NUMBER OF ELEMENTS IN QUOTES.TXT FILE
    $rand = rand(0, ($n - 1));
    
    //PRINT THE QUOTES
    print '<p>' . trim($data[$rand]) . '</p>';
    
    ?>
    
<?php
include('templates/footer.php');
?>