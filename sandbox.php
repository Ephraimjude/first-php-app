<?php 

//ternary operators
//alt to use in if statements
//$score = 50;

//if($score > 40){
    //echo "You passed";     //executed when score is greater than or equal to 40
//}else{
    //echo "Low score";       
//}

//ternary operator makes the code neater!!!
//echo $score > 40 ? 'high score' : 'low score';

//superglobals
#$_SERVER
//echo $_SERVER['SERVER_NAME'] . '<br />';
//echo $_SERVER['REQUEST_METHOD'] . '<br/>';
//echo $_SERVER['SCRIPT_FILENAME'] . '<br/>';
//echo $_SERVER['PHP_SELF'] . '<br/>';

#$_SESSIONS

if(isset($_POST['submit'])) {

    //cookie for gender
    setcookie('gender', $_POST['gender'], time() + 86400);


    session_start();   #starting a new session for this request

    $_SESSION['name'] = $_POST['name'];

    header ("Location:index.php"); 
    
}

#$_COOKIES



    
 
?>
<html lang="en">
<body>

<form method="POST" action="<?php  echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="name">
        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    <input type="submit" value="submit" name="submit">
</form>    

</body>
</html>