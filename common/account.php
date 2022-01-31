<?php 
require_once "functions.php";
require_once "config.php";
session_start();

$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);

    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, name, password FROM users WHERE name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){ 
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;    
                            header("location: ../index.php");
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>
    <?= t_header("Log In", true)?>
    <body>
        <div class="loginpanel">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "post">
                <div class="txt">
                    <input id="user" type="text" name = "username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" /><br>
                <span><?php echo $username_err; ?></span>
                </div>
                <div class="txt">
                    <input id="pwd" type="password" name="password"<?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Password" /><br>
                    <span><?php echo $password_err; ?></span>
                </div>
                <?php 
                        if(!empty($login_err)){
                            echo $login_err;
                        }        
                ?>  
                <div class="buttons">
                    <input type="submit" value="Login">
                    <a href="register.php">
                        <input type = "button" value = "Register">
                    </a>
                </div>
            </form>
        </div>
    </body>
</html>         