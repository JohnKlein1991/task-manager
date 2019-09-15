<?php
// Модель для работы с задачами. При создании экземляра класса , создается подключение к бд

class Tasks
{
    private $db;
    private $table;

    public function __construct()
    {
        $dbData = include(ROOT.'/config/db.php');
        $host = $dbData['host'];
        $dbName = $dbData['db_name'];
        $dbUser = $dbData['db_user'];
        $dbPassword = $dbData['password'];
        $this->table = $dbData['table'];

        $this->db = new PDO('mysql:host='.$host.';dbname='.$dbName, $dbUser, $dbPassword);
    }

    public function getTasksList()
    {
        $sql = 'SELECT * FROM '.$this->table;
        $result = $this->db->query($sql);
        return $result->fetchAll();
    }
    public function createNewTask($name, $email, $text)
    {
        $stmt = $this->db->prepare('INSERT INTO '.$this->table.
            '(name, email, text)'.
            'VALUES (:name, :email, :text)');
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':text', $text);
        return $stmt->execute();
    }
    public function getTaskById($id)
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id;
        $result = $this->db->query($sql);
        return $result->fetch();
    }
    public function editTaskText($id, $text, $status, $isEdited)
    {
        $stmt = $this->db->prepare('UPDATE '.$this->table.
            ' SET status=:status, text=:text, is_edited=:is_edited'.
            ' WHERE id=:id');
        $data = [
            ':id' => $id,
            ':status' => $status,
            ':text' => $text,
            ':is_edited' => $isEdited
        ];
        return $stmt->execute($data);
    }
}