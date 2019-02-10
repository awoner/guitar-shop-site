<style>
    #back{
        background: rgba(255, 255, 255, 0.6);
        text-align: center;
        height: 800px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    /*#back a{*/
        /*float: left;*/
        /*margin-left: 10px;*/
        /*text-decoration: underline;*/
        /*font-size: 9pt;*/
        /*color: #536ea5;*/
    /*}*/
    #back a{
        font-size: 9pt;
        text-decoration: underline;
        color: #1f7cba;
    }

    .aButton{
        padding: 0;
        width: 100%;
        height: 20px;
        margin: 0;
        display: flex;
        flex-direction: row;
    }

    .aButton > input{
        float: right;
        border: transparent solid 0px;
        margin: 0 auto;
        background: #536ea5;
        text-align: center;
        color: rgba(255, 255, 255, 0.5);
        transition: background-color 0.5s;
    }

    .aButton > a{
        float: left;
        margin: 0 auto;
    }

    .aButton > input:hover{
        background: #1f7cba;
    }
</style>

<form action="/cabinet" class="registration" method="post">
    <input type="text" name="email" placeholder="Email" pattern="[\w]{1,20}[\@][A-Za-z]{1,20}[\.](com|ru|ua)" class="input">
    <input type="password" name="password" placeholder="Password" class="input">
    <div class="aButton">
        <a href="/forgot_pas" id="forget_pass">Forget password?</a>
        <input type="submit" name="button" value="Sign In" class="submit" class="aButton">
    </div>
</form>
