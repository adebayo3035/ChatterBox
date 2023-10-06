<?php 
  session_start();
  include_once "../ChatterBox/php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; 
$group_id = $_GET['group_id'];
$user_id = $_SESSION['unique_id'];
?>

<body>

    <div class="wrapper">

        <div class="header-text">
            <a href="groups.php?user_id=<?php echo $_SESSION['unique_id'] ?>" class="back-icon"><i class="fa fa-arrow-left"></i></a>
            <h2> ChatterBox</h2>
            <div class="error-text" id="error-text"></div>
        </div>

        <button onclick="document.getElementById('id01').style.display='block'" id="remove_btn">Delete Group Chat</button>

        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content" action="delete_group.php?group_id=<?php echo $group_id; ?>" method="POST">
            
                <div class="container">
                    <h1>Delete Group Chat</h1>
                    <p>Are you sure you want to Delete this Group Chat?</p>

                    <div class="clearfix">
                        <a href=""></a>
                        <button type="button"  class="cancelbtn">No, Cancel</button>
                        <button type="submit" class="deletebtn" name="DELETE_GROUP" >Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
</body>
</html>

<!-- Validation and PHP DELETE OPERATION  -->

<?php
$deleteSuccess = false;
if(isset($_GET['group_id'])){
    
    if(isset($_POST['DELETE_GROUP'])){
        //Check User existing role before Deleting Group
        $sql = "SELECT role FROM group_members WHERE user_id = {$user_id} AND group_id = {$group_id}";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $user_role= $row['role'];
            
            if( $user_role == 'Super Admin'){
                $sql = "SELECT * FROM groups WHERE group_id = $group_id";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    $groupData = mysqli_fetch_assoc($result);
                    // Save the name of the old group image here so it can be deleted from folder after delete
                    $old_img_name = $groupData['group_image'];

                    // Delete Group Header Picture from Folder
                    $oldPicturePath = "../ChatterBox/php/group_headers/" . $old_img_name; 
                        if (file_exists($oldPicturePath)) {
                            unlink($oldPicturePath);
                    } 
                    else {
                        echo "Old picture file not found.";
                    }

                    // Perform Delete Query to remove all group messages and group members associated to that group
                    $delete_Group = "DELETE FROM groups WHERE group_id = '$group_id'";
                    $delete_Group_Messages = "DELETE FROM group_messages WHERE group_id = '$group_id'";
                    $delete_Group_Members = "DELETE FROM group_members WHERE group_id = '$group_id'";
                
                    //DeleteQuery Results
                    $result_group = mysqli_query($conn, $delete_Group);
                    $result_group_messages = mysqli_query($conn, $delete_Group_Messages);
                    $result_group_members = mysqli_query($conn, $delete_Group_Members);
                    if($result_group && $result_group_messages && $result_group_members){
                        echo '<script>';
                            echo 'let errorMessage = "Group Chat has been Successfully Deleted";';
                            echo 'let errorDiv3 = document.getElementById("error-text");';
                            echo 'errorDiv3.style.backgroundColor = "#28a745";';
                            echo 'errorDiv3.style.color = "#fff";';
                            echo 'errorDiv3.textContent = errorMessage;';
                            echo 'errorDiv3.style.textAlign = "center"';
                           
                        echo '</script>';
                    }
                }
                else{
                    echo "This Group does not exist!";
                }
                
            }
            else{
                echo '<script>';
                echo 'let errorMessage = "You cannot Delete this Group Chat ";';
                echo 'let errorDiv2 = document.getElementById("error-text");';
                echo 'errorDiv2.textContent = errorMessage;';
                echo 'errorDiv2.style.backgroundColor = "#dc3545";';
                echo 'errorDiv2.style.color = "#fff";';
                echo 'errorDiv2.style.textAlign = "center"';
                
            echo '</script>';

            }         
        }
    }
}

?>