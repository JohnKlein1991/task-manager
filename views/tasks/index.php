<?php
/* @var $tasksArr array */
/* @var $message string */
/* @var $isAdmin bool */
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#tasks_table').DataTable({
                pageLength: 3,
                lengthChange: false,
                searching: false,
                columnDefs: [
                    { targets: 'not_orderable', orderable: false},
                ]
            });
        } );
    </script>
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
?>
    <div class="container">
        <div class="page-header text-center">
            <h3>Список задач</h3>
        </div>
    </div>
    <table id="tasks_table">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Статус</th>
                <th class="not_orderable">Текст</th>
                <?php if($isAdmin) :?>
                    <th class="not_orderable">Редактирование</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tasksArr as $task) :
            ?>
            <tr>
                <td><?=htmlentities($task['name'])?></td>
                <td><?=htmlentities($task['email'])?></td>
                <td><?=htmlentities($task['status']) ? 'Выполнено' : ''?>
                    <?=htmlentities($task['is_edited']) ? 'Отредактировано администратором' : ''?></td>
                <td><?=htmlentities($task['text'])?></td>
                <?php if($isAdmin) :?>
                    <td><a href="/task-manager/tasks/edit/<?=$task['id']?>">Редактировать</a></td>
                <?php endif; ?>
            </tr>
            <?php
            endforeach;?>
        </tbody>
    </table>
    <a class="btn btn-primary" href="/task-manager/tasks/create" role="button">Создать новую задачу</a>
    <?php
    if(!$isAdmin) :
    ?>
    <a class="btn btn-primary" href="/task-manager/admin" role="button">Войти</a>
    <?php
    else :
    ?>
    <a class="btn btn-primary" href="/task-manager/admin/logout" role="button">Выйти</a>
    <?php
    endif;
    ?>
</body>
</html>
