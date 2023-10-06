<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ChatterBox
  </title>
  <link rel="icon" href="../ChatterBox/images/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet">

  <!-- Script to Log User Out whenever they are Inactive for some secs.. here we use 30 secs -->
  <script>
    // Get the ID of the logged in User
    var userId = <?php echo isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : 'null'; ?>;

  // set the time for system to timeout
    const inactivityTimeout = 0.5 * 60 * 1000; // 15 minutes in milliseconds
    let inactivityTimer;

    // Function to clear and set timeout
    function resetInactivityTimer(userId) {
      clearTimeout(inactivityTimer);
      inactivityTimer = setTimeout(function() {
        // Redirect to logout page or trigger a logout function
        window.location.href = 'php/logout.php?logout_id=' + userId;
      }, inactivityTimeout);
    }
    resetInactivityTimer(userId);

    document.addEventListener('mousemove', function() {
      resetInactivityTimer(userId);
    });

    document.addEventListener('keydown', function() {
      resetInactivityTimer(userId);
    });
  </script>
</head>
<?php
// include_once "navbar.php"; 
?>