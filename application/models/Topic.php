<?php
class Application_Model_Topic
{
    protected $id;
    protected $name;
    protected $nameUa;


    public function __construct( $array)
    {
        $this->id = $array['id'];
        $this->name = $array['name'];
        $this->nameUa = $array['nameUa'];

    }

    public function getName()
    {
        return $this->name;
    }

    public function getNameUa()
    {
        return $this->nameUa;
    }
    public function getId()
    {
        return $this->id;
    }

}
?>