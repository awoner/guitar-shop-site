<?php
class CartController{

    public function action(){
        require "configuration.php";

        if (isset($_SESSION['prods']))
            echo $tpl->output('cart', $_SESSION['prods']);
        else
            echo  $tpl->output('cart');
    }

    public function actionAdd($id){

        CartModel::addProduct($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionAddAccess($id){

        CartModel::addAccess($id);

        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }

    public function actionDelete($id){

        CartModel::deleteProduct($id);

        header("Location: /cart");
    }

    public function actionDeleteAccess($id){

        CartModel::deleteAccess($id);

        header("Location: /cart");
    }

    public function checkout(){
        require 'configuration.php';
        require "app/models/UserModel.php";

        if(isset($_POST['button'])){
               session_start();
               $name = isset($_POST['name']) ? $_POST['name'] : $_SESSION['user']['name'];
               $number = $_POST['number'];
            $err_msg = [];
            $error = false;
            $user = [];

            if (!$this->nameValidation($name)) {
                $err_msg[] = "Wrong name";
                $error = true;
            }
            if (!$this->numberValidation($number)) {
                $err_msg[] = "Wrong number";
                $error = true;
            }

            if(isset($_SESSION['user'])){
                $user_check = UserModel::userCheck(array(':name' => $name),
                    array(':email' => $_SESSION['user']['email']),
                    array(':password' => $_SESSION['user']['password']));
                if(empty($user_check)){
                    $err_msg[] = "Wrong user";
                    $error = true;
                }else{
                    $user = $_SESSION['user'];
                }
            }

            if (!$error) {
               if(!empty($user)){

                   $products = $_SESSION['prods'];
                   $productId = [];

                   foreach ($products as $product){
                       $productId[] = $product['id'];
                   }

                   $productId = implode(', ', $productId);
                   $fields = array(':user_id' => $user['id'],
                       ':products' => $productId,
                       ':user_name' => $name,
                       ':user_phone' => $number);
                   $db::table('order')->insert($fields)->send();

                   $orderID = $db::table('order')->select('id')->where(array(':user_id' => $user['id']), '=')->get()[0]['id'];

                   $to = $user['email'];
                   $charset = 'utf-8';
                   $subject = "Check Email";
                   $body = 'Hi, <br/> <br/> Your order #'. $orderID .' is processed ! Please check your number'. $number .'.<br>'
                       . date("d.m.Y", time());

                   $headers = "MIME-Version: 1.0 \r\n";
                   $headers .= "From: cw.guitar.keren@gmail.com \r\n";
                   $headers .= "Reply-To: cw.guitar.keren@gmail.com \r\n";
                   $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
                   $headers .= "Content-Type: text/html; charset=$charset \r\n";

                   if (mail($to, $subject, $body, $headers)) {
                       echo $errorBuilder::okMsg("Order is processed! Check your email.</br>");
                       unset($_SESSION['prods']);
                   } else {
                       echo $errorBuilder::errMsg("Mail error!<br>");
                   }
               }else{
                   $userId = $words = preg_replace('/[^0-3]/', '', session_id());
                   $products = $_SESSION['prods'];
                   $productId = [];

                   foreach ($products as $product){
                       $productId[] = $product['id'];
                   }

                   $productId = implode(', ', $productId);
                       $fields = array(':user_id' => $userId,
                       ':products' => $productId,
                       ':user_name' => $name,
                       ':user_phone' => $number);
                    $db::table('order')->insert($fields)->send();
                   echo $errorBuilder::okMsg("Order is processed!</br>");
                   unset($_SESSION['prods']);
               }

            } else {
                echo $errorBuilder::errMsg(explode($err_msg, ", ") . "! Try again.<br>");
                require 'app/resources/checkout_content.php';
            }
        }else {
            require 'app/resources/checkout_content.php';
        }
    }

    private function nameValidation($name) : bool{
        if(strlen($name) > 2 && $name[0] === strtoupper($name[0]) ){
            return true;
        }else{
            return false;
        }
    }

    private function numberValidation($number) : bool {
        if($number =~ "([\+]?38)?(([\(]0[1-9]{2}[\)])|(0[1-9]{2}))[\d]{7}"){
            return true;
        }else{
            return false;
        }
    }
}