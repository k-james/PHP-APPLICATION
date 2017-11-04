<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory Contents</title>
</head>
<body>
  
   <?php
    
    //SET THE TIME ZONE
    date_default_timezone_set('America/Los_Angeles');
    
    //SET DIRECTORY NAME AND SCAN IT
    $search_dir = '.'; //SET STARTING DIRECTORY TO SEARCH. 
    //'.' IS A REFERENCE TO CURRENT DIRECTORY. CAN BE A RELATIVE OR ABSOLUTE PATH.
    $contents = scandir($search_dir); //SCANDIR() RETURNS AN ARRAY IN $CONTENTS
    print_r($contents);
    
    //LIST DIRECTORIES FIRST
    //PRINT A CAPTON AND START A LIST
    print '<h2>Directories</h2>
            <ul>';
    foreach($contents as $item) { //ITERATE THROUGH ARRAY
        if ((is_dir($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.')) {
            print "<li>$item</li>\n";
        }
            
    }
     print '</ul>';
    
    //CREATE A TABLE HEADER
    print '<hr><h2>Files</h2>
    <table border="1" cellpadding="2" align="left">
    <tr>
        <th>Name</th>
        <th>Size</th>
        <th>Last Modified</th>
    </tr>';
    
    //LIST THE FILES
    foreach  ($contents as $item) {
        if ( (is_file($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
            //GET FILE SIZE 
            $fs = filesize($search_dir . '/' . $item);
            //GET FILES MODIFICATION DATE
            $lm = date('F j, Y', filemtime($search_dir . '/' . $item));
            
            //PRINT INFO> MUST BE IN DOUBLE QUOTE
            print "<tr>
                    <td>$item</td>
                    <td>$fs bytes</td>
                    <td>$lm</td>
                    </tr>\n";
        } //CLOSE IF
    } //CLOSE FOREACH
            print '</table>';
    ?>
    
</body>
</html>