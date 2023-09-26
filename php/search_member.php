<?php
    session_start();
    include_once "config.php";
    $user_id = $_SESSION['unique_id'];
    $group_id = $_SESSION['group_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    // $sql = "SELECT * FROM group_members WHERE group_id = {$group_id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
    $sql = "SELECT gm.*, u.* FROM group_members gm
        INNER JOIN users u ON gm.user_id = u.unique_id
        WHERE gm.group_id = '$group_id' AND (u.fname LIKE '%$searchTerm%' OR u.lname LIKE '%$searchTerm%')";
    $output1 = "";
    $output2 = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        while ($group_data = mysqli_fetch_assoc($query)) {

            // Output1 will be displayed for Group Admins to allow them to set roles for other members
            $output1 .= '<a href="add_admin.php?unique_id='.$group_data['unique_id'].'">
                <div class="content">
                    <img src="php/images/' . $group_data['img'] . '" alt="">
                    <div class="details">
                        <span>' . $group_data['fname'] . " " . $group_data['lname'] . ' ' . '</span> 
                        <br/> <i id="role">' . $group_data['role'] . '</i>.
                        <br/> <i id="role">' . $group_data['unique_id'] . '</i>
                    </div>
                </div>
                <div class="status-dot"><i class="fas fa-circle"></i></div>
            </a><a href="delete_member.php?user_id= '.$group_data['unique_id'].'"><i class="fa-solid fa-trash"></i></a>';

            // Output2 wil be displayed for ordinary members to disallow them from setting roles for group members
            $output2 .= '<a href="#">
            
                <div class="content">
                    <img src="php/images/' . $group_data['img'] . '" alt="">
                    <div class="details">
                        <span>' . $group_data['fname'] . " " . $group_data['lname'] . ' ' . '</span> 
                        <br/> <i id="role">' . $group_data['role'] . '</i>.
                        <br/> <i id="role">' . $group_data['unique_id'] . '</i>
                    </div>
                </div>
                <div class="status-dot"><i class="fas fa-circle"></i></div>
            </a> <button><i class="fas fa-search"></i></button>';
             $_SESSION['user_id'] = $group_data['unique_id'];
            // $_GET['user_id'] = $group_data['unique_id'];
        }
    }else{
        $output2 .= 'No user found related to your search term';
    }
     // Check the Role of the Logged in User to set their access level
     $sql3 = "SELECT role FROM group_members WHERE user_id = {$user_id} AND group_id = {$group_id}";
     $query3 = mysqli_query($conn, $sql3);
     if (mysqli_num_rows($query3) > 0) {
         while ($row = mysqli_fetch_assoc($query3)) {
             $role = $row['role'];
             if (($role === 'Group Admin') || ($role === 'Super Admin')) {
                 echo $output1;
             } 
             else {
                 echo $output2;
             }
         }
     }
?>