<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_SESSION['unique_id'];
        $group_id = $_SESSION['group_id'];
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO group_messages (group_id, user_id, message)
                                        VALUES ({$group_id}, {$user_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>