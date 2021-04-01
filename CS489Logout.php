<?php

   session_start();
   session_unset();
   session_destroy();
   header("Location: ../CS489ProfileHomepage.php");