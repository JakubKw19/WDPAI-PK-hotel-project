<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="ellipsis">
            <img class="logotype" src="public/img/logotype.svg" alt="logotype">
        </div>
        <div class="login-container">
            <h1 class="signin">Sign In</h1>
            <form action="login" method="POST">
                <div class="input-container">
                    <label for="email">Email</label>
                    <input name="email" type="text" placeholder="email@email.com">
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input name="password" type="password" placeholder="Password">
                </div>
                <div class="message-container">
                    <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <div class="input-container">
                    <button type="submit" class="login-button">CONTINUE</button>
                    <button class="fb-button">WITH FACEBOOK</button>
                </div>
            </form>
        </div>
    </div>
</body>