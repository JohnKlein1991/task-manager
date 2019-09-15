<?php
class TasksController
{
    public function actionIndex()
    {
        $isAdmin = Admin::isLogged();
        $tasksArr = [];
        $message = '';
        try {
            $model = new Tasks();
            $tasksArr = $model->getTasksList();
        } catch (Exception $e){
            $message = 'Что-то пошло не так, попробуйте позже';
        }
        require ROOT.'/views/tasks/index.php';
        return true;
    }
    public function actionCreate()
    {
        $message = '';
        $name = '';
        $email = '';
        $text = '';
        $success = false;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $text = trim($_POST['text']);

            if(!$name || !$email || !$text){
                $message = 'Данные заполнены не полностью!';
            } elseif (!$this->checkEmail($email)) {
                $message = 'Введите корректный email!';
            } else {
                try {
                    $model = new Tasks();
                    $result = $model->createNewTask($name, $email, $text);
                    if($result){
                        $message = 'Данные успешно добавлены';
                        $success = true;
                    } else {
                        $message = 'Что-то пошло не так, попробуйте позже';
                    }

                } catch (Exception $e){
                    $message = 'Что-то пошло не так, попробуйте позже';
                }
            }
        }
        require ROOT.'/views/tasks/create.php';
        return true;
    }
    public function actionEdit($id)
    {
        if(!Admin::isLogged()){
            (new AdminController())->actionIndex();
            exit();
        }
        $model = new Tasks();
        $data = $model->getTaskById($id);
        if(!$data){
            return;
        }
        $success = false;
        $message = '';
        $name = $data['name'];
        $email = $data['email'];
        $text = $data['text'];
        $status = (bool) $data['status'] ? 1 : 0;
        $isEdited = (bool) $data['is_edited'] ? 1 : 0;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $text = trim($_POST['text']);
            $status = isset($_POST['status']) ? 1 : 0;
            if(!$text){
                $message = 'Нельзя удалить полностью текст задачи!';
            } else {
                try {
                    if (!$isEdited && $data['text'] !== $text){
                        $isEdited = 1;
                    }
                    $model = new Tasks();
                    $result = $model->editTaskText($id, $text, $status, $isEdited);
                    if($result){
                        $message = 'Данные успешно обновлены';
                        $success = true;
                    } else {
                        $message = 'Что-то пошло не так, попробуйте позже';
                    }

                } catch (Exception $e){
                    $message = 'Что-то пошло не так, попробуйте позже';
                }
            }
        }
        require ROOT.'/views/tasks/edit.php';
        return true;
    }
    private function checkEmail($email)
    {
        //взял у Yii2 https://github.com/yiisoft/yii2/blob/master/framework/validators/EmailValidator.php
        $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';
        return preg_match($pattern, $email) ? true : false;
    }
}