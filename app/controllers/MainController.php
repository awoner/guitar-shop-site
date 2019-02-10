<?php
class MainController{
    public function main(){
        require "configuration.php";

        $product = $db->SQL("SELECT
                             p.id, p.title, p.price, p.image, p.description, b.name AS brand
                             FROM products p
                             INNER JOIN brand b ON p.brand_id = b.id
                             WHERE p.leader = 1")->get();
        echo $tpl->output('main', $product);
    }

    public function aboutUs(){require 'app/resources/about_us.php';}
    public function contact(){require 'app/resources/contact.php';}
    public function explore(){require 'app/resources/explore.php';}
    public function howToBuy(){require 'app/resources/how_to_buy.php';}
    public function returnPolicy(){require 'app/resources/return_policy.php';}
    public function reviews(){require 'app/resources/reviews.php';}
    public function securePayment(){require 'app/resources/secure_payment.php';}
    public function termsAndConditions(){require 'app/resources/terms_and_conditions.php';}
}