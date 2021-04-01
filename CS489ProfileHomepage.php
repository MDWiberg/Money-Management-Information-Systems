<?php
   require "CS489header.php";
?>

   <main>
      <div class="wrapper-main">
         <?php
            if (isset($_SESSION['accID'])) {
               echo '<p class="login-status"> Logged In. </P>';
            }
            else {
               echo '<p class="login-status"> Logged out. </P>';
            }
         ?>
      </div>
   </main>

<?php
   require "CS489footer.php";
?>