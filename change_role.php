<?php 
  session_start();
  include_once "../ChatterBox/php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; 
$user_id = $_GET['user_id'];
// $current_role = $_GET['current_role'];
$group_id = $_SESSION['group_id'];
?>

<body>
  <div class="wrapper">
    <section class="form signup">
    <!-- <a href="group_members.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
    <a href="group_members.php?group_id=<?php echo $_SESSION['group_id'] ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <header>Change User Role</header>
      <form action="delete_member.php?user_id=<?php echo $user_id; ?>" method="POST" enctype="multipart/form-data" autocomplete="off" id="role_form">
        <div class="error-text" id="error-text"></div>
        <div class="field input">
          <label>Select Role:</label>
          <select name="role" id="role">
            <option value="">- - -</option>
            <option value="Group Admin"> Group Admin</option>
            <option value="Member">Member</option>
          </select>
        </div>
        <div class="field button">
          <input type="submit" name="NEW_ROLE" value="Update Role" id="btn_change_role">
        </div>
      </form>
    </section>
  </div>
</body>
</html>

<!-- Validation and Insertion  -->

<?php

if(isset($_GET['user_id'])){
    if(isset($_POST['NEW_ROLE'])){
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        if(empty($role)){
            echo '<script>';
                echo 'let errorMessage = "Please Select a new role";';
                echo 'let errorDiv = document.getElementById("error-text");';
                echo 'errorDiv.textContent = errorMessage;';
            echo '</script>';
        }
        else{
            $user_id = $_GET['user_id'];
           
            //Check User existing role before Updating Role
            $sql = "SELECT role FROM group_members WHERE user_id = {$user_id} AND group_id = {$group_id}";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                $existing_role= $row['role'];
                $current_role = $existing_role;
                // echo $existing_role;
                if( $existing_role == 'Super Admin'){
                    echo '<script>';
                        echo 'let errorMessage = "You cannot change Super Admin Role";';
                        echo 'let errorDiv2 = document.getElementById("error-text");';
                        echo 'errorDiv2.textContent = errorMessage;';
                    echo '</script>';
                }
                else{
                    $Update_sql = "UPDATE group_members SET role = '$role' WHERE user_id = '$user_id' AND group_id = '$group_id'";
                    if ((mysqli_query($conn, $Update_sql))) {
                        echo '<script>';
                            echo 'let errorMessage = "User Role has been changed Successfully";';
                            echo 'let errorDiv3 = document.getElementById("error-text");';
                            echo 'errorDiv3.style.backgroundColor = "#28a745";';
                            echo 'errorDiv3.style.color = "#fff";';
                            echo 'errorDiv3.textContent = errorMessage;';
                            
                            // echo 'alert("User Role has been changed successfully";';
                        echo '</script>';
                        // sleep(5);
                    } 
                    
                    else {
                        echo "<script>alert('Error Updating User Information') </script>" . $sql . "<br>" . mysqli_error($conn);
                    }
                }
     
            }
            
        }
        
            // header("Location: group_members.php?group_id= echo $_SESSION.['group_id'] ");
            // exit;
       

    }
}

?>