<?php
session_start();
session_unset(); 
session_destroy();  
header('Location: ../dash-index.html');  
exit();
?>
