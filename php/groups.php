<?php
    session_start();
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    $sql = "SELECT group_id FROM group_members WHERE user_id = {$user_id} ";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_assoc($query)){
            $group_id = $row['group_id'];

            // Fetch the group details based on the group_id
            $sql2 = "SELECT * FROM groups WHERE group_id = {$group_id} ";
            $query2 = mysqli_query($conn, $sql2);
        
        if(mysqli_num_rows($query2) > 0){
            $group_data = mysqli_fetch_assoc($query2);
            // include_once "group_data.php";

            $output .= '<a href="group_chat.php?group_id='. $group_data['group_id'] .'">
                    <div class="content">
                    <img src="php/group_headers/'. $group_data['group_image'] .'" alt="">
                    <div class="details">
                        <span>'. $group_data['group_name']. " " . ' ' .'</span>
                        <p>'.$group_data['group_description'].'</p>
                    </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>';
           
            
        }
        elseif(mysqli_num_rows($query2) == 0){
            $output .= "No groups available for this user.";
        }
        echo $output;
        
        }
        

        

    }
   
?>