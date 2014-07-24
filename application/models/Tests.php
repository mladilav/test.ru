<?php

class Application_Model_Tests
{

    protected $int;
    protected $name;
    protected $author;
    protected $userId;
    protected $type;

    public function __construct($array)
    {
        if(!empty($array)){
            $this->int = $array['int'];
            $this->name = $array['name'];
            $this->author = $array['author'];
            $this->userId = $array['userId'];
            $this->type = $array['type'];
        }

    }

    public function getName()
    {
        return $this->name;
    }
    public function getId()
    {
        return $this->int;
    }

    public function getTests()
    {
        $result = '<div class="leftBar"><h3>Тесты</h3>';
        $result = $result.'<div class="accordion" id="accordion2">';
        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                           Легкий уровень </a>
                           </div>
                           <div id="collapseOne" class="accordion-body collapse ">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(0);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';

        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                           Средний уровень </a>
                           </div>
                           <div id="collapseTwo" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(2);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';

        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                           Тяжелый уровень </a>
                           </div>
                           <div id="collapseThree" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(3);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';

        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                           Задачи </a>
                           </div>
                           <div id="collapseFour" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(4);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';


        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                           Экспресс тест </a>
                           </div>
                           <div id="collapseFive" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(5);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';
        $result = $result.'</div></div>';
        return $result;

    }

    public function getUaTests()
    {
        $result = '<div class="leftBar"><h3>Тести</h3>';
        $result = $result.'<div class="accordion" id="accordion2">';
        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                           Легкий рівень </a>
                           </div>
                           <div id="collapseOne" class="accordion-body collapse ">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(0);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';

        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                           Середній рівень </a>
                           </div>
                           <div id="collapseTwo" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(2);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';

        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                           Важкий рівень </a>
                           </div>
                           <div id="collapseThree" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(3);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';

        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                           Задачі </a>
                           </div>
                           <div id="collapseFour" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(4);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';


        $result = $result.'<div class ="accordion-group">
                           <div class="accordion-heading">
                           <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                           Експрес тест </a>
                           </div>
                           <div id="collapseFive" class="accordion-body collapse">
                           <div class="accordion-inner"><ul>';
        $tests = new Application_Model_DbTable_Test();
        $testArray = $tests->arrayObjectsTest(5);
        foreach ($testArray as $test)
        {
            $result = $result.'<li><a href="/test/question/test/'.$test->getId().'/question/1">'.$test->getName().'</a></li>';
        }
        $result = $result.'</ul></div></div></div>';
        $result = $result.'</div></div>';
        return $result;

    }
}

?>