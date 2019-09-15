<?php
// Модель для работы с пользователями. При создании экземпляра класса , подключается к бд

class Admin
{
    private $db;
    private $table;

    public static function auth($id)
    {
        session_start();
        $_SESSION['admin'] = $id;
        session_write_close();
    }
    public static function isLogged()
    {
        session_start();
        $result = isset($_SESSION['admin']);
        session_write_close();
        return $result;
    }
    public static function logout()
    {
        session_start();
        unset($_SESSION['admin']);
        session_write_close();
    }

    public function __construct()
    {
        $dbData = include(ROOT.'/config/db.php');
        $host = $dbData['host'];
        $dbName = $dbData['db_name'];
        $dbUser = $dbData['db_user'];
        $dbPassword = $dbData['password'];
        $this->table = $dbData['admin_table'];

        $this->db = new PDO('mysql:host='.$host.';dbname='.$dbName, $dbUser, $dbPassword);
    }

    // проверяет, есть ли такой пользователь
    public function checkUser($login, $password)
    {
        $stmt = $this->db->prepare('SELECT id, password_hash FROM '.$this->table.' WHERE login=:login');
        $stmt->bindValue(':login', $login);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result && isset($result['password_hash'])){
            $hash = $result['password_hash'];
            return password_verify($password, $hash) ? $result['id'] : false;
        }
        return false;
    }
}