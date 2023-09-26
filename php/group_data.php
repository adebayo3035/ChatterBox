<?php
    while($row2 = mysqli_fetch_assoc($query2)){
                $output .= '<a href="group_chat.php?group_id='. $row2['group_id'] .'">
                    <div class="content">
                    <img src="php/group_headers/'. $row2['group_image'] .'" alt="">
                    <div class="details">
                        <span>'. $row2['group_name']. " " . ' ' .'</span>
                        <p>'.$row2['group_description'].'</p>
                    </div>
                    </div>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                </a>';
    }
    // $myquery = "SELECT * FROM group_messages LEFT JOIN groups ON group_messages.group_id = groups.group_id LEFT JOIN group_members ON group_messages.group_id = group_members.group_id";
?>
