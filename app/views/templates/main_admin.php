
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
    }
</style>

<div class="cabinet">
    <title>Cabinet</title>
    <h3>Hi,{{$_SESSION['user']['name']}}! <i style="color: red; font-family: 'Open Sans'; font-weight: lighter;">(Admin Panel)</i></h3>
    <ul>
        <li><a href="/cabinet/admin">Main</a></li>
        <li><a href="/cabinet/admin/category">Category</a></li>
        <li><a href="/cabinet/admin/goods">Products</a></li>
        <li><a href="/cabinet/edit">Edit info</a></li>

        <li><a href="/signout">EXIT</a></li>
    </ul>
</div>