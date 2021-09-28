<?php
$title = "Login";
include_once '../Modules/header.php';
include_once '../Modules/core-func.php';

session_start();
if (isset($_SESSION["user"]))
{
    header("location:index.php");
}
if (isset($_POST['user']))
{
    include_once '../Modules/conn.php';
    if (empty($_POST["user"]) || empty($_POST["password"]))
    {
        $err = "All fields are required!";
    }
    else
    {
        try
        {
            $conn = new PDO($attr, $user, $pass, $opts);
            $usr = fix_string($conn, $_POST["user"]);
            $pwd = fix_string($conn, $_POST["password"]);
            $query = "SELECT * FROM users WHERE username=$usr AND password=$pwd";
            $result = $conn->query($query);
            if ($result->rowCount() == 0)
            {
                $err = "Invalid user name or password!";
            }
            else
            {
                $_SESSION["user"] = $_POST["user"];
                header("location:index.php");
            }
            $conn = null;
        }
        catch(PDOException $e)
        {
            throw new PDOException($e->getMessage() , (int)$e->getCode());
            $err = "System error! - Please contact system admin";
        }
    }

}
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            if (isset($err))
                                            {
                                        ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $err ?>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <?php
                                            if (isset($_GET['logout']))
                                            {
                                        ?>
                                        <div class="alert alert-primary" role="alert">
                                            You are now logged out
                                        </div>
                                        <?php
                                            }
                                        ?>
                                        <form action="login.php" method="post">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUser" name="user" type="text" placeholder="User" />
                                                <label for="inputUser">User name</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><a class="btn btn-primary btn-block" name="login" onclick="this.closest('form').submit();return false;">Login</a></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../res/js/scripts.js"></script>
    </body>
</html>