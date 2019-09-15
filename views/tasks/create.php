<?php
/* @var $message string */
/* @var $name string */
/* @var $email string */
/* @var $text string */
/* @var $success bool */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
if (!$success) :
?>
<div class="container">
    <div class="page-header text-center">
        <h3>Создание новой задачи</h3>
    </div>
    <form method="post" id="create_form">
        <div class="form-group">
            <label for="name_input">Имя</label>
            <input type="text" value="<?=$name?>" name="name" class="form-control" id="name_input" placeholder="Введите свое имя">
        </div>
        <div class="form-group">
            <label for="email_input">Email</label>
            <input type="email" value="<?=$email?>" name="email" class="form-control" id="email_input" aria-describedby="emailHelp" placeholder="Введите свой email">
        </div>
        <div class="form-group">
            <label for="text_textarea">Введите текст задачи</label>
            <textarea class="form-control" name="text" id="text_textarea" rows="3"><?=$text?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать задачу</button>
    </form>
</div>
<hr>
<?php
endif;
?>
<a class="btn btn-primary" href="/task-manager/tasks" role="button">Вернуться на главную</a>

<script>
    $('#create_form').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            text: "required"
        },
        messages: {
            name: "Введите имя",
            email: {
                required: "Введите email",
                email: "Email не соответствует формату name@domain.com"
            },
            text: "Введите текст задачи"
        }
    });
</script>
</body>
</html>
