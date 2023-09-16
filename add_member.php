<?php 
  session_start();
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
    <!-- <a href="groups.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
    <a href="group_members.php?group_id=<?php echo $_SESSION['group_id'] ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
      <header>Add New Member</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Role</label>
          <select name="role" id="role">
            <option value="Group Admin"> Group Admin</option>
            <option value="Member">Member</option>
          </select>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Add Member">
        </div>
      </form>
    </section>
  </div>
  <script src="javascript/add_member.js"></script>

</body>
</html>
