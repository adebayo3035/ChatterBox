<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $group_name = mysqli_real_escape_string($conn, $_POST['group_name']);
    $group_description = mysqli_real_escape_string($conn, $_POST['group_description']);
    $creator_id = $_SESSION['unique_id'];
    if (!empty($group_name) && !empty($group_description)) {
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
                    if (move_uploaded_file($tmp_name, "group_headers/" . $new_img_name)) {
                        $ran_id = rand(time(), 100000000);
                        $insert_query = mysqli_query($conn, "INSERT INTO groups (group_id, creator_id, group_name, group_description, group_image)
                        VALUES ({$ran_id}, '{$creator_id}','{$group_name}', '{$group_description}', '{$new_img_name}')");

                        $insert_query2 = mysqli_query($conn, "INSERT INTO group_members (group_id, user_id, role, membership_status)
                        VALUES ({$ran_id}, '{$creator_id}', 'Super Admin', 'Active')");
                        if ($insert_query && $insert_query2) {
                            echo $success_message = "Group has been Created Successfully!";
                        } else {
                            echo "Something went wrong. Please try again!";
                        }
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            } else {
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }
        echo "Please Enter Group Name or Group Description";
    }
}
