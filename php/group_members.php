<?php
    session_start();
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    // $group_id = mysqli_real_escape_string($conn, $_GET['group_id']);
    if (isset($_GET['group_id'])) {
        $group_id = $_GET['group_id'];
        echo $group_id;
        $sql = "SELECT * from group_members LEFT JOIN group_users ON group_members.user_id = users.user_id WHERE group_members.group_id = '377792879
        '";
        $sql2 = "SELECT * FROM group_members WHERE group_id = {$group_id} ";
        $query = mysqli_query($conn, $sql);
        $output = "";
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $user_id = $row['user_id'];

                // Fetch the Users Information from the user table using the user id
                $sql2 = "SELECT * FROM users WHERE unique_id = {$user_id} ";
                $query2 = mysqli_query($conn, $sql2);
                if(mysqli_num_rows($query2)){
                    $user_data = mysqli_fetch_assoc($query2);

                    $output .= '<a href="chat.php?user_id='. $user_data['user_id'] .'">
                    <div class="content">
                    <img src="php/images/'. $user_data['img'] .'" alt="Profile Picture">
                    <div class="details">
                        <span>'. $user_data['lname']. " " . $user_data['fname'] .'</span>
                        <p>'.$user_data['status'].'</p>
                    </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>';
                }
                elseif(mysqli_num_rows($query2) == 0){
                    $output .= "No User in this group.";
                }
                echo $output;
            }
        }
    }
   
?>