<?php

//MySQLi  or PDO
   //connect to database
   $conn = mysqli_connect('localhost', 'shaun', 'text1234', 'ninja_pizza');

   //check the connection to make sure it works
   if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
   }

?>