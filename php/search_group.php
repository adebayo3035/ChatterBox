<?php
    session_start();
    include_once "config.php";

    $creator_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM groups WHERE NOT creator_id = {$creator_id} AND (group_name LIKE '%{$searchTerm}%' OR group_description LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include_once "group_data.php";
    }else{
        $output .= 'No group found related to your search term';
    }
    echo $output;
?>