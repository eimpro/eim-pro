<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AdminCP2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body class="login">
        <header class="master-header">
            <div class="master-title">iBooking CRS</div>
            <nav>
                <div class="header-nav">
                    <ul class="nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="images/flag-uk.png"> English
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">English</a>
                                <a class="dropdown-item" href="#">Japanese</a>
                                <a class="dropdown-item" href="#">Chinese</a>
                                <a class="dropdown-item" href="#">Vietnamese</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <section class="login-panel mt-5">
            <h1 class="login-title text-center">Sign In</h1>
            <form action="logi.php" method="post" class="login-form mt-5 mx-auto" style="max-width: 300px;">
                <div class="form-group">
                    <label for="username"><i class="fa fa-user"></i> Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" autofocus class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
        </section>
        <!-- ... -->
        <!-- Add Bootstrap JS at the end of the body -->
        <script src="//code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
