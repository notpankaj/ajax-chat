<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){ //if logfed in 
        include_once('config.php');

        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        
        // var_dump($_GET['logout_id']);
        // var_dump($logout_id);
        if(isset($logout_id)){ //if logout id is present
            $status = "Offline now";
            $sql = mysqli_query($conn,"UPDATE users SET status = '{$status}' WHERE unique_id = {$logout_id}" );
            if(!$sql){
                echo('deleting session');
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }
    }else{
        header("location: ../login.php");
    }