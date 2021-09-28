<?php    
    session_start();  
    session_destroy();  
    header("location:../Public/login.php?logout=True");  
 ?>