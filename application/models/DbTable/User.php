<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'users';

    // Метод для получения записи по id
    public function getUser($id)
    {
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('id = ' . $id);

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    // Метод для добавление новой записи
    public function addUsers($username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw)
    {

        // Формируем массив вставляемых значений
        if ($password != $password_rep) {
            echo 'Пароли не совпадают!';
            exit;
        }

        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'photo' => $photo,
            'gender' => $gender,
            'date_reg' => $date_reg,
            'role' => $role,
            'vk' => $vk,
            'fc' => $fc,
            'tw' => $tw,
        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }


    // Метод для обновления записи
    public function updateUser($id, $username, $password, $password_rep, $email, $photo, $gender, $date_reg, $role, $vk, $fc, $tw)
    {
        if ($password != $password_rep) {
            echo 'Пароли не совпадают!';
            exit;
        }

        // Формируем массив значений
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'photo' => $photo,
            'gender' => $gender,
            'date_reg' => $date_reg,
            'role' => $gender,
            'vk' => $vk,
            'fc' => $fc,
            'tw' => $tw,
        );


        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);
    }
    /*

    // Метод для удаления записи
    public function deleteMovie($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

*/
}

