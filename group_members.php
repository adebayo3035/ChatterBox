<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
    
        <section class="users">
        <a href="group_chat.php?group_id=<?php echo $_SESSION['group_id'] ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <div class="search">
        <span class="text">Search for Group Member</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
            <div class="users-list">

            </div>
        </section>
    </div>
    <script src="javascript/group_members.js"></script>
</body>