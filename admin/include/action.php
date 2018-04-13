<?php
//action.php
 $isSession=0;

require_once('session.php');
require_once("config.php");
require_once("function.php");

if(isset($_POST["action"]))
{
    //delete image from news
    if($_POST["action"] == "delete")
     {
      $query = "UPDATE article set media='' WHERE article_id = '".$_POST["image_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'Image Deleted from Database';
      }else{
          echo "error in image deleting";
      }
     }
    //delete news
    if($_POST["action"] == "delete_news")
     {
      $query = "DELETE FROM article WHERE article_id = '".$_POST["article_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //delete news
    if($_POST["action"] == "chagne_news_status")
     {
        $sql = "SELECT `is_active` FROM article WHERE article_id='".$_POST["article_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";
          
           }
           $query = "UPDATE article set is_active='$change_status' WHERE article_id = '".$_POST["article_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
     //category delete
     if($_POST["action"] == "delete_category")
     {
      $query = "UPDATE bussiness_stream set is_removed='1' WHERE id = '".$_POST["category_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //change category status
    if($_POST["action"] == "change_category_status")
     {
        $sql = "SELECT `is_active` FROM bussiness_stream WHERE id='".$_POST["category_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";

           }
           $query = "UPDATE bussiness_stream set is_active='$change_status' WHERE id = '".$_POST["category_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
      //company delete
     if($_POST["action"] == "delete_company")
     {
      $query = "UPDATE company set is_removed='1' WHERE id = '".$_POST["company_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //change category status
    if($_POST["action"] == "change_company_status")
     {
        $sql = "SELECT `is_active` FROM company WHERE id='".$_POST["company_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";

           }
           $query = "UPDATE company set is_active='$change_status' WHERE id = '".$_POST["company_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
     //delete news
    if($_POST["action"] == "delete_gallery")
     {
      $query = "DELETE FROM company_image WHERE id = '".$_POST["gallery_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //change gallery status
    if($_POST["action"] == "change_gallery_status")
     {
        $sql = "SELECT `is_active` FROM company_image WHERE id='".$_POST["gallery_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";

           }
           $query = "UPDATE company_image set is_active='$change_status' WHERE id = '".$_POST["gallery_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
     //user delete
     if($_POST["action"] == "delete_user")
     {
      $query = "UPDATE user_account set is_delete='1' WHERE id = '".$_POST["user_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //change user status
    if($_POST["action"] == "change_user_status")
     {
        $sql = "SELECT `is_active` FROM user_account WHERE id='".$_POST["user_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";

           }
           $query = "UPDATE user_account set is_active='$change_status' WHERE id = '".$_POST["user_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
      //approve user
    if($_POST["action"] == "approve_user")
     {
        $sql = "SELECT `is_approved` FROM user_account WHERE id='".$_POST["user_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
            $query = "UPDATE user_account set is_approved='1' WHERE id = '".$_POST["user_id"]."'";

            if(mysqli_query($db, $query))
            {
                $html="<i class='fa fa-check-circle fa-2x green'></i>";
                echo $html;
            }else{
                echo "error";
            }
            }
     }
     //delete image from user
    if($_POST["action"] == "delete_profile_pic")
     {
      $query = "UPDATE user_account set user_image='' WHERE id = '".$_POST["user_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'Image Deleted from Database';
      }else{
          echo "error in image deleting";
      }
     }
      //job delete
     if($_POST["action"] == "delete_job")
     {
      $query = "UPDATE job_post set is_delete='1' WHERE id = '".$_POST["job_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //change user status
    if($_POST["action"] == "change_job_status")
     {
        $sql = "SELECT `is_active` FROM job_post WHERE id='".$_POST["job_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";

           }
           $query = "UPDATE job_post set is_active='$change_status' WHERE id = '".$_POST["job_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
     //delete experience detail
    if($_POST["action"] == "delete_experience")
     {
      $query = "DELETE FROM experience_detail WHERE id = '".$_POST["exp_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //delete experience detail
    if($_POST["action"] == "delete_education")
     {
      $query = "DELETE FROM education_detail WHERE id = '".$_POST["edu_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //delete job application
    if($_POST["action"] == "delete_applied_job")
     {
      $query = "DELETE FROM job_post_activity WHERE id = '".$_POST["job_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //delete testimonial
    if($_POST["action"] == "delete_testimonial")
     {
      $query = "DELETE FROM testimonial WHERE id = '".$_POST["testimonial_id"]."'";
      if(mysqli_query($db, $query))
      {
            echo 'success';
      }else{
          echo "error";
      }
     }
     //delete news
    if($_POST["action"] == "change_testimonial_status")
     {
        $sql = "SELECT `is_active` FROM testimonial WHERE id='".$_POST["testimonial_id"]."' ";
        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        if($count == 1) {
           $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
           $is_active = $row['is_active'];
           if($is_active=='1'){
            $change_status="0";
            $html ="<i class='fa fa-ban fa-2x red'></i>";

           }else{
            $change_status="1";
            $html="<i class='fa fa-check-circle fa-2x green'></i>";

           }
           $query = "UPDATE testimonial set is_active='$change_status' WHERE id = '".$_POST["testimonial_id"]."'";
            if(mysqli_query($db, $query))
            {
                echo $html;
            }else{
                echo "error";
            }
            }
     }
}

if(isset($_POST["state_id"]) && !empty($_POST["state_id"])){
    //Get all city data
    $query = $db->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display cities list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>