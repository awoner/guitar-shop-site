<?php
//$_GET["main"] = 'main';
class Error1{
    private static $instance = null;

    private function __construct(){}
    private function __clone(){}            //щоб не можна будо клонувати об"єкти
    public function __invoke(){}            //як перевантаження оператору () в С++
    public function __get($name){}

    public static function setInstance(){   //метод який створює о"єкт класу
        if (null === self::$instance){      //якщо нема ще об"єктів тоді створити
            self::$instance = new self();
        }
        return self::$instance;             //якщо є - повернути існуючий
    }

    static function errMsg($err_msg = null){
        $err_msg = (!is_null($err_msg)) ? $err_msg : "UNDEFINED ERROR:(";

        return "<style>
                    #back{
                        background: rgba(255, 255, 255, 0.6);
                        text-align: center; 
                        height: 800px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                    }
                    #back a{
                        font-size: 9pt;
                        text-decoration: underline;
                        color: #1f7cba;
                    }
                    
                </style>
                <div class='error'>
                    <div id='error-msg'>
                        <b>$err_msg</b><span id='error-logo' class='fas fa-times'></span>
                    </div>
                </div>";
    }

    static function okMsg($ok_msg = null){
        if(is_null($ok_msg)){
            self::errMsg();
        }

        return "<style>
                    #back{
                        background: rgba(255, 255, 255, 0.6);
                        text-align: center; 
                        height: 800px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                    }
                    #back a{
                        font-size: 9pt;
                        text-decoration: underline;
                        color: #1f7cba;
                    }
                   
                </style>
                <div class='ok'>
                    <div id='ok-msg'>
                        <b>$ok_msg</b><span id='ok-logo' class='fas fa-check'></span>
                    </div>
                </div>";
    }
}

require "app/resources/header.php";
//require 'app/models/ProductModel.php';
//$pm = new ProductModel();
//var_dump($pm->findId(1));
require "app/routes/routes.php";
require "app/resources/footer.php";

//header("Location:/main");
//require "core/cms.php";
//require_once "app/resources/header.php";
////require "app/resources/container_content.php";
////require "app/resources/main_content.php";
////require "app/resources/registration_content.php";
//require "app/resources/signin_content.php";
//require_once "app/resources/footer.php"