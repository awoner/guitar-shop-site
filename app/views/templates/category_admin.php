


<style>
    #back{
        background: rgba(255, 255, 255, 0.6);
        text-align: center;
        height: 800px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .cabinet{
        width: 60%;
        display: flex;
        flex-direction: column;
    }

    .cabinet > #group{
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .cabinet > #group > ul{
        width: 40%;
    }

    .table{
        margin: 20px;
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
    <h3>Hi,{{$_SESSION['user']['name']}}! <i style="color: red; font-family: 'Open Sans'; font-weight: lighter;">(Admin Panel)</i></h3>
    <div id="group">
        <ul>
            <li><a href="/cabinet/admin">Main</a></li>
            <li><a href="/cabinet/admin/category">Category</a></li>
            <li><a href="/cabinet/admin/goods">Products</a></li>
            <li><a href="/cabinet/edit">Edit info</a></li>
            <li><a href="/signout">EXIT</a></li>
        </ul>
            <div class="table">
                    <table border="0" cellspacing="0" cellpadding="10">
                        <caption>Categories</caption>
                        <tr>
                            <th>Name</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        {@ foreach ($data as $category): @}
                            <tr>
                                <form action="/category/update/{{$category['id']}}" method="post">
                                    <td>
                                        <input type="text" value="{{$category['name']}}" name="categoryName" class="input">
                                    </td>
                                    <td>
                                        <input type="submit" name="button" value="Update" class="updateB">
                                    </td>
                                </form>
                                <td>
                                    <a href="/category/delete/{{$category['id']}}"class="delB">
                                        <span class="fas fa-times" ></span>
                                    </a>
                                </td>
                            </tr>
                        {@ endforeach; @}
                        <tr>
                            <form action="/category/add" method="post">
                                <td>
                                    <input type="text" placeholder="Category name" name="newCategoryName"  class="input">
                                </td>
                                <td colspan="2">
                                    <input type="submit" name="button" value="Add" class="addB">
                                </td>
                            </form>
                        </tr>
                    </table>
            </div>
    </div>
</div>