<?php
    session_start();
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    $sql = "SELECT * from groups LEFT JOIN group_members ON groups.group_id = group_members.group_id WHERE (group_members.user_id = {$user_id} AND group_members.status = 'Active') ";
   
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) > 0){
        while ($group_data = mysqli_fetch_assoc($query)){
        //          // include_once "group_data.php";

            $output .= '<a href="group_chat.php?group_id='. $group_data['group_id'] .'">
                <div class="content">
                    <img src="php/group_headers/'. $group_data['group_image'] .'" alt="">
                    <div class="details">
                        <span>'. $group_data['group_name']. " " . ' ' .'</span>
                        <p>'.$group_data['group_description'].'</p>
                    </div>
                </div>
            </a>';
        } 
            
    }
    elseif(mysqli_num_rows($query) == 0){
            $output .= "No groups available for this user.";
    }
        echo $output;
   
?>