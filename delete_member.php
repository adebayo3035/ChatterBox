<?php 
  session_start();
  include_once "../ChatterBox/php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; 
$user_id = $_GET['user_id'];
$group_id = $_SESSION['group_id'];
?>

<body>

    <div class="wrapper">

        <div class="header-text">
            <a href="group_members.php?group_id=<?php echo $_SESSION['group_id'] ?>" class="back-icon"><i class="fa fa-arrow-left"></i></a>
            <h2> ChatterBox</h2>
            <div class="error-text" id="error-text"></div>
        </div>

        <button onclick="document.getElementById('id01').style.display='block'" id="remove_btn">Remove Member</button>

        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content" action="delete_member.php?user_id=<?php echo $user_id; ?>" method="POST">
            
                <div class="container">
                    <h1>Remove User</h1>
                    <p>Are you sure you want to Remove this User?</p>

                    <div class="clearfix">
                        <a href=""></a>
                        <button type="button"  class="cancelbtn">No, Cancel</button>
                        <button type="submit" class="deletebtn" name="REMOVE_USER">Yes, Remove</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
</body>
</html>

<!-- Validation and Insertion  -->

<?php
$deleteSuccess = false;
if(isset($_GET['user_id'])){
    if(isset($_POST['REMOVE_USER'])){
        //Check User existing role before Updating Role
        $sql = "SELECT role FROM group_members WHERE user_id = {$user_id} AND group_id = {$group_id}";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $user_role= $row['role'];
            // echo $existing_role;
            if( $user_role == 'Super Admin'){
                echo '<script>';
                    echo 'let errorMessage = "You cannot Remove Super Admin";';
                    echo 'let errorDiv2 = document.getElementById("error-text");';
                    echo 'errorDiv2.textContent = errorMessage;';
                echo '</script>';
                
            }
            else{
                $Update_sql = "UPDATE group_members SET membership_status = 'Removed' WHERE user_id = '$user_id' AND group_id = '$group_id'";
                    if ((mysqli_query($conn, $Update_sql))) {
                        if($user_id == $_SESSION['unique_id'] ){
                            header("Location: groups.php");
                        }
                        else{
                            echo '<script>';
                            echo 'let errorMessage = "Member has been Successfully Removed";';
                            echo 'let errorDiv3 = document.getElementById("error-text");';
                            echo 'errorDiv3.style.backgroundColor = "#28a745";';
                            echo 'errorDiv3.style.color = "#fff";';
                            echo 'errorDiv3.textContent = errorMessage;';
                        echo '</script>';

                        }
                    } 
                    
                    else {
                        echo "<script>alert('Error Updating User Information') </script>" . $sql . "<br>" . mysqli_error($conn);
                    }
            }
    }
}
}

?>