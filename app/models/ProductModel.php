<?php


class ProductModel
{
    private $id = null;
    private $title = null;
    private $price = null;
    private $image = null;
    private $description = null;
    private $features = null;
    private $datetime = null;
    private $leader = null;
    private $category_id = null;
    private $brand_id = null;

    public function __construct()
    {
        require 'BrandModel.php';
        require 'CategoryModel.php';
    }

    public function __get($field)
    {
        return $this->$field;
    }

    public function findId($id)
    {
        require 'configuration.php';
        $cm = new CategoryModel();
        $bm = new BrandModel();
        $fields = $db::table('products')->select()->where(array(':id' => $id), '=')->get();
        $fields = $fields[0];
        $fields['brand_id'] = $bm->findId($fields['brand_id']);
        $fields['category_id'] = $cm->findId($fields['category_id']);

        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
        return $fields;
    }

    public function findIdAccess($id)
    {
        require 'configuration.php';
        $cm = new CategoryModel();

        $fields = $db::table('accessories')->select()->where(array(':id' => $id), '=')->get();
        $fields = $fields[0];
        $fields['category_id'] = $cm->findIdAccess($fields['category_id']);

        foreach ($fields as $key => $value) {
            $this->$key = $value;
        }
        return $fields;
    }

    public function getAll()
    {
        require 'configuration.php';
        $cm = new CategoryModel();
        $bm = new BrandModel();

        $fields = $db::table('products')->select()->get();


        for ($i = 0; $i < count($fields); $i++) {
            $fields[$i]['brand_id'] = $bm->findId($fields[$i]['brand_id']);
            $fields[$i]['category_id'] = $cm->findId($fields[$i]['category_id']);
        }

        return $fields;
    }

    public function getAllAccess()
    {
        require 'configuration.php';
        $cm = new CategoryModel();

        $fields = $db::table('accessories')->select()->get();


        for ($i = 0; $i < count($fields); $i++) {
            $fields[$i]['category_id'] = $cm->findIdAccess($fields[$i]['category_id']);
        }

        return $fields;
    }

    public function getAllBest()
    {
        require 'configuration.php';
        $cm = new CategoryModel();
        $bm = new BrandModel();

        $fields = $db::table('products')->select()->where(array(':leader' => 1), '=')->get();


        for ($i = 0; $i < count($fields); $i++) {
            $fields[$i]['brand_id'] = $bm->findId($fields[$i]['brand_id']);
            $fields[$i]['category_id'] = $cm->findId($fields[$i]['category_id']);
        }

        return $fields;
    }

    public function brandFilter($brandName)
    {
        require 'configuration.php';
        $bm = new BrandModel();
        $cm = new CategoryModel();

        $brandId = $bm->findName($brandName);

        $fields = $db::table('products')->select()->where(array(':brand_id' => $brandId), '=')->get();

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $fields[$i]['brand_id'] = $bm->findId($fields[$i]['brand_id']);
                $fields[$i]['category_id'] = $cm->findId($fields[$i]['category_id']);
            }
            return $fields;
        } else {
            return [];
        }

    }

    public function categoryFilter($categoryName)
    {
        require 'configuration.php';
        $cm = new CategoryModel();

        $categoryId = $cm->findNameAccess($categoryName);

        $fields = $db::table('accessories')->select()->where(array(':category_id' => $categoryId), '=')->get();

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $fields[$i]['category_id'] = $cm->findIdAccess($fields[$i]['category_id']);
            }
            return $fields;
        } else {
            return [];
        }

    }

    public function priceFilter($from, $to)
    {
        require 'configuration.php';
        $bm = new BrandModel();
        $cm = new CategoryModel();

        $fields = $db->SQL("SELECT * FROM products WHERE price >= $from AND price <= $to")->get();

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $fields[$i]['brand_id'] = $bm->findId($fields[$i]['brand_id']);
                $fields[$i]['category_id'] = $cm->findId($fields[$i]['category_id']);
            }
            return $fields;
        } else {
            return [];
        }

    }

    public function priceFilterAccess($from, $to)
    {
        require 'configuration.php';
        $cm = new CategoryModel();

        $fields = $db->SQL("SELECT * FROM accessories WHERE price >= $from AND price <= $to")->get();

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $fields[$i]['category_id'] = $cm->findIdAccess($fields[$i]['category_id']);
            }
            return $fields;
        } else {
            return [];
        }

    }

    public function filter($brandName, $from, $to)
    {
        require 'configuration.php';
        $bm = new BrandModel();
        $cm = new CategoryModel();

        $brandId = $bm->findName($brandName);


        $fields = $db->SQL("SELECT * FROM `products` WHERE brand_id = $brandId AND price >= $from AND price <= $to")->get();

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $fields[$i]['brand_id'] = $bm->findId($fields[$i]['brand_id']);
                $fields[$i]['category_id'] = $cm->findId($fields[$i]['category_id']);
            }
            return $fields;
        } else {
            return [];
        }
    }

    public function filterAccess($category, $from, $to)
    {
        require 'configuration.php';
        $cm = new CategoryModel();

        $categoryId = $cm->findNameAccess($category);


        $fields = $db->SQL("SELECT * FROM `accessories` WHERE category_id = $categoryId AND price >= $from AND price <= $to")->get();

        if (!empty($fields)) {
            for ($i = 0; $i < count($fields); $i++) {
                $fields[$i]['category_id'] = $cm->findIdAccess($fields[$i]['category_id']);
            }
            return $fields;
        } else {
            return [];
        }
    }

    public function create($fields)
    {
        require 'configuration.php';
        $db::table('products')->insert($fields)->send();
    }

    public function update($field, $id)
    {
        require 'configuration.php';
        $key = str_replace(":", "", key($field));
        $this->$key = $field[key($field)];
        $db::table('products')->update($field)
            ->where(array(':id' => $id), '=')->send();
    }

    public function delete($id)
    {
        SqlBuilder::table('products')->delete()->where(array(':id' => $id), '=')
            ->send();
        $this->id = null;
        $this->title = null;
        $this->price = null;
        $this->image = null;
        $this->description = null;
        $this->features = null;
        $this->datetime = null;
        $this->leader = null;
        $this->category_id = null;
        $this->brand_id = null;
    }
}