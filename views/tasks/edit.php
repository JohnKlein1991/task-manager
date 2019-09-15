<?php
/* @var $message string */
/* @var $text string */
/* @var $success bool */
/* @var $name string */
/* @var $email bool */
/* @var $status bool */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Редактировать задачу</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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
if(!$success) :
?>
<div class="container">
    <div class="page-header text-center">
        <h3>Редактирование задачи</h3>
    </div>
    <form method="post" >
        <div class="form-group">
            <label for="name_input">Имя</label>
            <input type="text" value="<?=$name?>"  class="form-control" id="name_input" disabled>
        </div>
        <div class="form-group">
            <label for="email_input">Email</label>
            <input type="email" value="<?=$email?>" class="form-control" id="email_input" disabled>
        </div>
        <div class="form-group">
            <label for="text_textarea">Текст задачи</label>
            <textarea class="form-control" name="text" id="text_textarea" rows="3"><?=$text?></textarea>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="status" id="success_checkbox"
            <?=$status ? 'checked' : ''?>>
            <label class="form-check-label" for="success_checkbox">
                Завершить задачу
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Редактировать задачу</button>
    </form>
</div>
<hr>
<?php
endif;
?>
<a class="btn btn-primary" href="/task-manager/tasks" role="button">Вернуться на главную</a>
</body>
</html>
