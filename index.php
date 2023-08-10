<?php
include("./dbms_connect.php");

if(isset($_POST["register"])) {
  
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql1 = sprintf("INSERT INTO `student` (`student_name`, `student_email`, `student_password`, `roll_no`, `college`, `degree`, `degree_year`, `stream`) 
    VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');",$_POST["name"],$_POST["email"],$_POST["password"],$_POST["rollno"],$_POST["college"],$_POST["degree"],$_POST["degree_year"],$_POST["stream"])  ;
    if(mysqli_query($conn,$sql1)){
      
      alert_box('Registered successfully \nPlease Login to continue');
      // header("location: ./index.php");

    }
      elseif (mysqli_errno($conn)==1062) {
      alert_box("Username Taken ");
      header("location: ./register.php");
      
    }
    elseif (mysqli_errno($conn)==1366) {
      alert_box("Enter the value corectly");
    }
    else {
      alert_box(mysqli_errno($conn) . mysqli_error($conn));
    }

}else{
  alert_box("Fill all fields");
  
}

}

if(isset($_POST["enrol_course"])){
  echo $_SESSION["email"];
  $sql1 = sprintf("Insert INTO enroled_course(student_id,avail_course_id) VALUE((SELECT student.student_id FROM student WHERE student.student_email= \"%s\"),%s)",$_SESSION["email"],$_POST["enrol_course"]);
  if(mysqli_query($conn,$sql1)){
    alert_box("Registered Successfully \nPlease Login to continue");
    header("location: EnrolCourse.php");
  }
  else{
    alert_box(mysqli_error($conn));
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Enrol for a Course</title>
    <link rel="stylesheet" href="reg_css.css" />
  </head>
  <body>
    <div class="bg-image home-bg welcome"></div>
    <div class="container cont_index">
      <h2>COURSE MANAGEMENT SYSTEM</h2>
      <span
        >Shop 100,000+ High-Quality On-Demand Online Courses! Find the right
        instructor for you. Expert Instructors. Download To Your Phone. Over
        50,000 Instructors. Lifetime Access. Courses in 60+ Languages. Over
        130,000 Courses.</span
      >
      <h3>-A Project By Harpal</h3>
      <a id="login" href="register.php" class="button5 btn_log">Register </a>
      <a id="login" href="login.php" class="button5 btn_inx">Login </a>
    </div>
  </body>
  <style>
    body {
      background-image: url(img/home8.jpg);

      font-family: "Times New Roman", Times, serif;
    }
    .btn_log {
      left: 53%;
      top: 75%;
      width: 250px;
    }
    .btn_inx {
      left: 10%;
      top: 75%;
      width: 250px;
    }
    h2 {
      margin-left: 15%;
      color: white;
      /* font-size:large; */
      font-weight: bolder;
    }
    span {
      margin-left: 0%;
    }
    h3 {
      margin-left: 60%;
    }
  </style>
</html>
