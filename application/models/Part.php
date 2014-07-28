<?php

class Application_Model_Part
{

    protected $id;
    protected $name;
    protected $nameUa;


    public function __construct($array)
    {
        if(!empty($array)){
            $this->id = $array['id'];
            $this->name = $array['name'];
            $this->nameUa = $array['nameUa'];}

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

    public function getPart()
    {
        $part = new Application_Model_DbTable_Part();
        $partArray = $part->objParts();
        $array = array();
        $result = '<div class="leftBar"><h3>Меню</h3><div class="accordion" id="accordion2">';
        $i = 0;
        $test = new Application_Model_Tests($array);
        $result .= $test->getTests();

        $result .= $test->getRating();
        foreach ($partArray as $parts)
        {
            $result .= '<div class ="accordion-group">
                        <div class="accordion-heading">';
            $category = new Application_Model_Category($array);
            $resultCat = $category->getCategory($parts->getId());
            if(!$resultCat)
            {$result = $result.'<a class="accordion-toggle" href="/index/part/id/'.$parts->getId().'">'.$parts->getName().'</a></div></div>';}
            else
            {
                $result = $result.'<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$i.'">
                           '.$parts->getName().' </a>
                           </div>
                           <div id="collapse'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner">';
                $result .= $resultCat;
                $result .= '</div></div></div>';
                $i++;
            }
        }

        $result = $result.'</div></div>';
        return $result;

    }




    public function getUaPart()
    {
        $part = new Application_Model_DbTable_Part();
        $partArray = $part->objParts();
        $array = array();
        $result = '<div class="leftBar"><h3>Меню</h3><div class="accordion" id="accordion2">';
        $i = 0;
        $test = new Application_Model_Tests($array);
        $result .= $test->getUaTests();
        $result .= $test->getUaRating();
        foreach ($partArray as $parts)
        {
            $result .= '<div class ="accordion-group">
                        <div class="accordion-heading">';
            $category = new Application_Model_Category($array);
            $resultCat = $category->getUaCategory($parts->getId());
            if(!$resultCat)
            {$result = $result.'<a class="accordion-toggle" href="/index/part/id/'.$parts->getId().'">'.$parts->getNameUa().'</a></div></div>';}
            else
            {
                $result = $result.'<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse'.$i.'">
                           '.$parts->getNameUa().' </a>
                           </div>
                           <div id="collapse'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner">';
                $result .= $resultCat;
                $result .= '</div></div></div>';
                $i++;
            }
        }
        $result = $result.'</div></div>';
        return $result;

    }


}

?>