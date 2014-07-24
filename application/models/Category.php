<?php

class Application_Model_Category
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

    public function getCategory()
    {
        $category = new Application_Model_DbTable_Category();
        $categoryArray = $category->arrayCategory();
        $result = '<div class="leftBar"><h3>Категории</h3><ul class="nav nav-tabs nav-stacked">';
        foreach ($categoryArray as $cat)
        {
            $result = $result.'<li><a href="/index/category/id/'.$cat->getId().'">'.$cat->getName().'</a></li>';
        }
        $result = $result.'</ul></div>';
        return $result;

    }

    public function getUaCategory()
    {
        $category = new Application_Model_DbTable_Category();
        $categoryArray = $category->arrayCategory();
        $result = '<div class="leftBar"><h3>Категорії</h3><ul class="nav nav-tabs nav-stacked">';
        foreach ($categoryArray as $cat)
        {
            $result = $result.'<li><a href="/index/category/id/'.$cat->getId().'">'.$cat->getNameUa().'</a></li>';
        }
        $result = $result.'</ul></div>';
        return $result;

    }
}

?>