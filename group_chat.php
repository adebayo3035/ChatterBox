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
    <section class="chat-area">
      <header>
        <?php 
          $group_id = mysqli_real_escape_string($conn, $_GET['group_id']);
          $_SESSION['group_id'] = $group_id;
          $sql = mysqli_query($conn, "SELECT * FROM groups WHERE group_id = {$group_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: groups.php");
          }
        ?>
        <a href="groups.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/group_headers/<?php echo $row['group_image']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['group_name']?></span>
          <p><?php echo $row['group_description']; ?></p>
        </div>

         <a href="group_members.php?group_id=<?php echo $_SESSION['group_id']; ?>">Members</a>

        
        <!-- <a href="group_members.php?group_id='. $group_data['group_id'] .'" class="logout">Members</a> -->
      </header>
      <div class="chat-box"> 

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/group_chat.js"></script>

</body>
</html>
