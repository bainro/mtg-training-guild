<?php
//login.php
require_once 'header_no_log_msg.php';
echo "<div class='main'><h3>Please enter your details to log in</h3>";
$error = $user = $pass = "";

if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else {
        //create token and salt then pass to query on next line
        $pass2 = $pass . 'kxz*';
        $pass3 = '*Dxp-' . $pass2;
        $token = hash('ripemd128', "$pass3");
        $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$token'");

        if ($result->num_rows == 0) {
            $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
        } else {
            $_SESSION['user'] = $user;
            echo "<script>window.location='members.php?view=$user'</script>";         
        }
    }
}

echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span><input type='text'
      maxlength='16' name='user' value='$user'><br>
    <span class='fieldname'>Password</span><input type='password'
      maxlength='16' name='pass' value='$pass'>
_END;
?>

<br>
<span class='fieldname'>&nbsp;</span>
<input type='submit' value='Login'>
</form><br></div>
</body>
</html>
