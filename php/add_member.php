<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $group_id = $_SESSION['group_id'];
    if(!empty($email) && !empty($role)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                while($row = mysqli_fetch_assoc($sql)){
                    $unique_id = $row['unique_id'];
                }
                // check if user already exist
                $check_User = mysqli_query($conn,"SELECT user_id, status FROM group_members WHERE user_id = $unique_id AND group_id = $group_id");
                if(mysqli_num_rows($check_User) > 0){
                    $row = mysqli_fetch_assoc($check_User);
                    $status= $row['status'];

                    // If User Status is Removed, then Update the Status to Active
                    if($status == 'Removed'){
                        $Update_sql = "UPDATE group_members SET role = '$role', membership_status = 'Active' WHERE user_id = '$unique_id' AND group_id = '$group_id'";
                        if ((mysqli_query($conn, $Update_sql))){
                            echo "New User has been successfully added!";
                        }
                        else{
                            echo 'Something went wrong, please try again';
                        }
                    }
                    else{
                        echo "This User Already Exist!";
                    }
                }
                    // If User does not Exist then add User to Group
                else{
                    $insert_query = mysqli_query($conn, "INSERT INTO group_members (group_id, user_id, role, membership_status)
                    VALUES ({$group_id}, '{$unique_id}','{$role}', 'Active')");
                    if($insert_query){
                        echo "New User has been successfully added";
                    }
                    else{
                    echo "Something went wrong. Please try again!";
                    }
                }
            }
            else{
                echo "This e-mail address does not exist in your address book!";
            }
        }
        else{
            echo "Enter a Valid E-mail Address";
        }
    }
    else{
        echo 'Please Enter an E-mail and Select Role';
    }
?>