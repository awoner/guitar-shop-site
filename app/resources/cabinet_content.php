
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
</style>

    <div class="cabinet">
        <title>Cabinet</title>
        <h3>Hi, <?php //var_dump($_SESSION['user']);
        echo $_SESSION['user']['name'];?>!</h3>
        <ul>
            <li><a href="/cabinet/edit">Edit info</a></li>
            <li><a href="/signout">EXIT</a></li>
        </ul>
    </div>