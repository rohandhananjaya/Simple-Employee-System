<?php   
    session_start();  
    if(!isset($_SESSION["user"]))  
    {
        header("location:login.php");  
    }  
 
    $title="Home";
    include_once '../Modules/header.php';
    include_once '../Modules/nav-bar.php';
    include_once '../Modules/conn.php';
    ?>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link mt-4" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-plus-square"></i></div>
                                Add New Employee
                            </a>
                            <a class="nav-link" href="#">
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
                    <div class="container-fluid px-4">
                        <div class="card mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Registered employees
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Created date/time</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Created date/time</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    try
                                    {
                                        $conn = new PDO($attr, $user, $pass, $opts);
                                        $query = "SELECT * FROM employee";
                                        $result = $conn->query($query);
                                        
                                        while ($row = $result->fetch(PDO::FETCH_NUM)) {
                                            echo '<tr>';
                                            echo '<td>'.$row[0].'</td>';
                                            echo '<td>'.$row[1].'</td>';
                                            echo '<td>'.$row[2].'</td>';
                                            echo '<td>'.$row[3].'</td>';
                                            echo '<td>'.$row[4].'</td>';
                                            echo '<td>'.$row[5].'</td>';
                                            echo '</tr>';
                                        }

                                        $conn = null;
                                    }
                                    catch(PDOException $e)
                                    {
                                        throw new PDOException($e->getMessage() , (int)$e->getCode());
                                        $err = "System error! - Please contact system admin";
                                    }
                                    ?>
                                        
                                    </tbody>
                                </table>
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
