<?php

class Application_Model_Subcategory
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

    public function getSubcategory($catId)
    {
        $subcategory = new Application_Model_DbTable_Subcategory();
        $subcategoryArray = $subcategory->arraySubcategory($catId);
        if(!$subcategoryArray){
            return false;
        }
        $result = '<ul>';
        foreach ($subcategoryArray as $subcat)
        {
            $result = $result.'<li><a href="/index/subcategory/id/'.$subcat->getId().'">'.$subcat->getName().'</a></li>';
        }
        $result = $result.'</ul>';
        return $result;

    }

    public function getUaSubcategory($catId)
    {
        $subcategory = new Application_Model_DbTable_Subcategory();
        $subcategoryArray = $subcategory->arraySubcategory($catId);
        if(!$subcategoryArray){
            return false;
        }
        $result = '<ul>';
        foreach ($subcategoryArray as $subcat)
        {
            $result = $result.'<li><a href="/index/subcategory/id/'.$subcat->getId().'">'.$subcat->getNameUa().'</a></li>';
        }
        $result = $result.'</ul>';
        return $result;

    }
}

?>