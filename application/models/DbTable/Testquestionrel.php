<?php


class Application_Model_DbTable_Testquestionrel extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'testquestionrel';

    // Метод для получения записи по id
    public function getTestquestionrel ($questionNumber,$test)
    {
        // Получаем id как параметр
        $questionNumber = (int)$questionNumber;
        $test = (int)$test;
        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('number = ' . $questionNumber.' AND testId = '.$test );

        // Если результат пустой, выкидываем исключение
        if (!$row) {
            return false;
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    public function addTestquestionrel ($data)
    {

        if(!$data){
            return false;
        }

        // Используем метод insert для вставки записи в базу
        $this->insert($data);
        return true;

    }

    public function updateTestquestionrel($data)
    {
        // Формируем массив значений
        if(!$data)
        {
            return false;
        }

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$data['id']);
        return true;

    }

    public function deleteTestquestionrelQuestionId($questionId)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('questionId = ' . (int)$questionId);
    }
    public function deleteTestquestionrelTestId($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('testId = ' . (int)$id);
    }
    public function currentNumber($testId)
    {
        $array_tests = $this->fetchAll($this->select()->from('testquestionrel', 'number')
            ->where('testId = ?', $testId));


        $i = 0;
        foreach ($array_tests->toArray() as $array) {
            foreach ($array as $arg) {
                $result[$i] = $arg;
                $i++;
            }
        }
        if($result == NULL){
            return 0;
        }
        return $result[$i - 1]++;
    }



}

?>