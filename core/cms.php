<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.03.2018
 * Time: 1:48
 */
trait Singleton{
    private function __clone() {}
    private function __construct() {
        // parent::__construct($this->myName,$this->mySurname,$this->myYear);
    }
    private static $instance=Null;
    public static function getInstance(){
        if(Null===self::$instance){
            self::$instance = new self();}
        return self::$instance;
    }
}


class http{
    use Singleton;
    private $stringError = "Wrong page";
    private $pages = array(1 => "main",
        2 => "registration",
        3 => "signin",
        4 => "forget_pas",
        5 => "container",
        6 => "cabinet");
//    use Singleton;

    public function getMethod($arg){
        var_dump($_GET["$arg"]);
        if(empty($_GET["$arg"]))
            return $this->stringError;
        if(($_GET["$arg"] != "main") && ($_GET["$arg"] != "registration") && ($_GET["$arg"] != "signin")
            && ($_GET["$arg"] != "signin") && ($_GET["$arg"] != "forget_pas") && ($_GET["$arg"] != "container")
            && ($_GET["$arg"] != "cabinet"))
            return $this->stringError;
        if(isset($_GET["$arg"]))
            return $_GET["$arg"];
     //  if(empty($_GET["$arg"])) return $this->stringError;
    }

    public function postMethod($arg){
        if(isset($_POST["$arg"]))
            return $_POST["$arg"];
        else
            return $this->stringError;
    }
}

 class CMS {
//    private function headPhp($arg){
//        $arr[]="$arg";
//        $arr[]="header.php";
//        var_dump($arr);
//        return implode("",$arr);
//    }

    private function contPhp($arg){
        $arr[]="$arg";
        $arr[]="_content.php";
        return implode("",$arr);
    }

//    private  function footerPhp($arg){
//
//    }

    public function buildPage ($arg){
        if($arg == "Wrong page") {
            echo "$arg";
            return;
        }
        //$head = $this->headPhp($arg);
        $page = $this->contPhp($arg);
        //require_once "$head";
        require_once "../app/resources/header.php";
        require "../app/resources/$page";
        require_once '../app/resources/footer.php';

    }
}

$mySite= new CMS();
$obj = http::getInstance();
$result=$obj->getMethod("main");

$mySite->buildPage($result);
