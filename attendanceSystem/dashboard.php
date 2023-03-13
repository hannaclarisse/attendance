<?php
include_once('sql/scripts.php');
$dbh = new databaseHandler;
$id = $_SESSION["user_id"];
$userData = $dbh->getUserInfo($id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <script src="https://kit.fontawesome.com/b463120fe4.js" crossorigin="anonymous"></script>
    <script src="dashboardProfile.js"></script>
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container-fluid justify-content-between">
            <div style="margin-left:45px">

                <h1 class="text-light"> <i class="fa-solid fa-user"></i> Welcome <?php echo $userData->fName; ?>! </h1>
            </div>
            <div style="margin-right:45px">
                <a href="logout.php"> Sign out</a>
                <button class="btn btn-primary" style="margin-left:15px" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"> Settings </button>
            </div>

            <!-- Dito maglalagay ng name ni user ?php echo $userData->fName; ? -->
        </div>
    </nav>

    <div class="d-flex justify-content-between">
        <div style="margin-left:45px">
            <h1 id="timeNow"></h1>
        </div>
        <div style="margin-right:45px; margin-top:15px;">
            <button class="btn btn-primary timein" data-status="timein" id="timein" type="button">Time in</button>
            <button class="btn btn-primary timeout" data-status="timeout" id="timeout" type="button">Time out</button>
        </div>
    </div>
    <div class="container" style="margin-bottom:15px;">
        <div class="shadow-sm px-3 py-4 bg-white my-2">
            <h4> Attendance Stats</h4>
            <div class="row">
                <div class="col-auto">
                    <div class="h5 fw-light">Highest</div>
                    <div><span id="highHrs" class="text-primary h4">0</span> hrs <span id="highMin" class="text-primary h5 ps-2">0</span> mins
                    </div>
                    <div id="highDate" class="text-secondary" style="font-size: 12px;"></div>
                </div>
                <div class="col-auto">
                    <div class="h5 fw-light">Lowest</div>
                    <div><span id="lowHrs" class="text-primary h4">0</span> hrs <span id="lowMin" class="text-primary h5 ps-2">0</span> mins
                    </div>
                    <div id="lowDate" class="text-secondary" style="font-size: 12px;"></div>
                </div>
            </div>
            <div class="row row-cols-6 g-1 my-3" id="calendarHeatmap"></div>
            <div class="d-flex justify-content-end">
                <small class="me-3"><span class="bg-info heatmap d-inline-block"></span> Under Time</small>
                <small class="me-3"><span class="bg-primary heatmap d-inline-block"></span> Normal</small>
                <small class="me-3"><span class="bg-success heatmap d-inline-block"></span> Over Time</small>
            </div>
        </div>
        <div class="card">

        </div>
        <table class="table table-bordered table-striped" id="resultTable">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Date and Time</th>
                </tr>
            </thead>
            <tbody id="attendance">

            </tbody>
        </table>

    </div>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Settings</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h2 class="text-capitalize"><?php echo $dbh->getFullname($id); ?></h2>
            <!--  -->
            <p>Email Address: <?php echo $dbh->getValueByID('email', $id); ?></p>
            <p>Contact Number: <?php echo $dbh->getValueByID('contact', $id); ?></p>
            <!-- <button class="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" type="button">Edit Profile</button> -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Edit Profile
            </button>
        </div>
    </div>
    <!-- end -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


    <script src="dashboard.js"></script>
    <link rel="stylesheet" href="dashboard.css">
</body>

<!-- MODAL -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" type="button" aria-current="page" id="profileInfo">Edit Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" type="button" id="passBtn">Change Password</a>
                    </li>
                </ul>

                <form id="profileForm">
                    <div class="row">
                        <div class="col">
                            <div class="row g-2">
                                <div class="col">
                                    <div class="mb-3 ">
                                        <label for="lastName" class="form-label">*Last Name</label>
                                        <input type="text" class="form-control" id="lName" name="lName" value="<?php echo $dbh->getValueByID('lName', $id); ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3 ">
                                        <label for="firstName" class="form-label">*First Name</label>
                                        <input type="text" class="form-control" id="fName" name="fName" value="<?php echo $dbh->getValueByID('fName', $id); ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3 ">
                                        <label for="middleName" class="form-label">Middle Initials </label>
                                        <input type="text" class="form-control" id="mName" name="mName" value="<?php echo $dbh->getValueByID('mName', $id); ?>" placeholder="(optional)">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 ">
                                        <label for="Email" class="form-label">*Email Address </label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $dbh->getValueByID('email', $id); ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3 ">
                                        <label for="ContactNumber" class="form-label">*Contact Number </label>
                                        <input type="text" class="form-control " name="contact" value="<?php echo $dbh->getValueByID('contact', $id); ?>">
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="alert alert-danger mt-3" role="alert" id="alertError">
                            </div>
                            <div class="alert alert-success mt-3" role="alert" id="alertSuccess">
                            </div> -->
                            <button type="submit" name="upload" class="btn btn-primary form-control mt-3">Save Changes</button>
                        </div>
                    </div>
                    <!-- </div> -->
                </form>

                <form id="changePassForm" class="row g-3 p-3  ms-auto me-auto" style="width: 400px;">
                    <div class="col-12 fw-bold">
                        <label for="inputAddress" class="form-label">Current Password:</label>
                        <input type="password" class="password form-control" id="inputAddressOld" name="oldPass" required>
                    </div>
                    <div class="col-12 fw-bold">
                        <label for="inputAddress" class="form-label">New Password:</label>
                        <input type="password" class="password form-control" id="inputAddressNew" name="newPass" required>
                    </div>
                    <div class="col-12 fw-bold">
                        <label for="inputAddress" class="form-label">Confirm Password:</label>
                        <input type="password" class="password form-control" id="inputAddressConfirm" name="confirmPass" required>
                    </div>

                    <div class="alert alert-danger mt-3 form-control" role="alert" id="errorPass">
                    </div>

                    <div class="mt-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-3 mb-5 float-right" id="savepass" name="savepass">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

</html>