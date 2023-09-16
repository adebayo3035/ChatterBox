<?php
    session_start();
    include_once "config.php";
    $user_id = $_SESSION['user_id'];
    $group_id = $_SESSION['group_id'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
//     Check User existing role before Updating Role
$sql = "SELECT role FROM group_members WHERE user_id = {$user_id} AND group_id = {$group_id}";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query) > 0){
     $row = mysqli_fetch_assoc($query);
     $existing_role= $row['role'];
     if($existing_role == "Super Admin"){
          echo "You cannot modify the role of a Super Admin";
     }
     else{
          $Update_sql = "UPDATE group_members SET role = '$role' WHERE user_id = '$user_id' AND group_id = '$group_id'";
          if ((mysqli_query($conn, $Update_sql))) {
                    echo "User Role has been successfully Modified";
          } 
          else {
               echo "<script>alert('Error Updating User Information') </script>" . $sql . "<br>" . mysqli_error($conn);
          }

     }
}

?>