<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $user_id = $_SESSION['unique_id'];
        $group_id = $_SESSION['group_id'];
        // $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $sql = "SELECT * FROM group_messages LEFT JOIN users ON users.unique_id = group_messages.user_id
                WHERE (group_id = {$group_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                // date_time is the Date and time the messages was sent
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" alt="">
                                <div class="details">
                                    <i> '.$row['fname']. ' '. $row['lname'].' </i>
                                    <p>'. $row['message'] .'</p>
                                    <i>'. $row['date_time'] . '</i>
                                </div>
                                </div>';
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>