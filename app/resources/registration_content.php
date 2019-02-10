
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

    <form action="/registration" class="registration" method="post">
        <input type="text" pattern="([A-Z][a-z]{1,20})|([А-Я][а-я]{1,20})" name="name" placeholder="Name" class="input">
        <input type="text" name="email" pattern="[\w]{1,20}[\@][A-Za-z]{1,20}[\.](com|ru|ua)" placeholder="Email" class="input">
        <input type="password" name="password1" placeholder="Password 1" class="input">
        <input type="password" name="password2" placeholder="Password 2" class="input">
        <div class="g-recaptcha" data-sitekey="6LeMYl0UAAAAADOGRwrckjcnKCNl6FJY2FgigEzP"></div>
        <input type="submit" name="button" value="Register" class="submit">
    </form>