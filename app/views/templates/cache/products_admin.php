


<style>
    #back{
        background: rgba(255, 255, 255, 0.6);
        text-align: center;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .cabinet{
        width: 95%;
        margin: 10px;
        display: flex;
        flex-direction: column;
    }

    .cabinet > #group{
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .cabinet > #group > ul{
        width: 20%;

    }

    .table{
        width: 100%;

        font-family: "Open Sans";
        border-bottom: none;
        background:#34495e;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }

    .table .input{
        border: none;
        background: black;
        color: #1f7cba;
        opacity: 0.5;
        width: 100%;
        height: 100%;
        padding: 5px;
    }

    tr, th, td{
        border: white solid 0px;
    }

    .updateB{
        border: green solid 3px;
        color: green;
        background: greenyellow;
        opacity: 0.8;
        width: 100%;
        text-align: center;
        transition: all 0.5s ease;
    }

    .delB{
        font-family: FontAwesome;
        color: red;
        background: transparent;
        padding: 5px;
        transition: all 0.5s ease;
    }

    .delB:hover{
        background: red;
        color: white;
    }

    .updateB:hover, .addB:hover{
        opacity: 1;
    }

    .addB{
        border: #1f7cba solid 3px;
        color: white;
        background: #3498db;
        opacity: 0.8;
        width: 100%;
        text-align: center;
        transition: all 0.5s ease;
    }
</style>

<div class="cabinet">
    <title>Cabinet</title>
    <h3>Hi,<?=$_SESSION['user']['name']?>! <i style="color: red; font-family: 'Open Sans'; font-weight: lighter;">(Admin Panel)</i></h3>
    <div id="group">
        <ul>
            <li><a href="/cabinet/admin">Main</a></li>
            <li><a href="/cabinet/admin/category">Category</a></li>
            <li><a href="/cabinet/admin/goods">Products</a></li>
            <li><a href="/cabinet/edit">Edit info</a></li>
            <li><a href="/signout">EXIT</a></li>
        </ul>
        <?php
        $bm = new BrandModel();
        $brands = $bm->getAll();
        $cm = new CategoryModel();
        $categories = $cm->getAll();
        ?>
        <div class="table">
            <table border="0" cellspacing="0" cellpadding="10">
                <caption>Products</caption>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Description</th>
<!--                    <th>Features</th>-->
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                <?php foreach ($data as $product): ?>
                <tr>
                    <form action="/goods/update/<?=$product['id']?>" method="post" name="prods">
                        <td><input type="text" value="<?=$product['title']?>" name="title" class="input"></td>
                        <td width="7%"><input type="number" value="<?=$product['price']?>" name="price" class="input"></td>
                        <td><input type="text" value="<?=$product['image']?>" name="image" class="input"></td>
<!--                        <td><input type="text" value="$product['category_id']" name="category" class="input"></td>-->
<!--                        <td><input type="text" value="$product['brand_id']" name="brand" class="input"></td>-->
                        <td><select class="input" name="brand">
                                <?php foreach($brands as $brand): ?>
                                <option <?=($brand['name'] == $product['brand_id']) ? 'selected' : ''?> value="<?=$brand['name']?>"><?=$brand['name']?></option>
                                <?php endforeach; ?>
                            </select></td>

                        <td><select class="input" name="category">
                                <?php foreach($categories as $category): ?>
                                <option <?=($category['name'] == $product['category_id']) ? 'selected' : ''?> value="<?=$category['name']?>"><?=$category['name']?></option>
                                <?php endforeach; ?>
                            </select></td>

                        <td width="30%"><textarea cols="15" rows="4" name="description" class="input"><?=$product['description']?></textarea></td>
<!--                        <td><textarea cols="25" rows="10" name="features" class="input">$product['features']</textarea></td>-->
                        <td><input type="submit" name="button" value="Update" class="updateB"></td>
                    </form>
                    <td width="5%">
                        <a href="/goods/delete/<?=$product['id']?>" class="delB">
                            <span class="fas fa-times"></span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <form action="/goods/add" method="post" name="newProd">
                        <td><input type="text" placeholder="Title" name="title" class="input"></td>
                        <td><input type="number" placeholder="Price" name="price" class="input"></td>
                        <td><input type="text" placeholder="Path from image" name="image" class="input"></td>
                        <td><select class="input" name="brand">
                                <?php foreach($brands as $brand): ?>
                                <option><?=$brand['name']?></option>
                                <?php endforeach; ?>
                            </select></td>

                        <td><select class="input" name="category">
                                <?php foreach($categories as $category): ?>
                                <option><?=$category['name']?></option>
                                <?php endforeach; ?>
                            </select></td>
                        <td><textarea cols="15" rows="5"  placeholder="Description" name="description" class="input"></textarea></td>
<!--                        <td><textarea cols="25" rows="10"  placeholder="feratures" name="features" class="input"></textarea></td>-->
                        <td colspan="2">
                            <input type="submit" name="button" value="Add" class="addB">
                        </td>
                    </form>
                </tr>
            </table>
        </div>
    </div>
</div>