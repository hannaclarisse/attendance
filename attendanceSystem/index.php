<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Log-in</title>
</head>

<body>
    <main class="d-flex align-items-center vh-100">
        <div class="form-container py-5 px-5 m-auto">
            <form id="loginForm">
                <div class="mb-3 text-center">
                    <h5 class="fw-normal">Time and Attendance System</h5>
                    <h5 class="fw-bolder">LOGIN</h5>
                </div>
                <hr>
                <div class="mx-3">
                    <div class="form-floating">
                        <input type="text" class="form-control form-control-lg" name="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-0">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="example" required>
                        <label for="floatingInput">Password</label>
                    </div>
                    <div class="text-center">
                        
                        <div class="alert alert-danger my-1" role="alert" id="errorAlert">
                            {{ errorMessage }}
                        </div>
                        <button class="w-100 btn btn-lg btn-primary my-2" type="submit">
                            Sign in
                            <div id="registerSpinner" class="spinner-border spinner-border-sm" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                        <a href="register/register.php" class="fw-bold text-decoration-none text-center">Create an
                            Account</a>
                    </div>
                </div>
            </form>

        </div>
    </main>
    <!-- Includes -->
    <link rel="stylesheet" href="login/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="login/login.js"></script>
</body>

</html>