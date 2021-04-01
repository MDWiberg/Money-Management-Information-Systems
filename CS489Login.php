<?php
   require "CS489header.php";
?>

   <main>
      <h1> Login </h1>
         <?php
            if (isset($_GET['error'])) {
               if ($_GET['error'] == "emptyfields") {
                  echo '<p class="loginerror"> Please fill in all fields.</p>';
               }
               else if ($_GET['error'] == "invalidusername") {
                  echo '<p class="loginerror"> Invalid username.</p>';
               }
               else if ($_GET['error'] == "usernametaken") {
			   	   echo '<p class="loginerror"> Username is taken.</p>';
               }
            }

         ?>

      <form action="CS489Login2.php" method="post">
	      <input type="text" name="uid" placeholder="Username...">
	      <input type="password" name="pid" placeholder="Password...">
	      <button type="submit" name="L2-submit"> Login </button>
      </form>

   </main>

<?php
   require "CS489footer.php";
?>