<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
    <a href="groups.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <header>Create Group Chat</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
      <div class="error-text "></div>
        <div class="name-details">
          <div class="field input">
            <label>Group Name</label>
            <input type="text" name="group_name" placeholder="Enter Group Name" required>
          </div>
          <div class="field input">
            <label>Group Description</label>
            <input type="text" name="group_description" placeholder="Group Description" required>
          </div>
        </div>
        
        <div class="field image">
          <label>Select Group Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Create Group">
        </div>
        
      </form>
    </section>
  </div>
  <script src="javascript/create_group.js"></script>

</body>
</html>
