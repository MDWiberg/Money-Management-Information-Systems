<?php
   session_start();
?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="description" content="THIS IS AN EXAMPLE of meta description.">
      <meta name=viewport content="width=device-width, initial-scale=1">
      <title></title>
      <!--<link rel="stylesheet" href="style.css">-->
   </head>
   <body>

      <header>
         <nav>

            <a href="#">
               <img src="img from file" name="logo">
            </a>

            <ul>
               <li><a href="CS489ProfileHomepage.php"> Home </a></li>
               <li><a href="aboutMM.php"> About </a></li>
            </ul>

            <div>
               <?php
               if (isset($_SESSION['accID'])) {
			      echo '<form action="CS489Logout.php" method="post">
                        <button type="submit" name="LO-submit"> Logout </button>
                        </form>';
			      }
			      else {
			         echo '<form action="CS489Login.php" method="post">
			           // <input type="text" name="uid" placeholder="Username...">
			           // <input type="password" name="pid" placeholder="Password...">
			                  <button type="submit" name="L-submit"> Login </button>
                        </form>
                        <a href="CS489NewUser.php"> New User </a>';
               }
               ?>

            </div>

         </nav>
      </header>