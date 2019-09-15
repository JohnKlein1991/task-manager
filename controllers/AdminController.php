<?php


class AdminController
{
    public function actionIndex()
    {
        $login = '';
        $password = '';
        $message = '';
        $model = new Admin();
        $isAdmin = Admin::isLogged();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $login = isset($_POST['login']) ? trim($_POST['login']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            if(!$login || !$password){
                $message = 'Форма заполнена не полностью';
            } else {
                try {
                    $adminId = $model->checkUser($login, $password);
                    if($adminId){
                        $message = 'Спасибо, что Вы с нами!';
                        Admin::auth($adminId);
                        $isAdmin = true;
                    } else {
                        $message = 'Неправильный логин или пароль';
                    }
                } catch (Exception $e) {
                    $message = 'Что-то пошло не так, попробуйте позже';
                }
            }
        } else {
            if($isAdmin){
                $message = 'Вы уже вошли';
            }
        }
        require ROOT.'/views/admin/index.php';
        return true;
    }
    public function actionLogout()
    {
        Admin::logout();
//        header('Location: http://mytestproject.ru/task-manager/tasks');
//        header('Location: http://task-manager.com/task-manager/tasks');
    }
}