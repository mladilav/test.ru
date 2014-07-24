<?php
class Application_Model_Result
{
    protected $userId;
    protected $testId;
    protected $result;
    protected $date;
    protected $time;


    public function __construct( $array)
    {
        $this->userId = $array['userId'];
        $this->testId = $array['testId'];
        $this->result = $array['result'];
        $this->date = $array['date'];
        $this->time = $array['time'];

    }
    public function getData()
    {
        $data = array(
            'testId' => $this->testId,
            'result' => $this->result,
            'date' => $this->date,
            'time' => $this->time,
        );
        return $data;
    }

    public function getResult()
    {
        return $this->bool;
    }

}
?>