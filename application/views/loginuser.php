<!-- login -->
<?php
    // error message
    $msg = "";
    // check user
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // check email and password fields
        if(empty($this->input->post("email")) && empty($this->input->post("pass"))){
            $msg = "Enter email and password";
        }
        // check email input field
        elseif(empty($this->input->post("email"))){
            $msg = "Enter a valid email adress";
        }
        // check email format
        elseif(!filter_var($this->input->post("email"),FILTER_VALIDATE_EMAIL)){
            $msg = "Invalid email format";
        }
        // check password input field
        elseif(empty($this->input->post("pass"))){
            $msg = "Enter password";
        }
        else{
            // check email and password
            $email = $this->input->post("email");
            $pass = $this->input->post("pass");
            $valid = $this->login_m->check($email,$pass);
            if($valid == true){
                redirect(base_url(),"refresh");
                die();
            }
            else{
                $msg = "Wrong email or password";
            }
        }
    }
?>
<html lang="en">
<head>
    <!-- meta tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- import google roboto font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- import google icon font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- import materialize css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- import custom css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/custom.css">
    <!-- web title -->
    <title>Naik Store</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url() ?>assets/site.webmanifest">
    <!-- use roboto font -->
    <style>
    html {
        font-family: 'Roboto', sans-serif;
        color: #212121;
    }
    </style>
</head>
<body>
    <!-- main section -->
    <main>
        <!-- login form -->
        <div class="centered center">
            <div class="card">
                <div class="card-content">
                    <h4 style="margin-bottom: 45px"><a href="<?php echo base_url() ?>" style="color: #212121">Naik Store</a></h4>
                    <form action="<?php echo base_url("user/login") ?>" method="post">
                    <span class="err"><?php echo $msg ?></span>
                    <span class="scs"><?php echo $this->session->flashdata("msg") ?></span>
                        <div class="input-field">
                            <input type="text" name="email" id="email">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="pass" id="pass">
                            <label for="pass">Password</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-cap pink pink-darken-hover button-hover waves-effect waves-light z-depth-0" style="width: 250px; margin-top: 15px; margin-bottom: 50px">Log In</button>
                        <a href="#">Forgot Password?</a>
                    </form>
                </div>
            </div>
            <p style="margin-top: 25px; margin-bottom: 50px">Don't have an account? <a href="<?php echo base_url("user/register") ?>">Sign Up</a></p>
        </div>
    </main>
    <!-- import jquery js -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- import materialize js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>