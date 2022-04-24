<?php
require_once ('../vendor/connect.php');
function get_categories(){
    global $connect;
    $sql ="SELECT * FROM categories";
    $result = mysqli_query($connect,$sql);
    $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $categories;
}


function get_courses(){
    global $connect;
    $sql ="SELECT * FROM courses";
    $result = mysqli_query($connect,$sql);
    $courses = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return $courses;
}

function get_course_by_id($post_id){
    global $connect;

    $sql = "SELECT * FROM courses WHERE id= ".$post_id;

    $result=mysqli_query($connect,$sql);

    $course = mysqli_fetch_assoc($result);

    return $course;
}
