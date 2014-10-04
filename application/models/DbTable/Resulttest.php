<?php

class Application_Model_DbTable_Resulttest extends Zend_Db_Table_Abstract
{

    // Имя таблицы, с которой будем работать
    protected $_name = 'resulttest';

    // Метод для получения записи по id

    public function addResulttest($data)
    {

        if(!$data){
            return false;
        }
        $result = $this->fetchAll($this->select()
                                       ->from("resulttest")
                                       ->where('testId = '.$data['testId'].' AND number = '.$data['number']));


        if ($result->count() != 0)
        {$this->update($data, 'testId = '.$data['testId'].' AND number = '.$data['number']);
            return true;} else
         {
        $this->insert($data);}
        return true;

    }

    public function result($testId)
    {
        $result = 0;
        $data = $this->fetchAll($this->select()
            ->from('resulttest')
            ->where('testId = ?', $testId));
        if ($data->count() == 0)
        {return false;}
        foreach ($data as $row) {
            $answer = new Application_Model_Resulttest($row);
            $result = $result + $answer->getResult();
        }

        return $result;
    }

    public function resultInfo($testId)
    {
        $result = 0;
        $data = $this->fetchAll($this->select()
            ->from('resulttest')
            ->where('testId = ?', $testId));
        foreach ($data as $row) {
            $answer = new Application_Model_Resulttest($row);
            $result[] = $answer;
        }

        return $result;
    }

    public function truncate()
    {
        $this->delete('userId = '.Zend_Auth::getInstance()->getIdentity()->id);
    }


}

?>