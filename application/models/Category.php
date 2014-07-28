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

    public function getCategory($partId)
    {
        $array = array();
        $category = new Application_Model_DbTable_Category();
        $categoryArray = $category->arrayCategory($partId);
        if(!$categoryArray){
            return false;
        }
        $i = 0;
        $result = '<div class="accordion" id="accordion3">';
        foreach ($categoryArray as $cat)
        {
            $result .= '<div class ="accordion-group">
                        <div class="accordion-heading">';
            $subcategory = new Application_Model_Subcategory($array);
            $resultSubCat = $subcategory->getSubcategory($cat->getId());
            if(!$resultSubCat)
            {$result = $result.'<li><a class="accordion-toggle" href="/index/category/id/'.$cat->getId().'">'.$cat->getName().'</a></li></div></div>';}
            else
            {
                $result = $result.'<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#cat'.$i.'">
                           '.$cat->getName().' </a>
                           </div>
                           <div id="cat'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner"> ';
                $result .= $resultSubCat;
                $result .= '</div></div></div>';
                $i++;
            }
        }
        $result = $result.'</div>';
        return $result;

    }

    public function getUaCategory($partId)
    {
        $array = array();
        $category = new Application_Model_DbTable_Category();
        $categoryArray = $category->arrayCategory($partId);
        if(!$categoryArray){
            return false;
        }
        $i = 0;
        $result = '<div class="accordion" id="accordion3">';
        foreach ($categoryArray as $cat)
        {
            $result .= '<div class ="accordion-group">
                        <div class="accordion-heading">';
            $subcategory = new Application_Model_Subcategory($array);
            $resultSubCat = $subcategory->getUaSubcategory($cat->getId());
            if(!$resultSubCat)
            {$result = $result.'<li><a class="accordion-toggle" href="/index/category/id/'.$cat->getId().'">'.$cat->getNameUa().'</a></li></div></div>';}
            else
            {
                $result = $result.'<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#cat'.$i.'">
                           '.$cat->getNameUa().' </a>
                           </div>
                           <div id="cat'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner"> ';
                $result .= $resultSubCat;
                $result .= '</div></div></div>';
                $i++;
            }
        }
        $result = $result.'</div>';
        return $result;

    }
}

?>