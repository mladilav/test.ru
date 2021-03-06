﻿<?php

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
    public function addUsers($username, $password, $password_rep, $email, $photo, $gender,$class,$letter, $date_reg, $role, $vk, $fc, $tw)
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
            'class' => $class,
            'letter' => $letter,
            'role' => $role,
            'vk' => $vk,
            'fc' => $fc,
            'tw' => $tw,
        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }


    // Метод для обновления записи
    public function updateUser($data)
    {
        if (!$data) {
            return false;
        }
        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);
    }

    public function deleteUser($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function getUsername($username)
    {
        $row = $this->fetchAll("username = '".$username."'");


        // Возвращаем результат, упакованный в массив
        return $row->count();
    }

    public function getUsernameEdit($data)
    {
        $row = $this->fetchAll("username = '".$data['username']."' AND id <> ".$data['id']);


        // Возвращаем результат, упакованный в массив
        return $row->count();
    }


    public function getPaginatorRows($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('users')->order('date_reg DESC'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(1);
        return $paginator;
    }


    public function getPaginatorRowsUsername($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('users')->order('username ASC'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(1);
        return $paginator;
    }

    public function getPaginatorRowsEmail($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('users')->order('email ASC'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(1);
        return $paginator;
    }

    public function getPaginatorRowsGroup($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('users')->order('group ASC'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(1);
        return $paginator;
    }

    public function getPaginatorRowsClass($pageNumber = 1) {
        $pagi = new Zend_Paginator_Adapter_DbSelect($this->select()->from('users')->order('class ASC')->order('letter ASC'));
        $paginator = new Zend_Paginator($pagi);
        $paginator->setCurrentPageNumber($pageNumber);
        $paginator->setItemCountPerPage(50);
        $paginator->setPageRange(1);
        return $paginator;
    }

}

