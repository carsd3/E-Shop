<?php
require_once "functions.php";
session_start();
?>
    <?= t_header("Register", true)?>
    <body>
        <div class="loginpanel">
            <form id = "reg" action="register_db.php" method = "GET">
                <div class="txt">
                    <input id="user" name = "username" type="text" placeholder="Username" />
                </div>
                <div class="txt">
                    <input id="pwd" type="password" name = "pwd" placeholder="Password" onchange = 'check_pass();'/>
                </div>
                <div class="txt">
                    <input id="r_pwd" type="password" placeholder="Repeat your Password" onchange = 'check_pass();'/>
                </div>
                <script>
                    function check_pass() {
                        if (document.getElementById('pwd').value ==
                                document.getElementById('r_pwd').value) {
                            document.getElementById('submit').disabled = false;
                        } else {
                            document.getElementById('submit').disabled = true;
                        }
                    }
                </script>
                <div class="buttons">
                    <a href="../index.php">
                        <input type="submit" name="submit"  value="Register"  id="submit" disabled/>
                    </a>
                    <a href="account.php">
                        <input type="button" name="login"  value="Log In"/>
                    </a>
                </div>
            </form>
        </div>
    </body>
</html>      