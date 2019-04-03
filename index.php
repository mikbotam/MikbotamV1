
<?php
    session_start();

    if (!isset($_SESSION["Mikbotamuser"])) {
        header("Location:admin/login.php");
    } else {
    	echo "<meta http-equiv='refresh' content='0;url=pages/index.php' />";  
    }

?>

