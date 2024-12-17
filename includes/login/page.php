<?php
function login_head($title)
{
    return '
    <head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        <title>' . MAIN_TITLE . ' - ' . $title . '</title>
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    ';
}

function login_body($err_msg)
{
    $logout_template = '';
    $err_template = '';
    if ($err_msg != null) {
        $err_template = '
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col"><span class="badge badge-danger">' . $err_msg . '</span></div>
            <div class="col"></div>
        </div>
    </div>';
    }

    if (isset($_GET['logged_out'])) {
        $logout_template = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully Logged out</strong>
        </div>';
    }

    return '<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="img/logo.png" style="width:90%;" class="rounded mx-auto d-block" alt="test">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                '.login_form($err_template, $logout_template).'
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end of container -->
    <script src="js/sb-admin-2.min.js"></script>
</body>';
}

function login_form($err_template, $logout_template){
    return '
    <!-- form -->
    <form class="user" method="post" action="login.php">
        <div class="form-group">
            <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" required placeholder="Enter Email Address...">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" required>
        </div>
        ' . $err_template . '
        ' . $logout_template . '
        <button type="submit" name="login_button" class="btn btn-primary btn-user btn-block">
            Login
        </button>
    </form>
    <!-- end of form -->';
}

function login($profile)
{
    $err_msg  = '';
    if (isset($_POST['login_button'])) {
        $id = verifyUser($_POST['username'], $_POST['password']);
        if ($id > 0) {
            header("Location: index.php");
        }else {
            $err_msg = "Invalid username or password";
        }
        
    }
    return '
    <!DOCTYPE html>
    <html lang="en">¨
        ' . login_head($profile['page-title']) . '
        ' . login_body($err_msg) . '
    </html>
    ';
}
