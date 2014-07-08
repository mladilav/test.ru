<?php

class Application_Model_DbTable_Question extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'question';

    // Метод для получения записи по id
    public function getQuestion($id)
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

    public function addQuestion($name, $type, $topicId, $testId)
    {

        $data = array(
            'name' => $name,
            'type' => $type,
            'topicId' => $topicId,
            'testId' => $testId,

        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);

    }

    public function updateQuestion($id, $name, $type, $topicId, $testId)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'type' => $type,
            'topicId' => $topicId,
            'testId' => $testId,
        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);

    }

    public function deleteQuestion($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }

    public function arrayQuestion()
    {
        $array_tests = $this->fetchAll($this->select()->from('question', 'name'));
        $i = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }
        return $result;
    }


    public function currentQuestion()
    {
        $array_tests = $this->fetchAll($this->select()->from('question', 'id'));
        $i = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }
        return $result[$i-1];
    }
}

?>