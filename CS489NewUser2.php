<?php

if(isset($_POST['R-submit'])) {

   require "dbHandler.php";

   $user = $_POST['uid'];
   $password = $_POST['pid'];
   $passwordC = $_POST['pid-confirm'];

   if(empty($user) || empty($password) || empty($passwordC)){
      header("Location: ../~mdwiberg/CS489NewUser.php?error=emptyfields&uid=".$user);
      exit();
   }
   else if (!preg_match("/^[a-zA-Z0-9]*$/",$user)) {
      header("Location: ../~mdwiberg/CS489NewUser.php?error=invalidusername");
      exit();
   }
   else if ($password !== $passwordC) {
      header("Location: ../~mdwiberg/CS489NewUser.php?error=passwordsmustmatch&uid=".$user);
      exit();
   }
   else{
      $sql = "SELECT USERNAME FROM PROFILES WHERE USERNAME=?";
      $stmt = mysqli_stmt_init($connect);


      if(!mysqli_stmt_prepare($stmt, $sql)){
         header("Location: ../~mdwiberg/CS489NewUser.php?error=sqlerror");
         exit();
      }
      else{
         mysqli_stmt_bind_param($stmt, "s", $user);
         mysqli_stmt_execute($stmt);
         mysqli_stmt_store_result($stmt);
         $dbCheck = mysqli_stmt_num_rows($stmt);


         if($dbCheck > 0){
            header("Location: ../~mdwiberg/CS489NewUser.php?error=usernametaken");
            exit();
         }
         else{

            $sql = "INSERT INTO PROFILES (USERNAME,PASSWORD) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($connect);
            if(!mysqli_stmt_prepare($stmt, $sql)){
			      header("Location: ../~mdwiberg/CS489NewUser.php?error=sqlerror");
			      exit();
            }
            else{
               $hashedP = password_hash($password, PASSWORD_DEFAULT);

               mysqli_stmt_bind_param($stmt, "ss", $user, $hashedP);
			      mysqli_stmt_execute($stmt);
			      header("Location: ../~mdwiberg/CS489NewUser.php?register=success");
			      exit();
            }

         }
      }

   }
   mysqli_stmt_close($stmt);
   mysqli_close($connect);

}
else{
   header("location: ../~mdwiberg/CS489NewUser.php");
   exit();
}