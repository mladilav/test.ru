<?php

class Application_Model_DbTable_Part extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'part';

    // Метод для получения записи по id
    public function getPart($id)
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

    public function addPart($name, $userId)
    {

        $data = array(
            'name' => $name,
            'userId' => $userId,

        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updatePart($id, $name, $userId)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'userId' => $userId,
        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);

    }

    public function deletePart($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
}

?>