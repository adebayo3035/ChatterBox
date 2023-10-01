<?php 
  session_start();
  include_once "../ChatterBox/php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; 
// Get the Group ID and the ID of the User trying to change Group Information
$group_id = $_GET['group_id'];
$user_id = $_SESSION['unique_id'];

// Get the Group Info and Display in the HTML form
$sql = "SELECT * FROM groups WHERE group_id = $group_id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $groupData = mysqli_fetch_assoc($result);
    // Save the name of the old group image here so it can be deleted from folder after update
    $old_img_name = $groupData['group_image'];
    // Close the result set
    mysqli_free_result($result);
} else {
    echo "Group Information Cannot be retrieved";
}
// Close the database connection
// mysqli_close($conn);
?>

<body>
  <div class="wrapper">
    <section class="form signup">
    <a href="group_chat.php?group_id=<?php echo $_SESSION['group_id']; ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <header>Edit Group Information</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
      <div class="error-text" id="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Group Name</label>
            <input type="text" name="group_name" placeholder="Enter Group Name" required value = "<?php echo htmlspecialchars($groupData['group_name']); ?>">
          </div>
          <div class="field input">
            <label>Group Description</label>
            <input type="text" name="group_description" placeholder="Group Description" required value ="<?php echo htmlspecialchars($groupData['group_description']); ?>">
          </div>
        </div>
        
        <div class="field image">
          <label>Select Group Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="UPDATE_GROUP" value="Update Info">
        </div>
        
      </form>
    </section>
  </div>

</body>
</html>

<!-- Validation and Insertion  -->

<?php


    if(isset($_POST['UPDATE_GROUP'])){
        $sql = "SELECT role FROM group_members WHERE group_id = $group_id AND user_id = $user_id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $groupData = mysqli_fetch_assoc($result);
            $User_role= $groupData['role'];
            echo $User_role;
            if(($User_role == 'Super Admin') || ($User_role == 'Group Admin')){
                $group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
                $group_description = mysqli_real_escape_string($conn, $_POST['group_description']);
                

                if (isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
    
                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if (in_array($img_ext, $extensions) === true) {
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if (in_array($img_type, $types) === true) {
                            $time = time();
                            $new_img_name = $time . $img_name;
                            if (move_uploaded_file($tmp_name, "../ChatterBox/php/group_headers/" . $new_img_name)) {
                                $ran_id = rand(time(), 100000000);
                                $update_query = mysqli_query($conn, "UPDATE groups SET group_name = '$group_name', group_description = '$group_description', group_image = '$new_img_name' WHERE group_id = '$group_id'");
                                if ($update_query) {
                                    // Delete Old Group Heder Image from the Group Header Folder
                                    // Delete old picture file
                                    $oldPicturePath = "../ChatterBox/php/group_headers/" . $old_img_name; 
                                    echo $oldPicturePath;
                                    if (file_exists($oldPicturePath)) {
                                        unlink($oldPicturePath);
                                    } 
                                    else {
                                        echo "Old picture file not found.";
                                    }
                                    // Echo Success Message after Update is Successful
                                    echo '<script>';
                                        echo 'let errorMessage = "Group Information has been changed Successfully!";';
                                        echo 'let errorDiv = document.getElementById("error-text");';
                                        echo 'errorDiv.style.backgroundColor = "#28a745";';
                                        echo 'errorDiv.style.color = "#fff";';
                                        echo 'errorDiv.textContent = errorMessage;';
                                    echo '</script>';   
                                } 
                                else {
                                    echo "Something went wrong. Please try again!" . $sql . "<br>" . mysqli_error($conn);
                                }
                            }
                            else{
                                echo "Please upload an image file - jpeg, png, jpg";
                            }
                        } 
                        else {
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    } 
                    else {
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }



            }
            else{
                echo '<script>';
                    echo 'let errorMessage = "You do not have the privilege to Change Group Information";';
                    echo 'let errorDiv1 = document.getElementById("error-text");';
                    echo 'errorDiv1.textContent = errorMessage;';
                echo '</script>';
            }
            
        }
    }
        
       
?>
