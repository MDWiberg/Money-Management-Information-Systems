<?php
   require "CS489header.php";
?>

   <main>
      <h1> Create Profile </h1>
         <?php
            if (isset($_GET['error'])) {
               if ($_GET['error'] == "emptyfields") {
                  echo '<p class="signuperror"> Please fill in all fields.</p>';
               }
               else if ($_GET['error'] == "invalidusername") {
                  echo '<p class="signuperror"> Invalid username.</p>';
               }
               else if ($_GET['error'] == "passwordsmustmatch") {
			         echo '<p class="signuperror"> Passwords do not match.</p>';
               }
               else if ($_GET['error'] == "usernametaken") {
			   	   echo '<p class="signuperror"> Username is taken.</p>';
               }
            }
            else if ($_GET["register"] == "sucess") {
               echo '<p class="signupsuccess"> Profile successfully created!</p>';
            }
         ?>
      <form action="CS489NewUser2.php" method"post">
         <input type="text" name="uid" placeholder="Username...">
         <input type="password" name="pid" placeholder="Password...">
         <input type="password" name="pid-confirm" placeholder="Re-enter password...">
         <button type="submit" name="R-submit"> Create Profile </button>
      </form>

   </main>

<?php
   require "CS489footer.php";
?>