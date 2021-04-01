<?php
   require "CS489header.php";
?>

<style>
.form-li{
	display: inline;
}
</style>

<main>
   <div class="wrapper-main2">

   	  <h2> Income Information </h2>

      <form class="form-li" action="CS489uAccount2.php" method="post">
      	  Add Income Source:
	  	  <input type="text" name="incN-a" placeholder="Income source...">
	  	  <input type="text" name="incA-a" placeholder="Income amount...">
	  	  <button type="submit" name="IncA-submit"> Add Expense </button>
      </form>
      <p>

      <form class="form-li" action="CS489uAccount2.php" method="post">
      	  Update Income Source Name:
	  	  <input type="text" name="incN-u" placeholder="Existing Name...">
	  	  <input type="text" name="incN-uN" placeholder="New Name...">
	  	  <button type="submit" name="IncUname-submit"> Update Expense </button>
      </form>
      <p>

      <form class="form-li" action="CS489uAccount2.php" method="post">
	      Update Income Source Amount:
	      <input type="text" name="incN-u" placeholder="Existing name...">
	  	  <input type="text" name="incA-u" placeholder="Existing amount...">
	  	  <input type="text" name="incA-uN" placeholder="New amount...">
	  	  <button type="submit" name="IncUamount-submit"> Update Expense </button>
	  </form>
      <p>

      <form class="form-li" action="CS489uAccount2.php" method="post">
      	  Remove Income Source:
	  	  <input type="text" name="incN-d" placeholder="Remove income source...">
	  	  <input type="text" name="incA-d" placeholder="Remove income amount...">
	  	  <button type="submit" name="IncD-submit"> Remove Expense </button>
      </form>
      <p>

      <h2> Expense Information </h2>

      <form class="form-li" action="CS489uAccount3.php" method="post">
      	  Add Expense Source:
	  	  <input type="text" name="expN-a" placeholder="Expense source...">
	  	  <input type="text" name="expA-a" placeholder="Expense amount...">
	  	  <button type="submit" name="expA-submit"> Add Expense </button>
      </form>
      <p>

      <form class="form-li" action="CS489uAccount3.php" method="post">
      	  Update Expense Source Name:
	  	  <input type="text" name="expN-u" placeholder="Existing name...">
	  	  <input type="text" name="expN-uN" placeholder="New name...">
	  	  <button type="submit" name="expUname-submit"> Update Expense </button>
      </form>
      <p>

      <form class="form-li" action="CS489uAccount3.php" method="post">
	      Update Expense Source Amount:
	      <input type="text" name="expN-u" placeholder="Existing name...">
	  	  <input type="text" name="expA-u" placeholder="Existing amount...">
	  	  <input type="text" name="expA-uN" placeholder="New amount...">
	  	  <button type="submit" name="expUamount-submit"> Update Expense </button>
	  </form>
      <p>

	  <form class="form-li" action="CS489uAccount3.php" method="post">
	  	  Remove Expense Source:
	  	  <input type="text" name="expN-d" placeholder="Expense source...">
	  	  <input type="text" name="expA-d" placeholder="Expense amount...">
	  	  <button type="submit" name="expD-submit"> Update Expense </button>
      </form>


   </div>
</main>

<?php
   require "CS489footer.php";
?>

