
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
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

        #back span{
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;
            margin-left: 15px;
            font-family: "Open Sans";
            font-size: 8pt;
            color: white;
            opacity: 0.4;
        }
    </style>
    <form action="/cabinet/edit" class="registration" method="post">
        <input type="text" pattern="([A-Z][a-z]{1,20})|([А-Я][а-я]{1,20})" class="input" placeholder="Name" name="name">
        <span>Your current name:<b><i><?=$user['name']?></i></b></span>
        <input type="text" class="input" pattern="[\w]{1,20}[\@][A-Za-z]{1,20}[\.](com|ru|ua)" placeholder="Email" name="email">
        <span>Your current email:<b><i><?=$user['email']?></i></b></span>
        <input type="password" class="input" placeholder="Password" name="password">
        <span>Your current password:<b><i><?=$user['password']?></i></b></span>
        <input type="submit" name="button" class="submit" value="Update">
    </form>