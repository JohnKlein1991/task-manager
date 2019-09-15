<?php
/* @var $message string */
/* @var $login string */
/* @var $password string */
/* @var $isAdmin bool */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <style>
        label.error {
            color: red;
        }
    </style>
</head>
<body>
<?php
if($message) :
    ?>
    <div class="alert alert-info" role="alert">
        <?=$message?>
    </div>
<?php
endif;
if(!$isAdmin) :
?>

<div class="container">
    <div class="page-header text-center">
        <h3>Вход</h3>
    </div>
    <form method="post" id="login_form">
        <div class="form-group">
            <label for="login_input">Логин</label>
            <input type="text" value="<?=$login?>" name="login" class="form-control" id="login_input" placeholder="Логин">
        </div>
        <div class="form-group">
            <label for="password_input">Пароль</label>
            <input type="password" value="<?=$password?>" name="password" class="form-control" id="password_input" placeholder="Пароль">
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
<hr>
<?php
endif;
?>
<a class="btn btn-primary" href="/task-manager/tasks" role="button">На главную</a>

<script>
    $('#login_form').validate({
        rules: {
            login: "required",
            password: "required"
        },
        messages: {
            login: "Заполните поле",
            password: "Заполните поле"
        }
    });
</script>
</body>
</html>
