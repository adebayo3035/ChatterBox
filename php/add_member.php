<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $group_id = $_SESSION['group_id'];
    echo $group_id;
    if(!empty($email) && !empty($role)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_assoc($sql)){
                    $unique_id = $row['unique_id'];
                }
                // check if user already exist
                $check_User = mysqli_query($conn,"SELECT user_id FROM group_members WHERE user_id = $unique_id AND group_id = $group_id");
                if(mysqli_num_rows($check_User) > 0){
                    echo "This User already exist!";
                }
                else{
                    $insert_query = mysqli_query($conn, "INSERT INTO group_members (group_id, user_id, role)
                VALUES ({$group_id}, '{$unique_id}','{$role}')");
                if($insert_query){
                    echo "New User has been successfully added";
                }else{
                    echo "Something went wrong. Please try again!";
                }
                }
                

            }
            else{
                echo "This e-mail address does not exist";
            }
        }
        else{
            echo "Something went wrong, please try again";
        }
    }
?>