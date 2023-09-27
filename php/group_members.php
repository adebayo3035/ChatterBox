<?php
session_start();
include_once "config.php";
$user_id = $_SESSION['unique_id'];
$group_id = $_SESSION['group_id'];
$header = '<a href="add_member.php?group_id=' . $group_id . '"> Add New Member </a>';
// $header .= '<a href="add_admin.php?group_id=' . $group_id . '"> Add Admin </a>';

// check the role of the loggged in User to set their role for adding and deleting group members.
$sql2 = "SELECT role FROM group_members WHERE user_id = {$user_id} AND group_id = {$group_id}";
$query2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($query2) > 0) {
    while ($row = mysqli_fetch_assoc($query2)) {
        $role = $row['role'];
        if ($role === 'Group Admin' || $role === 'Super Admin') {
            echo $header;
        };
    }
}
// Get the group id from the session storage
if (isset($_SESSION['group_id'])) {
    $group_Id = trim($_SESSION['group_id']);
    // select group member Data from users and group_members table
    $sql = "SELECT * from users LEFT JOIN group_members ON users.unique_id = group_members.user_id WHERE group_members.group_id = {$group_Id} AND group_members.membership_status ='Active'";
    $query = mysqli_query($conn, $sql);
    $output1 = "";
    $output2 = "";
    $header = '<a href="add_member.php?group_id=' . $group_Id . '"> Add Member </a>';
    $offline = 'offline';
    if (mysqli_num_rows($query) > 0) {
        while ($group_data = mysqli_fetch_assoc($query)) {

            // Output1 will be displayed for Group Admins to allow them to set roles for other members
            $output1 .= '<a>
                <div class="content">
                    <img src="php/images/' . $group_data['img'] . '" alt="">
                    <div class="details">
                        <span>' . $group_data['fname'] . " " . $group_data['lname'] . ' ' . '</span> 
                        <br/> <i id="role">' . $group_data['role'] . '</i>.
                        
                    </div>

                    <div class = "admin-actions">
                        <a href="change_role.php?user_id='.$group_data['unique_id'].'"><i class="fa fa-pencil" title="Change Role"></i></a>
                        <a href="delete_member.php?user_id='.$group_data['unique_id'].'"><i class="fas fa-trash" title="Remove User"></i></a>
                    </div>';
                    // Check the status and conditionally add the $offline variable to the class
                    if ($group_data['status'] == "Offline now") {
                        $output1 .= '<div class="status-dot '. $offline . '"><i class="fas fa-circle"></i></div>';
                    } else {
                        $output1 .= '<div class="status-dot"><i class="fas fa-circle"></i></div>';
                    }
        $output1 .= '</div> </a>';
            
            // Output2 wil be displayed for ordinary members to disallow them from setting roles for group members
            $output2 .= '<a href="#">
            <div class="content">
                <img src="php/images/' . $group_data['img'] . '" alt="">
                <div class="details">
                    <span>' . $group_data['fname'] . " " . $group_data['lname'] . ' ' . '</span> 
                    <br/> <i id="role">' . $group_data['role'] . '</i>.
                </div>
            </div>';
        
        // Check the status and conditionally add the $offline variable to the class
        if ($group_data['status'] == "Offline now") {
            $output2 .= '<div class="status-dot '. $offline . '"><i class="fas fa-circle"></i></div>';
        } else {
            $output2 .= '<div class="status-dot"><i class="fas fa-circle"></i></div>';
        }
        $output2 .= '</a>';
        
            
             $_SESSION['user_id'] = $group_data['unique_id'];
            // $_GET['user_id'] = $group_data['unique_id'];
        }
        // <a href="add_admin.php?user_id='. $group_data['unique_id'] .'">

    } 
    elseif (mysqli_num_rows($query) == 0) {
        $output1 .= "No User available for this group.";
        $output2 .= 'No User available for this group';
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
} 
else {
    echo "Group ID is not available";
}
?>
