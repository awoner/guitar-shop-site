
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
    </style>
    <form action="/forgot_pas" class="registration" method="post">
        <input type="text"
               name="email"
               placeholder="Email"
               pattern="[\w]{1,20}[\@][A-Za-z]{1,20}[\.](com|ru|ua)"
               class="input">
        <input type="submit" name="button" value="Remind" class="submit">
    </form>