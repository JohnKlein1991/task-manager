# task_manager_mvc

Simple task manager;

You can try it here: http://mytestproject.ru/task-manager/tasks

Login: admin
password: 123

--------------------------------------------------------

Приложение-задачник.

Рабочая версия - http://mytestproject.ru/task-manager/tasks

Задачи состоят из:
- имени пользователя;
- е-mail;
- текста задачи;

Стартовая страница - список задач с возможностью сортировки по имени пользователя, email и статусу. Вывод задач нужно сделать страницами по 3 штуки (с пагинацией). Видеть список задач и создавать новые может любой посетитель без авторизации.

Вход для администратора (логин "admin", пароль "123"). Администратор имеет возможность редактировать текст задачи и поставить галочку о выполнении. Выполненные задачи в общем списке выводятся с соответствующей отметкой "отредактировано администратором".

В приложении с помощью чистого PHP реализована модель MVC
