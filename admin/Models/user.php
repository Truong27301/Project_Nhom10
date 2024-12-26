<?php
class Users extends Db
{
    public function getAllUser()
    {
        $sql = self::$connection->prepare("SELECT * FROM `users`");
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    public function getUsernameByuser($user_name) {
        $sql = $this->connection->prepare("SELECT * FROM `users` WHERE `UserName` = ?");
        $sql->bind_param("s", $user_name);
        $sql->execute();
        $result = $sql->get_result();
        return $result->fetch_all(MYSQLI_ASSOC); // Return result as an associative array
    }
    public function delete($user_name)
    {
        $sql = self::$connection->prepare("DELETE FROM `users` WHERE `UserName` = ?");
        $sql->bind_param("s", $user_name);
        return $sql->execute();
    }
}