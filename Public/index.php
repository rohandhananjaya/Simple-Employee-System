<?php   
    session_start();  
    if(!isset($_SESSION["user"]))  
    {
        header("location:login.php");  
    }  
 
    $title="Home";
    include_once '../Modules/header.php';
    include_once '../Modules/core-func.php';
    include_once '../Modules/nav-bar.php';
    include_once '../Modules/conn.php';

    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) && isset($_POST['email'])){
        $required = array(
            'fname',
            'phone',
        );

        $invalid = chk_empty($required);

        if ($invalid)
        {
            $err = "Required fields are missing!";
        }else{
            $conn = new PDO($attr, $user, $pass, $opts);
            $fname = fix_wquote_string($conn, $_POST["fname"]);
            $lname = fix_wquote_string($conn, $_POST["lname"]);
            $phone = fix_wquote_string($conn, $_POST["phone"]);
            $email = fix_wquote_string($conn, $_POST["email"]);
            try
            {
                $timestamp = date('Y-m-d H:i:s');
                $query = "INSERT INTO employee (fname, lname, phone, email,timest) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($query);
                $stmt->execute([$fname, $lname, $phone, $email, $timestamp]);
                $success = true;
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
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link mt-4" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-square"></i></div>
                                Add New Employee
                            </a>
                            <a class="nav-link" href="emp-list.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-th-list"></i></div>
                                All Employees
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION["user"] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4 pb-4">
                    <div class="row justify-content-center mb-4 mt-4">
                            <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    Enter the new employee data
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
                                         if (isset($success))
                                            {
                                        ?>
                                        <div class="alert alert-primary" role="alert">
                                            Employee added
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    <form method="post">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputFname" name="fname" maxlength="50" type="text" placeholder="John" />
                                                    <label for="inputFname">First name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputLname" name="lname" maxlength="50" type="text" placeholder="Doe" />
                                                    <label for="inputLname">Last name</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputPhone" name="phone" maxlength="12" type="text" placeholder="+9471123456" />
                                                    <label for="inputPhone">Phone number</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="inputEmail" name="email" maxlength="50" type="email" placeholder="User" required/>
                                                    <label for="inputEmail">Email address</label>
                                                </div>
                                                <div class="mt-4 mb-0">
                                                    <div class="d-grid"><a class="btn btn-primary btn-block" name="register" onclick="this.closest('form').submit();return false;">Add</a></div>
                                                </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                    </div>
                </main>
            <?php include_once "../Modules/footer.php"; ?>    
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../res/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../res/assets/demo/chart-area-demo.js"></script>
        <script src="../res/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../res/js/datatables-simple-demo.js"></script>
    </body>
</html>
