<?php

	session_start();
	$dbID = $_SESSION['accID'];

	if(isset($_POST['IncA-submit'])){

	   require "dbHandler.php";

	   $iName = $_POST['incN-a'];
	   $iAmt = $_POST['incA-a'];

	   if(empty($iName) || empty($iAmt)){
	      header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfields");
	      exit();
	   }
	   else if (!preg_match("/^([0-9]*|([0-9]*|0)\.[0-9]{2})$/",$iAmt)) {
	      header("Location: ../~mdwiberg/CS489uAccount.php?error=invalidamount");
	      exit();
	   }

	   else{
	         $sql = "SELECT INC_N FROM INCOME WHERE INC_N=?";
	         $stmt = mysqli_stmt_init($connect);


	         if(!mysqli_stmt_prepare($stmt, $sql)){
	            header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
	            exit();
	         }
	         else3{
	            mysqli_stmt_bind_param($stmt, "s", $iName);
	            mysqli_stmt_execute($stmt);
	            mysqli_stmt_store_result($stmt);
	            $dbCheck = mysqli_stmt_num_rows($stmt);


	            if($dbCheck > 0){
	               header("Location: ../~mdwiberg/CS489uAccount.php?error=namealreadyexists");
	               exit();
                }

                else{
       	              $sql = "INSERT INTO INCOME (ID,INC_N,INC_A) VALUES (?, ?, ?)";
			          $stmt = mysqli_stmt_init($connect);

			          if(!mysqli_stmt_prepare($stmt, $sql)){
			             header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
			             exit();
			          }
                      else{
			             mysqli_stmt_bind_param($stmt, "isd", $dbID, $iName, $iAmt);
				         mysqli_stmt_execute($stmt);
				         header("Location: ../~mdwiberg/CS489uAccount.php?update=success");
			             exit();
                      }
                }
             }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($connect);
	}
	else if(isset($_POST['IncUname-submit'])){

		   require "dbHandler.php";

		   $iName = $_POST['incN-u'];
		   $iNewName = $_POST['incN-uN'];
		   $idbID = $_SESSION['accID'];

		   if(empty($iName) || empty($iNewName)){
		   	  header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfields");
		   	  exit();
		   }

		   else{
		   	      $sql = "SELECT INC_ID,INC_N FROM INCOME WHERE INC_N=? AND ID=?";
		   	      $stmt = mysqli_stmt_init($connect);


		   	      if(!mysqli_stmt_prepare($stmt, $sql)){
		   	         header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
		   	         exit();
		   	      }
		   	      else{
		   	              mysqli_stmt_bind_param($stmt, "si", $iName, $idbID);
		   	              mysqli_stmt_execute($stmt);
		   	              mysqli_stmt_store_result($stmt);
		   	              $dbCheck = mysqli_stmt_num_rows($stmt);
		   	              mysqli_stmt_bind_result($stmt, $idbINCID, $iExistingName);
		   	              mysqli_stmt_fetch($stmt);


		   	              if($dbCheck == 0){
		   	                 header("Location: ../~mdwiberg/CS489uAccount.php?error=namedoesnotexists");
		   	                 exit();
                          }
		                  else{
		                          $sql = "UPDATE INCOME set INC_N=? WHERE INC_N=? AND ID=? AND INC_ID=?";
		   		                  $stmt = mysqli_stmt_init($connect);

		   	                      if(!mysqli_stmt_prepare($stmt, $sql)){
		   		                  header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
		   	                      exit();
		   		                  }
		                          else{
		   			                      mysqli_stmt_bind_param($stmt, "ssi", $iNewName, $iName, $idbID, $idbINCID);
		   		                          mysqli_stmt_execute($stmt);
		   				                  header("Location: ../~mdwiberg/CS489uAccount.php?update=success");
		   			                      exit();
		                          }
	                       }
	               }
	         }

	         mysqli_stmt_close($stmt);
             mysqli_close($connect);
	}

	else if(isset($_POST['IncUamount-submit'])){

			   require "dbHandler.php";

			   $iName = $_POST['incN-u'];
			   $iAmt = $_POST['incA-u'];
			   $iNewAmt = $_POST['incA-uN'];
			   $idbID = $_SESSION['accID'];

			   if(empty($iAmt) || empty($iNewAmt) || empty($iName)){
			   	  header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfields");
			   	  exit();
			   }
			   else if (!preg_match("/^([0-9]*|([0-9]*|0)\.[0-9]{2})$/",$iAmt)) {
			      header("Location: ../~mdwiberg/CS489uAccount.php?error=invalidamount");
			   	  exit();
	           }
			   else if (!preg_match("/^([0-9]*|([0-9]*|0)\.[0-9]{2})$/",$iNewAmt)) {
			      header("Location: ../~mdwiberg/CS489uAccount.php?error=invalidamount");
			   	  exit();
	           }

			   else{
			   	      $sql = "SELECT INC_A FROM INCOME WHERE INC_N=? AND ID=?";
			   	      $stmt = mysqli_stmt_init($connect);


			   	      if(!mysqli_stmt_prepare($stmt, $sql)){
			   	         header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
			   	         exit();
			   	      }
			   	      else{
			   	              mysqli_stmt_bind_param($stmt, "si", $iName, $idbID);
			   	              mysqli_stmt_execute($stmt);
			   	              mysqli_stmt_store_result($stmt);
			   	              $dbCheck = mysqli_stmt_num_rows($stmt);
			   	              mysqli_stmt_bind_result($stmt, $iExistingAmt);
                              mysqli_stmt_fetch($stmt);



			   	              if($dbCheck == 0){
			   	                 header("Location: ../~mdwiberg/CS489uAccount.php?error=amountdoesnotexists");
			   	                 exit();
	                          }
                              else if(!$iAmt == $iExistingAmt){
                                 header("Location: ../~mdwiberg/CS489uAccount.php?error=existingamountdoesnotmatch");
                                 exit();
                              }
			                  else{
			                         $sql = "UPDATE INCOME set INC_A=? WHERE INC_A=? AND ID=?";
			   		                 $stmt = mysqli_stmt_init($connect);

			   	                     if(!mysqli_stmt_prepare($stmt, $sql)){
			   		                    header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
			   	                        exit();
			   		                 }
			                         else{
			   			                    mysqli_stmt_bind_param($stmt, "ddi", $iNewAmt, $iAmt, $idbID);
			   		                        mysqli_stmt_execute($stmt);
			   				                header("Location: ../~mdwiberg/CS489uAccount.php?update=success");
			   			                    exit();
			                         }
		                      }
		              }
		       }

		       mysqli_stmt_close($stmt);
	           mysqli_close($connect);
	}

	else if(isset($_POST['IncD-submit'])){

		   require "dbHandler.php";

		   $iName = $_POST['incN-d'];
		   $idbID = $_SESSION['accID'];

		   if(empty($iName)){
		      header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfield");
		      exit();
		   }

		   else{
		   	      $sql = "SELECT INC_N FROM INCOME WHERE INC_N=? AND ID=?";
		   		  $stmt = mysqli_stmt_init($connect);


		   		  if(!mysqli_stmt_prepare($stmt, $sql)){
		   		     header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
		   			 exit();
		   		  }
		   		  else{
		   		          mysqli_stmt_bind_param($stmt, "si", $iName, $idbID);
		   	              mysqli_stmt_execute($stmt);
		   		          mysqli_stmt_store_result($stmt);
		   		          $dbCheck = mysqli_stmt_num_rows($stmt);


		   		          if($dbCheck == 0){
		   		             header("Location: ../~mdwiberg/CS489uAccount.php?error=namedoesnotexists");
		   		             exit();
	                      }

		                  else{
		                          $sql = "DELETE FROM INCOME WHERE INC_N=? AND ID=?";
		                          $stmt = mysqli_stmt_init($connect);

		                          if(!mysqli_stmt_prepare($stmt, $sql)){
		                             header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
		                             exit();
		                          }
		                          else{
		                                  mysqli_stmt_bind_param($stmt, "si", $iName, $idbID);
		                                  mysqli_stmt_execute($stmt);
		                                  header("Location: ../~mdwiberg/CS489uAccount.php?update=success");
		                                 exit();
		                          }
		                  }
		           }
		    }
	              mysqli_stmt_close($stmt);
                  mysqli_close($connect);
	}

	else{
		header("location: ../~mdwiberg/CS489uAccount.php");
    	exit();
	}

