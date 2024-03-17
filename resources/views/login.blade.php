<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="login_assets/style.css">
    <title>signin-signup</title>
</head>
<body>
    <div class="container">
        <div class="signin-signup">
            <form action="" class="sign-in-form">
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>
                <!-- Checkbox -->
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me </label>
                    <a href="#">Forgot Password?</a>
                </div>
                <!-- end section Checkbox -->
                <input type="submit" value="Login" class="btn">
                <p class="social-text">Or Sign in with </p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                </div>
                <a href="/homepage" class="small text-muted">Klinik Fanda Berkat Medika Panti</a>
            </form>
            <form action="" class="sign-up-form">
                <h2 class="title">Sign up</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username">
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="text" placeholder="Email">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password">
                </div>
                <input type="submit" value="Sign up" class="btn">
                <p class="social-text">Or Sign Up with </p>
                <div class="social-media">
                    <a href="" class="social-icon">
                        <i class="fab fa-google"></i>
                    </a>
                </div>
                <a href="/homepage" class="small text-muted">Klinik Fanda Berkat Medika Panti</a>
            </form>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Sudah Punya Akun?</h3>
                    <p></p>
                    <img src="login_assets/img/logo.png" alt="" class="image">
                    <button class="btn" id="sign-in-btn">Sign in</button>
                </div>
                
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Belum Punya Akun?</h3>
                    <p></p>
                    <img src="login_assets/img/logo.png" alt="" class="image">
                    <button class="btn" id="sign-up-btn">Sign up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="login_assets/js/login.js"></script>
</body>
</html>