<?php
class AdminController {
    public function main(){
        require "configuration.php";
        session_start();
        if($_SESSION['user']['admin'] == 1) {
            echo $tpl->output('main_admin');
        }else{
            header("Location: /cabinet");
        }
    }

    public function category(){
        require "configuration.php";
        require "app/models/CategoryModel.php";
        session_start();
        if($_SESSION['user']['admin'] == 1){
            $cm = new CategoryModel();
            $categories = $cm->getAll();
           echo $tpl->output('category_admin', $categories);
        }else{
            header("Location: /cabinet");
        }
    }

    public function categoryDelete($id){
        require "configuration.php";
        require "app/models/CategoryModel.php";
        $cm = new CategoryModel();

        $categoryCheck = $cm->findId($id);

        if(!empty($categoryCheck)){
            $cm->delete($id);
            header('Location: /cabinet/admin/category');
        }else{
            $errorBuilder::errMsg("Unknown category!<br>");
        }
    }
    public function categoryUpdate($id){
        require "configuration.php";
        require "app/models/CategoryModel.php";
        $cm = new CategoryModel();

        if(isset($_POST['button'])){
            $cm->update(array(':name' => $_POST['categoryName']), $id);
            header('Location: /cabinet/admin/category');
        }
    }

    public function categoryAdd(){
        require "configuration.php";
        require "app/models/CategoryModel.php";
        $cm = new CategoryModel();

        if(isset($_POST['button'])){
            $cm->create(array(':name' => $_POST['newCategoryName']));
            header('Location: /cabinet/admin/category');
        }
    }


    public function products(){
        require "configuration.php";
        require "app/models/ProductModel.php";
        session_start();
        if($_SESSION['user']['admin'] == 1){
            $pm = new ProductModel();
            $products = $pm->getAll();
            echo $tpl->output('products_admin', $products);
        }else{
            header("Location: /cabinet");
        }
    }

    public function productsDelete($id){
        require "configuration.php";
        require "app/models/ProductModel.php";
        $pm = new ProductModel();

        $productCheck = $pm->findId($id);

        if(!empty($productCheck)){
            $pm->delete($id);
            header('Location: /cabinet/admin/goods');
        }else{
            $errorBuilder::errMsg("Unknown product!<br>");
        }
    }
    public function productUpdate($id){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();
        $cm = new CategoryModel();
        $bm = new BrandModel();

        if(isset($_POST['button'])){
            $title = $_POST['title'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $brand = $_POST['brand'];

            $categoryId = $cm->findName($category);
            $brandId = $bm->findName($brand);

            $pm->update(array(':title' => $title), $id);
            $pm->update(array(':price' => $price), $id);
            $pm->update(array(':image' => $image), $id);
            $pm->update(array(':description' => $description), $id);
            $pm->update(array(':category_id' => $categoryId), $id);
            $pm->update(array(':brand_id' => $brandId), $id);
            header('Location: /cabinet/admin/goods');
        }

    }

    public function productAdd(){
        require "configuration.php";
        require "app/models/ProductModel.php";

        $pm = new ProductModel();
        $cm = new CategoryModel();
        $bm = new BrandModel();

        if(isset($_POST['button'])){
            $title = $_POST['title'];
            $price = $_POST['price'];
            $image = $_POST['image'];
            $description = $_POST['description'];
            $category = $_POST['category'];
            $brand = $_POST['brand'];

            $categoryId = $cm->findName($category);
            $brandId = $bm->findName($brand);

           $pm->create(array(':title' => $title,
                ':price' => $price,
                ':image' => $image,
                ':description' => $description,
                ':category_id' => $categoryId,
                ':brand_id' => $brandId));
            header('Location: /cabinet/admin/goods');
        }

    }

    public function orders(){}
    public function brand(){}
}