<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <!-- Includes -->
    <link rel="stylesheet" href="register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="register.js"></script>
</head>
<body>
<main class="bg-image d-flex align-items-center vh-100 py-3 px-5">
        <div class="form-container py-3 px-5 m-auto">
            <div class="mb-3 text-center">
                <h3 class="fw-normal mb-0">Time and Attendance System</h3>
                <small class="fw-bolder">REGISTRATION</small>
            </div>
            <hr>
            <form id="registrationForm">
                <div class="row row-cols-1 row-cols-md-3 g-2">
                    <div class="col">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name*</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middleName" id="middleName">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name*</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" required>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-2">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address*</label>
                            <input type="email" class="form-control" name="email" id="email" required email>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="contactNumber" class="form-label">Contact Number*</label>
                            <input type="text" class="form-control" name="contactNumber" id="contactNumber" required>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-2">
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" class="form-control" name="password" id="password" required minlength="8">
                            <small class="text-secondary">Password must be at least 8 characters </small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password*</label>
                            <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                        </div>
                    </div>
                </div>

                <div class="alert alert-danger" role="alert" id="errorAlert">
                    {{ errorMessage }}
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                    <button class="btn btn-primary me-md-2 px-5" type="submit">
                        <span>Register</span>
                        <div id="registerSpinner" class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <div class="form-text fw-bolder">Already have an account? <a href="../index.php" class="text-info text-decoration-none" style="cursor: pointer;">Log in</a></div>
                </div>
            </form>
            <div class="alert alert-success mt-3" role="alert" id="successAlert">
                Registration Completed! Proceed to <a href="../index.php" class="alert-link text-decoration-none">Log in page</a>.
            </div>
        </div>

    </main>
</body>
</html>