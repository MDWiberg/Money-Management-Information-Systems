<?php

        session_start();
        $dbID = $_SESSION['accID'];

	if(isset($_POST['expA-submit'])){

	   require "dbHandler.php";

	   $iName = $_POST['expN-a'];
	   $iAmt = $_POST['expA-a'];

	   if(empty($iName) || empty($iAmt)){
	      header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfields");
	      exit();
	   }
	   else if (!preg_match("/^([0-9]*|([0-9]*|0)\.[0-9]{2})$/",$iAmt)) {
	      header("Location: ../~mdwiberg/CS489uAccount.php?error=invalidamount");
	      exit();
	   }

	   else{
	      $sql = "SELECT EXP_N FROM EXPENSE WHERE EXP_N=?";
	      $stmt = mysqli_stmt_init($connect);


	      if(!mysqli_stmt_prepare($stmt, $sql)){
	         header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
	         exit();
	      }
	      else{
	         mysqli_stmt_bind_param($stmt, "s", $iName);
	         mysqli_stmt_execute($stmt);
	         mysqli_stmt_store_result($stmt);
	         $dbCheck = mysqli_stmt_num_rows($stmt);


	         if($dbCheck > 0){
	            header("Location: ../~mdwiberg/CS489uAccount.php?error=namealreadyexists");
	            exit();
                 }

                 else{
       	            $sql = "INSERT INTO EXPENSE (ID,EXP_N,EXP_A) VALUES (?, ?, ?)";
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
	else if(isset($_POST['expUname-submit'])){

		   require "dbHandler.php";

		   $iName = $_POST['expN-u'];
		   $iNewName = $_POST['expN-uN'];
           $idbID = $_SESSION['accID'];

		   if(empty($iName) || empty($iNewName)){
		   	  header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfields");
		   	  exit();
		   }
		   else{
		      $sql = "SELECT EXP_ID,EXP_N FROM EXPENSE WHERE EXP_N=? AND ID=? ";
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
                 mysqli_stmt_bind_result($stmt, $idbEXPID, $iExistingName);
                 mysqli_stmt_fetch($stmt);

	   	         if($dbCheck == 0){
	   	            header("Location: ../~mdwiberg/CS489uAccount.php?error=namedoesnotexists");
	   	            exit();
                 }
                 else{

		               $sql = "UPDATE EXPENSE set EXP_N=? WHERE EXP_N=? AND ID=? AND EXP_ID=?";
		               $stmt = mysqli_stmt_init($connect);

                       if(!mysqli_stmt_prepare($stmt, $sql)){
		   	              header("Location: ../~mdwiberg/CS489uAccount.php?error=sqlerror");
		   	              exit();
		   	           }
		               else{
		   	                  mysqli_stmt_bind_param($stmt, "ssii", $iNewName, $iName, $idbID, $idbEXPID);
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
	else if(isset($_POST['expUamount-submit'])){

			   require "dbHandler.php";

               $iName = $_POST['expN-u'];
			   $iAmt = $_POST['expA-u'];
			   $iNewAmt = $_POST['expA-uN'];
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
	                  $sql = "SELECT EXP_A FROM EXPENSE WHERE EXP_N=? AND ID=?";
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
                             else if($iAmt != $iExistingAmt){
                                header("Location: ../~mdwiberg/CS489uAccount.php?error=existingamountdoesnotmatch");
                                exit();
                             }
			                 else{
                                    $sql = "UPDATE EXPENSE set EXP_A=? WHERE EXP_A=? AND ID=?";
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
	else if(isset($_POST['expD-submit'])){

		   require "dbHandler.php";

		   $iName = $_POST['expN-d'];
           $idbID = $_SESSION['accID'];

		   if(empty($iName)){
		      header("Location: ../~mdwiberg/CS489uAccount.php?error=emptyfield");
		      exit();
		   }
		   else{
		      $sql = "SELECT EXP_N FROM EXPENSE WHERE EXP_N=? AND ID=?";
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
                            $sql = "DELETE FROM EXPENSE WHERE EXP_N=? AND ID=?";
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