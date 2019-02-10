<?php
class GoodsController {
    public function actionProduct(){;
        require "configuration.php";

        require "app/models/ProductModel.php";

        $pm = new ProductModel();
        //require_once "app/resources/container_content.php";
        $goods = $pm->getAll();
        echo $tpl->output('products', $goods);

    }

    public function actionAccessories(){
        require "configuration.php";

        require "app/models/ProductModel.php";

        $pm = new ProductModel();
        //require_once "app/resources/container_content.php";
        $accessories = $pm->getAllAccess();
        echo $tpl->output('accessories', $accessories);

    }

    public function actionBest(){
        require "configuration.php";

        require "app/models/ProductModel.php";

        $pm = new ProductModel();
        //require_once "app/resources/container_content.php";
        $best = $pm->getAllBest();
        echo $tpl->output('products', $best);

    }

    public function product($id){
         require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();

        $prod = $pm->findId($id);
        echo $tpl->output('product', $prod);

    }

    public function accessories($id){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();

        $access = $pm->findIdAccess($id);
        echo $tpl->output('accessories', $access);

    }

    public function filterProduct(){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();

        if(isset($_POST['button'])) {
            $filter = false;

            if(!empty($_POST['manufacturers']) && !empty($_POST['price1']) && !empty($_POST['price2'])){

                $fields = [];
                $from = $_POST['price1'];
                $to = $_POST['price2'];
                $manufacturers = $_POST['manufacturers'];

                foreach ($manufacturers as $manufacturer) {
                    $tmp = $pm->filter($manufacturer, $from, $to);
                    $fields = array_merge($fields, $tmp);
                }

                $filter = true;
                echo $tpl->output('products', $fields);
            }

            if(!empty($_POST['manufacturers']) && !$filter) {

                $fields = [];

                $manufacturers = $_POST['manufacturers'];
                foreach ($manufacturers as $manufacturer) {
                    $tmp = $pm->brandFilter($manufacturer);
                    $fields = array_merge($fields, $tmp);
                }

                $filter = true;
                echo $tpl->output('products', $fields);
            }

            if(!empty($_POST['price1']) && !empty($_POST['price2']) && !$filter){

                $from = $_POST['price1'];
                $to = $_POST['price2'];

                $fields = $pm->priceFilter($from, $to);
                $filter = true;

                echo $tpl->output('products', $fields);
            }


            if (!$filter){
                $fields = $pm->getAll();

                echo $tpl->output('products', $fields);
            }
        }
    }


    public function filterAccessories(){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();

        if(isset($_POST['button'])) {
            $filter = false;

            if(!empty($_POST['categories']) && !empty($_POST['price1']) && !empty($_POST['price2'])){

                $fields = [];
                $from = $_POST['price1'];
                $to = $_POST['price2'];
                $categories = $_POST['categories'];

                foreach ($categories as $category) {
                    $tmp = $pm->filterAccess($category, $from, $to);
                    $fields = array_merge($fields, $tmp);
                }

                $filter = true;
                echo $tpl->output('accessories', $fields);
            }

            if(!empty($_POST['categories']) && !$filter) {

                $fields = [];

                $categories = $_POST['categories'];
                foreach ($categories as $category) {
                    $tmp = $pm->categoryFilter($category);
                    $fields = array_merge($fields, $tmp);
                }


                $filter = true;
                echo $tpl->output('accessories', $fields);
            }

            if(!empty($_POST['price1']) && !empty($_POST['price2']) && !$filter){

                $from = $_POST['price1'];
                $to = $_POST['price2'];

                $fields = $pm->priceFilterAccess($from, $to);
                $filter = true;

                echo $tpl->output('accessories', $fields);
            }


            if (!$filter){
                $fields = $pm->getAllAccess();

                echo $tpl->output('accessories', $fields);
            }
        }
    }

    public function filterCategory($name){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();
        $fields = $pm->categoryFilter($name);

        echo $tpl->output('accessories', $fields);
    }

    public function filterBrand($name){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();

        $fields = $pm->brandFilter($name);
        echo $tpl->output('products', $fields);
    }

}