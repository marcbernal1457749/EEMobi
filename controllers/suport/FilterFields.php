<?php
/**
 * Clean data for security 
 */
function cleanInfo($info){
    $info = trim($info);
    $info = stripslashes($info);
    $info = htmlspecialchars($info);
    
    return $info;
}

?>