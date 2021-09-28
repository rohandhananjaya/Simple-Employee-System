<?php
$title = "Register";
include_once '../Modules/header.php';
include_once '../Modules/core-func.php';
include_once '../Modules/conn.php';

session_start();
if (isset($_SESSION["user"]))
{
    header("location:index.php");
}

if (isset($_POST['user']))
{

    $conn = new PDO($attr, $user, $pass, $opts);
    $usr = fix_string($conn, $_POST["user"]);
    $query = "SELECT * FROM users WHERE username=$usr";
    $result = $conn->query($query);

    if ($result->rowCount() == 0)
    {

        $required = array(
            'fname',
            'email',
            'phone',
            'password'
        );

        $invalid = chk_empty($required);

        if ($invalid)
        {
            $err = "Required fields are missing!";
        }
        else
        {
            $unm = fix_wquote_string($conn, $_POST["user"]);
            $fname = fix_wquote_string($conn, $_POST["fname"]);
            $lname = fix_wquote_string($conn, $_POST["lname"]);
            $phone = fix_wquote_string($conn, $_POST["phone"]);
            $email = fix_wquote_string($conn, $_POST["email"]);
            $pwd_1 = fix_wquote_string($conn, $_POST["password"]);
            $pwd_2 = fix_wquote_string($conn, $_POST["rpassword"]);
            if ($pwd_1 == $pwd_2)
            {
                try
                {
                    $query = "INSERT INTO users (username, password, fname, lname, phone, email) VALUES (?,?,?,?,?,?)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$unm, $pwd_1, $fname, $lname, $phone, $email]);
                    $reg = true;
                    $conn = null;
                }
                catch(PDOException $e)
                {
                    throw new PDOException($e->getMessage() , (int)$e->getCode());
                    $err = "System error! - Please contact system admin";
                }
            }
            else
            {
                $err = "Passwords does not match!";
            }
        }

    }
    else
    {
        $err = "User name already taken";
    }
    $conn = null;
}

?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <?php
                                    if (isset($reg))
                                    {
                                ?>
                                    <div class="alert alert-success text-center mt-7" role="alert">
                                        Successfully registered on the system! <a href="login.php">Go to login</a></div>
                                    </div>
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Create New Account</h3></div>
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
                                        <form method="post">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputUname" name="user" maxlength="50" type="text" placeholder="John_905" />
                                                    <label for="inputUname">User name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputFname" name="fname" maxlength="50" type="text" placeholder="John" />
                                                    <label for="inputFname">First name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputLname" name="lname" maxlength="50" type="text" placeholder="Doe" />
                                                    <label for="inputLname">Last name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPhone" name="phone"  maxlength="12" type="text" placeholder="+9471123456" />
                                                    <label for="inputPhone">Phone number</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" name="email" maxlength="50" type="email" placeholder="User" required/>
                                                    <label for="inputEmail">Email address</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPassword" name="password" maxlength="50" type="password" placeholder="Password" required/>
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputRPassword" name="rpassword" maxlength="50" type="password" placeholder="Re-type Password" required/>
                                                    <label for="inputRPassword">Re-type Password</label>
                                                </div>
                                                <div class="mt-4 mb-0">
                                                    <div class="d-grid"><a class="btn btn-primary btn-block" name="register" onclick="this.closest('form').submit();return false;">Register</a></div>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                                <?php
} ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
