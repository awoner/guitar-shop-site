<?php
class UserController {
    public function signIn(){
        session_start();
        if(!isset($_SESSION['user']))
            require_once "app/resources/signin_content.php";
        else
            header("Location: /cabinet");
    }

    public function signOut(){
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header("Location:/signin");
    }

    public function activation($activation){
        include "configuration.php";
        require "app/models/UserModel.php";
        $activation_text = file_get_contents($APP_NAME."/app/models/text.txt");
        $array = explode(" ", $activation_text);
        $activation_text = $array[0];
        $email = $array[1];
        if($activation === $activation_text){
            if(empty(UserModel::check(array(':activation' => $activation)))){

                $fields = array(':activation' => $activation);

                UserModel::update($fields, array(':email' => $email));

                session_start();
                $_SESSION['activated'] = true;
                header("Location:/cabinet");
            }else{
                echo $errorBuilder::errMsg("Your account is already activated!<br>");
            }
        }else{
            echo $errorBuilder::errMsg("Wrong activation code!<br>");
        }
        require "app/resources/footer.php";
    }

    public function registration(){
        include "configuration.php";
        require "app/models/UserModel.php";

        if(isset($_POST['button'])) {
            session_start();
            $secretKey = "6LeMYl0UAAAAALZxi-VBoEc2cXEECwGM3nWtDN2s";
            $response = $_POST['g-recaptcha-response'];
            $userIp = $_SERVER['REMOTE_ADDR'];
            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIp";
            $response = file_get_contents($url);
            if(strpos($response, 'true')) {

                $name = $_POST['name'];
                $email = $_POST['email'];
                $password1 = $_POST['password1'];
                $password2 = $_POST['password2'];
                $err_msg = [];
                $error = false;

                if (!$this->nameValidation($name)) {
                    $err_msg[] = "Wrong name";
                    $error = true;
                }
                if (!$this->emailValidation($email)) {
                    $err_msg[] = "Wrong email";
                    $error = true;
                }
                if (!$this->passwordValidation($password1)) {
                    $err_msg[] = "Wrong password";
                    $error = true;
                }
                if (strcmp($password1, $password2) !== 0) {
                    $err_msg[] = "The second password does not match the first one";
                    $error = true;
                }

                $email_check = UserModel::check(array(':email' => $email));

                $user_check = UserModel::userCheck(array(':name' => $name),
                    array(':email' => $email),
                    array(':password' => $password1));

                if (!empty($user_check) && !empty($email_check)) {
                    $err_msg[] = "This email already exists";
                    $error = true;
                }

                if (!$error) {
                    $base_url = "http://www.cw.com/";

                    $activation = md5($email . time());

                    $fields = array(':name' => $name,
                        ':email' => $email,
                        ':password' => $password1);
                    file_put_contents($APP_NAME . "/app/models/text.txt", $activation);
                    file_put_contents($APP_NAME . "/app/models/text.txt", " " . $email, FILE_APPEND);

                    UserModel::insert($fields);

                    $to = $email;
                    $charset = 'utf-8';
                    $subject = "Check Email";
                    $body = 'Hi, <br/> <br/> Activation! Please click on the links to activate your account.<br>'
                        . date("d.m.Y", time()) .
                        '<br/> <br/> <a href="' . $base_url .
                        'activation/' . $activation . '">' . $base_url . 'activation/' . $activation . '</a>';

                    $headers = "MIME-Version: 1.0 \r\n";
                    $headers .= "From: cw.guitar.keren@gmail.com \r\n";
                    $headers .= "Reply-To: cw.guitar.keren@gmail.com \r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
                    $headers .= "Content-Type: text/html; charset=$charset \r\n";

                    if (mail($to, $subject, $body, $headers)) {
                        echo $errorBuilder::okMsg("Registration completed successfully! Get activation via email.</br>");
                    } else {
                        echo $errorBuilder::errMsg("Mail error!<br>");
                    }
                } else {
                    echo $errorBuilder::errMsg(explode($err_msg, ", ") . "! Try again.<br>");
                    require "app/resources/registration_content.php";
                }
            }else{
                echo $errorBuilder::errMsg("Wrong captcha input! Try again.<br>");
                require "app/resources/registration_content.php";
            }
        }else{
            require "app/resources/registration_content.php";
        }
    }

    private function nameValidation($name) : bool{
        if(strlen($name) > 2 && $name[0] === strtoupper($name[0]) ){
            return true;
        }else{
            return false;
        }
    }
    private function emailValidation($email) : bool{
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }
    private function passwordValidation($password) : bool{
        if(strlen($password) > 6 && $this->checkForNumber($password)){
            return true;
        }else{
            return false;
        }
    }
    private function checkForNumber($password) : bool{
        $count = 0;
        for($i = 0; $i < strlen($password); $i++) {
            if (is_numeric($password[$i])) {
                $count++;
            }
        }
        if($count > 4){
            return true;
        }else {
            return false;
        }
    }

