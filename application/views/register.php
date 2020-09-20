<!-- register -->
<?php
    // error message
    $msg = "";
    // register
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // check name input field
        if(empty($this->input->post("name"))){
            $msg = "Enter name";
        }
        //check name format
        elseif(!preg_match("/^[a-zA-Z ]*$/",$this->input->post("name"))){
            $msg = "Invalid name format";
        }
        // check email input field
        elseif(empty($this->input->post("email"))){
            $msg = "Enter a valid email adress";
        }
        // check email format
        elseif(!filter_var($this->input->post("email"),FILTER_VALIDATE_EMAIL)){
            $msg = "Invalid email format";
        }
        // check pass input field
        elseif(empty($this->input->post("pass"))){
            $msg = "Enter password";
        }
        // check pass length
        elseif(strlen($this->input->post("pass")) < 8){
            $msg = "Password is too short";
        }
        // check pass2 input field
        elseif(!empty($this->input->post("pass")) && empty($this->input->post("pass2"))){
            $msg = "Confirm password";
        }
        else{
            // check pass and pass2
            $pass = $this->input->post("pass");
            $pass2 = $this->input->post("pass2");
            if($pass == $pass2){
                $nama = $this->input->post("name");
                $email = $this->input->post("email");
                // user status
                $status = "1";
                if($adm == "true"){
                    $status = "2";
                }
                // check email
                $valid = $this->register_m->add($nama,$email,$pass,$status);
                if($valid == true){
                    $this->session->set_flashdata("msg", "Email registration success");
                    redirect(base_url("user/login"),"refresh");
                    die();
                }
                else{
                    $msg = "Email already registered";
                }
            }
            else{
                $msg = "Wrong confirmation password";
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
        <!-- register form -->
        <div class="centered center">
            <div class="card">
                <div class="card-content">
                    <h4 style="margin-bottom: 45px"><a href="<?php echo base_url() ?>" style="color: #212121">Naik Store</a></h4>
                    <?php 
                        $newadm = "";
                        if($adm == "true"){
                            $newadm = "?adm=true";
                        }
                    ?>
                    <form action="<?php echo base_url("user/register$newadm") ?>" method="post">
                    <span class="err"><?php echo $msg ?></span>
                        <div class="input-field">
                            <input type="text" name="name" id="name">
                            <label for="name">Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="email" id="email">
                            <label for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="pass" id="pass">
                            <label for="pass">Password</label>
                        </div>
                        <div class="input-field">
                            <input type="password" name="pass2" id="pass2">
                            <label for="pass2">Confirm Password</label>
                        </div>
                        <button type="submit" name="register" class="btn btn-cap pink pink-darken-hover button-hover waves-effect waves-light z-depth-0" style="width: 250px; margin-top: 15px">Sign Up</button>
                    </form>
                </div>
            </div>
            <p style="margin-top: 25px; margin-bottom: 50px">Have an account? <a href="<?php echo base_url("user/login") ?>">Log In</a></p>
        </div>
    </main>
    <!-- import jquery js -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- import materialize js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>