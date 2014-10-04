<?php

class Application_Model_Tests
{

    protected $int;
    protected $name;
    protected $nameUa;
    protected $author;
    protected $userId;
    protected $topicId;

    public function __construct($array)
    {
        if(!empty($array)){
            $this->int = $array['int'];
            $this->name = $array['name'];
            $this->author = $array['author'];
            $this->userId = $array['userId'];
            $this->topicId = $array['topicId'];
            $this->nameUa = $array['nameUa'];
        }

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
        return $this->int;
    }
    public function getTopicId()
    {
        return $this->topicId;
    }

    public function getTests()
    {
        $test = new Application_Model_DbTable_Test();
        $topic = new Application_Model_DbTable_Topic();
        $topics = $topic->arrayTopic();
        $i = 0;
        $result = '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle main-menu test" data-toggle="collapse" data-parent="#accordion4" href="#tests'.$i.'">';
        $result .= 'Тесты';
        $result .= '</a></div>
                           <div id="tests'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner">';
        $result .= '<div class="accordion" id="accordion4">';
        foreach ($topics as $top)
        {
            if($top->getId() == 1){

            }
            else
            {
            $result .= '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#test'.$i.'">';
            $result .= $top->getName();
            $result .= '</a></div>
                           <div id="test'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner"><ul>';
                            $tests = $test->arrayObjectsTest($top->getId());
                            foreach($tests as $tes)
                            {
                                $result .= '<li><a class="tests" href="/test/question/test/'.$tes->getId().'/question/1">'.$tes->getName().'</a></li>';

                            }
                            $result .='</ul></div></div></div>';
                $i++;
            }

        }
        $result .= '</div></div></div></div>';
        return $result;
    }

    public function getUaTests()
    {
        $test = new Application_Model_DbTable_Test();
        $topic = new Application_Model_DbTable_Topic();
        $topics = $topic->arrayTopic();
        $i = 0;
        $result = '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle main-menu test" data-toggle="collapse" data-parent="#accordion4" href="#tests'.$i.'">';
        $result .= 'Тести';
        $result .= '</a></div>
                           <div id="tests'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner">';
        $result .= '<div class="accordion" id="accordion4">';
        foreach ($topics as $top)
        {
            if($top->getId() == 1){

            }
            else
            {
                $result .= '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#test'.$i.'">';
                $result .= $top->getNameUa();
                $result .= '</a></div>
                           <div id="test'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner"><ul>';
                $tests = $test->arrayObjectsTest($top->getId());
                foreach($tests as $tes)
                {
                    $result .= '<li><a class="tests" href="/test/question/test/'.$tes->getId().'/question/1">'.$tes->getNameUa().'</a></li>';

                }
                $result .='</ul></div></div></div>';
                $i++;
            }

        }
        $result .= '</div></div></div></div>';
        return $result;
    }



    public function getRating()
    {
        $test = new Application_Model_DbTable_Test();
        $topic = new Application_Model_DbTable_Topic();
        $topics = $topic->arrayTopic();
        $i = 0;
        $result = '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle main-menu rating" data-toggle="collapse" data-parent="#accordion4" href="#ratings'.$i.'">';
        $result .= 'Рейтинги';
        $result .= '</a></div>
                           <div id="ratings'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner">';
        $result .= '<div class="accordion" id="accordion5">';
        foreach ($topics as $top)
        {
            if($top->getId() == 1){

            }
            else
            {
                $result .= '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle " data-toggle="collapse" data-parent="#accordion5" href="#rating'.$i.'">';
                $result .= $top->getName();
                $result .= '</a></div>
                           <div id="rating'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner"><ul>';
                $tests = $test->arrayObjectsTest($top->getId());
                foreach($tests as $tes)
                {
                    $rating = new Application_Model_DbTable_Result();
                    $ratingArray = $rating->fetchAll($rating->select()->where('testId ='.$tes->getId())->where('type =?','rating'));
                    if($ratingArray->count()>0){
                    $result .= '<li><a class="tests" href="/test/rating/id/'.$tes->getId().'">'.$tes->getName().'</a></li>';
                    }

                }
                $result .='</ul></div></div></div>';
                $i++;
            }

        }
        $result .= '</div></div></div></div>';
        return $result;
    }

    public function getUaRating()
    {
        $test = new Application_Model_DbTable_Test();
        $topic = new Application_Model_DbTable_Topic();
        $topics = $topic->arrayTopic();
        $i = 0;
        $result = '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle main-menu rating" data-toggle="collapse" data-parent="#accordion4" href="#ratings'.$i.'">';
        $result .= 'Рейтинги';
        $result .= '</a></div>
                           <div id="ratings'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner">';
        $result .= '<div class="accordion" id="accordion5">';
        foreach ($topics as $top)
        {
            if($top->getId() == 1){

            }
            else
            {
                $result .= '<div class = "accordion-group"><div class="accordion-heading">
                       <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion5" href="#rating'.$i.'">';
                $result .= $top->getNameUa();
                $result .= '</a></div>
                           <div id="rating'.$i.'" class="accordion-body collapse ">
                           <div class="accordion-inner"><ul>';
                $tests = $test->arrayObjectsTest($top->getId());
                foreach($tests as $tes)
                {
                    $rating = new Application_Model_DbTable_Result();
                    $ratingArray = $rating->fetchAll($rating->select()->where('testId ='.$tes->getId())->where('type =?','rating'));
                    if($ratingArray->count()>0){
                        $result .= '<li><aclass="tests" href="/test/rating/id/'.$tes->getId().'">'.$tes->getNameUa().'</a></li>';
                    }

                }
                $result .='</ul></div></div></div>';
                $i++;
            }

        }
        $result .= '</div></div></div></div>';
        return $result;
    }
}

?>