    public function cabinet(){
        include "configuration.php";
        require "app/models/UserModel.php";



        session_start();
        if(!empty($_SESSION['user'])){
//            var_dump($db::table('users')
//                ->select()->where(array(':email' =>  $_SESSION['user']['email']), '=')->get());
            $_SESSION['user'] = (UserModel::check(array(':email' =>  $_SESSION['user']['email'])))[0];
            if($_SESSION['user']['admin'] != 1) {
                require "app/resources/cabinet_content.php";
                return;
            }else{
                header('Location: /cabinet/admin');
            }

        }
        session_abort();

        session_start();
        if(isset($_SESSION['activated'])){
            echo  $errorBuilder::okMsg("Your account was activated!<br>");
        }
        if(isset($_SESSION['forgot'])){
            echo $errorBuilder::okMsg("Get password via email.</br>");
        }
        $_SESSION['activated'] = 0;
        $_SESSION['forgot'] = 0;
        session_abort();

        if(isset($_POST['button'])){
            session_start();
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = UserModel::userCheck(array(':email' => $email), array(':password' => $password));

            if(!empty($user)){
                $user = $user[0];
                if(!empty($user['activation'])) {
                    $_SESSION['user'] = $user;
                    if($user['admin'] == 1){
                        header('Location: /cabinet/admin');
                    }else {
                        require "app/resources/cabinet_content.php";
                    }
                }else{
                    echo $errorBuilder::errMsg("Your account wasn't activated!<br>");
                }
            }else{
                echo $errorBuilder::errMsg("Wrong email or password! Try again.<br>") . '<br><a href="/signin">Try again</a>';
            }
        }else{
            require "app/resources/signin_content.php";
        }
    }

    public function editInfo(){
        include "configuration.php";
        require "app/models/UserModel.php";
        $updated = [];
        $isUpdate = false;
        $user = $_SESSION['user'];

        if(isset($_POST['button'])) {
            if(!empty($_POST['name'])){

                $name = $_POST['name'];
                $err_msg = null;
                $error = false;

                if ($this->nameValidation($name) == false) {
                    $err_msg = "Wrong name";
                    $error = true;
                }

                if($error == false){
                    $field = array(':name' => $name);
                    UserModel::update($field, array(':email' => $user['email']));
                    $isUpdate = true;
                    $updated[] = "name";
                }else{
                    echo $errorBuilder::errMsg("$err_msg! Try again.</br>");
                }

            }elseif(!empty($_POST['email'])){

                $email = $_POST['email'];
                $err_msg = [];
                $error = false;

                if ($this->emailValidation($email) == false) {
                    $err_msg[] = "Wrong email";
                    $error = true;
                }

                $email_check = UserModel::check(array(':email' => $email));

                if (!empty($email_check)) {
                    $err_msg[] = "This email already exists";
                    $error = true;
                }

                if($error == false){
                    $field = array(':email' => $email);
                    UserModel::update($field, array(':name' => $user['name']), array(':password' => $user['password']));
                    $isUpdate = true;
                    $updated[] = "email";
                }else{
                    echo $errorBuilder::errMsg(implode(", ", $err_msg) . "! Try again.</br>");
                }

            }elseif(!empty($_POST['password'])) {
                $password = $_POST['password'];
                $err_msg = null;
                $error = false;

                if ($this->passwordValidation($password) == false) {
                    $err_msg = "Wrong password";
                    $error = true;
                }
                if($error == false){
                    $field = array(':password' => $password);
                    UserModel::update($field, array(':email' => $user['email']));
                    $isUpdate = true;
                    $updated[] = "password";
                }else{
                    echo $errorBuilder::errMsg("$err_msg! Try again.</br>");
                }

            }else{
                echo $errorBuilder::errMsg("Fill in at least one field!.<br>");
                require "app/resources/edit_content.php";
            }

            if($isUpdate == true){
                $user = UserModel::check(array(':id' => $user['id']))[0];
                $_SESSION['user'] = $user;
                echo $errorBuilder::okMsg("Your " . implode(", ", $updated) . " was updated!<br>");
                require "app/resources/edit_content.php";
            }
        }else{
            require "app/resources/edit_content.php";
        }
    }

    public function forgotPas(){
        include "configuration.php";
        require "app/models/UserModel.php";

        if(isset($_POST['button'])){
            $email = $_POST['email'];
            $error = false;
            $err_msg = [];

            if(!$this->emailValidation($email)){
                $err_msg[] = "Wrong email";
                $error = true;
            }

            $user = UserModel::check(array(':email' => $email));

            if(empty($user)) {
                $err_msg[] = "This email was not registered";
                $error = true;
            }

            if(!$error) {
                $user = $user[0];

                $to = $email;
                $charset = 'utf-8';
                $subject = "Forgotten password from ".$_SERVER['HTTP_HOST'];
                $body="Hello! Your password is:".$user['password'].". Use shit of paper for your passwords!<br>"
                    .date("d.m.Y", time());
                $headers = "MIME-Version: 1.0 \r\n";
                $headers .= "From: artw0314@gmail.com \r\n";
                $headers .= "Reply-To: artw0314@gmail.com \r\n";
                $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
                $headers .= "Content-Type: text/html; charset=$charset \r\n";

                mail($to, $subject, $body, $headers);

                session_start();
                $_SESSION['forgot'] = true;
                header("Location:/cabinet");

            }else{
                echo $errorBuilder::errMsg(implode(", ", $err_msg) . "! Try again.<br>");
                require_once "app/resources/forgot_pas_content.php";
            }
        }else{
            require_once "app/resources/forgot_pas_content.php";
        }

    }
}