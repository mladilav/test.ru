<?php
class Application_Model_Resulttest
{
    protected $userId;
    protected $bool;
    protected $testId;
    protected $number;


    public function __construct( $array)
    {
        $this->userId = $array['userId'];
        $this->bool = $array['bool'];
        $this->testId = $array['testId'];
        $this->number = $array['number'];

    }
    public function getData()
    {
        $data = array(
            'number' => $this->number,
            'bool' => $this->bool,
        );
        return $data;
    }

    public function getResult()
    {
        return $this->bool;
    }

}
?>