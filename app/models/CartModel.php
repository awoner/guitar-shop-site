<?php

class CartModel{
    public static function addProduct($id){
        require "configuration.php";
        require "app/models/ProductModel.php";
        $pm = new ProductModel();
        session_start();
//        $id .= "_product";
        if(isset($_SESSION['prods'])){
            $id1 = $id . "_product";
            if(key_exists($id1, $_SESSION['prods'])){ //&& $_SESSION['products']['id'] == $id) {
                $_SESSION['prods'][$id1]['count']++;
                $_SESSION['prods'][$id1]['total_price'] = $_SESSION['prods'][$id1]['count'] * $_SESSION['prods'][$id1]['price'];
            }else{
                $prod =  $pm->findId($id);
                $id .= "_product";
                $_SESSION['prods'][$id] = $prod;
                $_SESSION['prods'][$id]['count'] = 1;
                $_SESSION['prods'][$id1]['total_price'] = $_SESSION['prods'][$id1]['price'];
            }
        }else{
            $prod =  $pm->findId($id);
            $id .= "_product";
            $_SESSION['prods'][$id] = $prod;
            $_SESSION['prods'][$id]['count'] = 1;
            $_SESSION['prods'][$id]['total_price'] = $_SESSION['prods'][$id]['price'];
        }
        //$_SESSION['products'] = null;

//        foreach ($_SESSION['products1'] as $id) {
//            var_dump($id);
//            echo '<br>';
//        }
        //self::countItems();
    }


    public static function addAccess($id){
        require "configuration.php";
        require "app/models/ProductModel.php";
        $pm = new ProductModel();
        session_start();
        if(isset($_SESSION['prods'])){
            $id1 = $id . "_access";
            if(key_exists($id1, $_SESSION['prods'])){
                $_SESSION['prods'][$id1]['count']++;
                $_SESSION['prods'][$id1]['total_price'] = $_SESSION['prods'][$id1]['count'] * $_SESSION['prods'][$id1]['price'];
            }else{
                $prod =  $pm->findIdAccess($id);
                $id .= "_access";
                $_SESSION['prods'][$id] = $prod;
                $_SESSION['prods'][$id]['count'] = 1;
                $_SESSION['prods'][$id1]['total_price'] = $_SESSION['prods'][$id1]['price'];
            }
        }else{
            $prod =  $pm->findIdAccess($id);
            $id .= "_access";
            $_SESSION['prods'][$id] = $prod;
            $_SESSION['prods'][$id]['count'] = 1;
            $_SESSION['prods'][$id]['total_price'] = $_SESSION['prods'][$id]['price'];
        }
    }

    public static function countItems()
    {
        if (isset($_SESSION['prods'])) {
           //unset($_SESSION['prods']);
        }
        if (isset($_SESSION['prods'])) {
            $count = 0;
            foreach ($_SESSION['prods'] as $id) {
                $count = $count + $id['count'];
                //next($_SESSION['products']);
            }
            return $count;
        } else {
            return 0;
        }

    }

    public static function deleteProduct($id)
    {

        session_start();
        $id .= "_product";
        if(isset($_SESSION['prods'])){
            if(key_exists($id, $_SESSION['prods'])){ //&& $_SESSION['products']['id'] == $id) {
                if ($_SESSION['prods'][$id]['count'] != 1) {
                    $_SESSION['prods'][$id]['count']--;
                    $_SESSION['prods'][$id]['total_price'] = $_SESSION['prods'][$id]['count'] * $_SESSION['prods'][$id]['price'];
                }else{
                    unset($_SESSION['prods'][$id]);
                }
            }
        }


//        $key = array_search($id, $productsInCart);
//        if ($key !== false){
//            if($productsInCart[$key] === 0)
//                unset($productsInCart[$key]);
//            else{
//                unset($productsInCart[$key]);
//            }
//
//
//        }

       // return self::countItems();
    }

    public static function deleteAccess($id){
        session_start();
        $id .= "_access";
        if(isset($_SESSION['prods'])){
            if(key_exists($id, $_SESSION['prods'])){
                if ($_SESSION['prods'][$id]['count'] != 1) {
                    $_SESSION['prods'][$id]['count']--;
                    $_SESSION['prods'][$id]['total_price'] = $_SESSION['prods'][$id]['count'] * $_SESSION['prods'][$id]['price'];
                }else{
                    unset($_SESSION['prods'][$id]);
                }
            }
        }
    }


}