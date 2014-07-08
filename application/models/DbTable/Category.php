<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'category';

    // Метод для получения записи по id
    public function getCategory($id)
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

    public function addCategory($name, $userId, $partId)
    {

        $data = array(
            'name' => $name,
            'partId' => $partId,
            'userId' => $userId,


        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateCategory($id, $name, $userId, $partId)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'userId' => $userId,
            'partId' => $partId,
        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);

    }

    public function deleteCategory($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
}

?>