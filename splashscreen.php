<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatterbox- Unbox your Conversation</title>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/7cab3097e7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito&family=Roboto&display=swap" rel="stylesheet" />
    <!-- end of font awesome -->
    <link rel="stylesheet" href="css/splashscreen.css">
</head>
<body>
    <div class="splash">
        <img src="../ChatterBox/images/logo.png" alt="">
        <div class="loader">
            <div class="loader-text" id="loaderText"></div>
        </div>
    </div>
    <script src="javascript/splashscreen.js"></script>
</body>
</html>