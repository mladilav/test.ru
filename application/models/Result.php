<?php
class Application_Model_Result
{
    protected $userId;
    protected $user;
    protected $test;
    protected $testUa;
    protected $testId;
    protected $result;
    protected $date;
    protected $time;


    public function __construct( $array)
    {
        $this->user = $array['user'];
        $this->userId = $array['userId'];
        $this->test = $array['test'];
        $this->testUa = $array['testUa'];
        $this->testId = $array['testId'];
        $this->result = $array['result'];
        $this->date = $array['date'];
        $this->time = $array['time'];

    }
    public function getData()
    {
        $data = array(
            'test' => $this->test,
            'testUa' => $this->testUa,
            'testId' => $this->testId,
            'result' => $this->result,
            'date' => $this->date,
            'time' => $this->time,
            'user' => $this->user,
            'userId' => $this->userId,
        );
        return $data;
    }

    public function getResult()
    {
        return $this->bool;
    }

}
?>