<?php

   if(isset($_POST['L2-submit'])) {

      require "dbHandler.php";

      $user = $_POST['uid'];
      $password = $_POST['pid'];

      if(empty($user) || empty($password)) {
         header("location: ../~mdwiberg/CS489ProfileHomepage.php?error=emptyfields");
         exit();
      }
      else {

         $sql = "SELECT * FROM PROFILES WHERE USERNAME=?;";
         $stmt = mysqli_stmt_init($connect);

         if(!mysqli_stmt_prepare($stmt, $sql)){
		      header("Location: ../~mdwiberg/CS489ProfileHomepage.php?error=sqlerror");
		      exit();
		   }
         else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $dbResult = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($dbResult)) {
               $passwordCk = password_verify($password, $row['PASSWORD']);

               if ($passwordCk == false){
                  header("Location: ../~mdwiberg/CS489ProfileHomepage.php?error=wrongpassword");
		            exit();
               }
               else if ($passwordCk == true) {
                  session_start();
                  $_SESSION['accID'] = $row['ID'];
                  $_SESSION['accUSER'] = $row['USERNAME'];

                  header("Location: ../~mdwiberg/CS489ProfileHomepage.php?login=success");
		            exit();
               }
               else {
                  header("Location: ../~mdwiberg/CS489ProfileHomepage.php?error=wrongpassword");
		            exit();
               }
            }
            else {
               header("Location: ../~mdwiberg/CS489ProfileHomepage.php?error=nouser");
		         exit();
            }
         }

      }

   }
   else{
      header("Location: ../~mdwiberg/CS489ProfileHomepage.php");
      exit();
   }