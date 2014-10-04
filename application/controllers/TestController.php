<?php

class TestController extends Zend_Controller_Action
{
    public function init()

    {
        if($this->getRequest()->isPost()){
            $lang = $this->getRequest()->getPost('lang');
            if(empty($lang)){
                $request = new Zend_Controller_Request_Http();
                $lang = $request->getCookie('lang');
            }
            else{
                $request = new Zend_Controller_Request_Http();
                $this->getResponse()->setRawHeader(new Zend_Http_Header_SetCookie(
                    'lang', $lang, NULL, '/', $request->getServer('HTTP_HOST'), false, true
                ));}
        }
        else {
            $request = new Zend_Controller_Request_Http();
            $lang = $request->getCookie('lang');
        }

        $array = array();
        $part= new Application_Model_Part($array);
        $menu= new Application_Model_Menu();
        $this->view->lang = $lang;

        if($lang == "ua"){
            $this->view->layout()->part = $part->getUaPart();
            $this->view->layout()->auth = $menu->getAuthUa();
            $this->view->layout()->menu = $menu->getUaMenu();
        }
        else {
            $this->view->layout()->part = $part->getPart();
            $this->view->layout()->auth = $menu->getAuth();
            $this->view->layout()->menu = $menu->getMenu();
        }
    }

    public function indexAction()
    {
        $test = new Application_Model_DbTable_Test();
        $this->view->tests = $test->fetchAll();

    }

    public function addtestAction()
    {
        $form = new Application_Form_Addtest();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Назва тесту російською:");
            $form->nameUa->setLabel("Назва тесту українською:");
            $form->comments->setLabel("Коментар:");

            $form->add->setLabel("Додати тест");
        }

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'author' => Zend_Auth::getInstance()->getIdentity()->username,
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                    'topicId' => $form->getValue('topic'),
                    'comments' => $form->getValue('comments'),

                );

                // Создаём объект модели

                $test = new Application_Model_DbTable_Test();


                // Вызываем метод модели addMovie для вставки новой записи
                $test->addTest($data);
                $this->_helper->redirector->gotoUrl('/test/build/type/' . $form->getValue('type'));

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function edittestAction()
    {
        $form = new Application_Form_Addtest();
        $this->view->form = $form;
        $form->add->setLabel("Сохранить");
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Назва тесту російською:");
            $form->nameUa->setLabel("Назва тесту українською:");
            $form->comments->setLabel("Коментар:");
            $form->add->setLabel("Зберегти");
        }
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'int' => (int)$form->getValue('int'),
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'author' => Zend_Auth::getInstance()->getIdentity()->username,
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                    'topicId' => $form->getValue('topic'),
                    'comments' => $form->getValue('comments'),

                );

                // Создаём объект модели

                $tests = new Application_Model_DbTable_Test();


                // Вызываем метод модели addMovie для вставки новой записи
                $tests->updateTest($data);

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        } else {
            // Если мы выводим форму, то получаем id фильма, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $test = new Application_Model_DbTable_Test();
                // Заполняем форму информацией при помощи метода populate
                $form->populate($test->getTest($id));

            }
        }
    }

    public function deletetestAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да' || $del == 'Так' ) {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $test = new Application_Model_DbTable_Test();
                $testQuestionRel = new Application_Model_DbTable_Testquestionrel();
                // Вызываем метод модели deleteMovie для удаления записи
                $testQuestionRel->deleteTestquestionrelTestId($id);
                $test->deleteTest($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('construct', 'test');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $test = new Application_Model_DbTable_Test();

            // Достаём запись и передаём в view
            $this->view->test = $test->getTest($id);
        }
    }

    public function typequestionAction()
    {
        $form = new Application_Form_Typequestion();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->add->setLabel("Далі");
            $form->type->setLabel("Складність питання:");
            $form->type->addMultiOptions(array(
                '0' => 'Легкий рівень',
                '1' => 'Середній рівень',
                '2' => 'Важкий рівень',
                '3' => 'Задачі',
            ));
        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                if ($form->getValue('type') == 0) {
                    $this->_helper->redirector->gotoUrl('/test/addquestion1');
                }
                if ($form->getValue('type') == 1) {
                    $this->_helper->redirector->gotoUrl('/test/addquestion2');
                }
                if ($form->getValue('type') == 2) {
                    $this->_helper->redirector->gotoUrl('/test/addquestion3');
                }
                if ($form->getValue('type') == 3) {
                    $this->_helper->redirector->gotoUrl('/test/addquestion4');
                }

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function questionAction()
    {
        $resulttest = new Application_Model_DbTable_Resulttest();
        $test = $this->_getParam('test', 0);
        if ($test > 0) {

            $testsM = new Application_Model_DbTable_Test();
            $topicM = new Application_Model_DbTable_Topic();
            $testArr = $testsM->getTest($test);
            $this->view->topic = $topicM->getTopicId($testArr['topicId']);
            $this->view->test = $testArr;
            $questionNumber = $this->_getParam('question', 0);
            if ($questionNumber == 1) {
                $_SESSION['time'] = time();
                $result = new Application_Model_DbTable_Resulttest();
                $result->truncate();
                $testModel = new Application_Model_DbTable_Testquestionrel();
                $testAll = $testModel->fetchAll("testId = ".(int)$test);
                $numTests = $testAll->count();
                for($j = 1; $j <= $numTests;$j++){

                    $dataOne = array(
                        'number' => $j,
                        'bool' => 0,
                        'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                        'testId' => $test,
                    );

                    $resulttest->addResulttest($dataOne);
                }

            }
            else
            {   $tests_ar = new Application_Model_DbTable_Test();
                $this->view->testsArray = $tests_ar->getTest($test);
                $test_arr = $tests_ar->getTest($test);
                if((time()-$_SESSION['time']>=21600)&&($test_arr['topicId']== 1)){
                    $this->_helper->redirector->gotoUrl('/test/result/testId/' . $test);
                }
            }
            $this->view->questionNumber = $questionNumber;
            $this->view->testId = $test;
            $this->view->time = 21600 - (time()-$_SESSION['time']);
            $questionId = new Application_Model_DbTable_Testquestionrel();
            $questions_array = $questionId->getTestquestionrel($questionNumber, $test);

            if (!$questions_array) {
                $this->_helper->redirector->gotoUrl('/test/result/testId/' . $test);
            }
            $question = new Application_Model_DbTable_Question();
            $questions = $question->getQuestion($questions_array['questionId']);
            $request = new Zend_Controller_Request_Http();
            $lang = $request->getCookie('lang');


            if ($questions["type"] == 0) {
                $form = new Application_Form_TestsOne();
            }
            if ($questions["type"] == 2) {
                $form = new Application_Form_TestsTwo();
            }
            if ($questions["type"] == 3) {
                $form = new Application_Form_TestsThree();
            }

            if ($questions["type"] == 4) {
                $form = new Application_Form_TestsFour();
            }

            if($lang == "ua")
            {
                $this->view->question = $questions['nameUa'];
                $answer = $questions["answersUa"];

                $form->add->setLabel('Далі');

            }else {

                $this->view->question = $questions['name'];
                $answer = $questions["answers"];
            }

            $this->view->type = $questions['type'];
            if($questions['type']!= 4)
            {$answer = unserialize($answer);}
            $this->view->answer = $answer;

            if ($questions["capture"] != NULL) {
                $this->view->capture = '<img src ="' . $questions["capture"] . '">';
            }
            $this->view->form = $form;


            if ($this->getRequest()->isPost()) {
                // Принимаем его
                $formData = $this->getRequest()->getPost();

                // Если форма заполнена верно
                if ($form->isValid($formData)) {

                    $results = 0;
                    //если вопрос простой сложности
                    if ($questions["type"] == 0) {

                        if ($questions['answerRight'] == $form->getValue('answer')) {
                            $results = $questions['cost'];
                        }
                    }

                    if ($questions["type"] == 2) {
                        $result_array = unserialize($questions["answerRight"]);

                            if ($result_array['1'] == $form->getValue("answerOne")) {
                                $results += $questions['cost'];
                            }
                            if ($result_array['2'] ==  $form->getValue("answerTwo")) {
                                $results += $questions['cost'];
                            }
                            if ($result_array['3'] == $form->getValue("answerThree")) {
                                $results += $questions['cost'];
                            }
                            if ($result_array['4'] == $form->getValue("answerFour")) {
                                $results += $questions['cost'];
                            }


                    }
                    if ($questions["type"] == 3) {
                        $result_array = explode(',', $questions["answerRight"], 3);
                        foreach ($result_array as $res) {
                            if ($res == $form->getValue("answerOne")) {
                                $results += $questions['cost'];
                                break;
                            }
                            if ($res == $form->getValue("answerTwo")) {
                                $results += $questions['cost'];
                                break;
                            }
                            if ($res == $form->getValue("answerThree")) {
                                $results += $questions['cost'];
                                break;
                            }

                        }
                    }

                    if ($questions["type"] == 4) {
                        if ($questions["answerRight"] == $form->getValue('answer')) {
                            $results += $questions['cost'];
                        }
                    }


                    $data = array(
                        'number' => $questionNumber,
                        'bool' => $results,
                        'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                        'testId' => $test,
                    );


                    $resulttest->addResulttest($data);
                    $questionNumber++;
                    $this->_helper->redirector->gotoUrl('/test/question/test/' . $test . '/question/' . $questionNumber);


                } else {
                    // Если форма заполнена неверно,
                    // используем метод populate для заполнения всех полей
                    // той информацией, которую ввёл пользователь
                    $form->populate($formData);
                }
            }

        }
    }

    public function resultAction()
    {
        $testId = $this->_getParam('testId', 0);
        if ($testId > 0) {
            $test = new Application_Model_DbTable_Test();
            $test_array = $test->getTest($testId);
            $this->view->topic = $test_array['topicId'];
            $this->view->testId = $testId;
            $this->view->comments = $test_array['comments'];
            $result = new Application_Model_DbTable_Resulttest();

            $rel = new Application_Model_DbTable_Testquestionrel();
            $this->view->bals = $rel->getBalls($testId);
            $this->view->count = $result->result($testId);
            $this->view->date = date("i:s", (time() - $_SESSION['time']));
            $this->view->result = $result->fetchAll($result->select()
                                         ->from('resulttest')
                                         ->where('testId = ?', $testId)
                                         ->where('userId = ?', Zend_Auth::getInstance()->getIdentity()->id)
                                         ->order('number ASC'));
            $time = (time() - $_SESSION['time']);

                if ($this->getRequest()->isPost()) {
                    $test = $this->getRequest()->getPost('test');
                    if($test == 'Отправить результат' || $test == 'Надіслати результат'){
                        $type = 'homework';

                    }
                    else {
                        $type = 'rating';
                        $user = new Application_Model_DbTable_User();
                        $userArray = $user->getUser(Zend_Auth::getInstance()->getIdentity()->id);
                        $data = array( 'id' => Zend_Auth::getInstance()->getIdentity()->id,
                            'result' => $userArray['result']+$result->result($testId));

                        $user->updateUser($data);

                    }
                    $resultBD  = new Application_Model_DbTable_Result();
                    $group = new Application_Model_DbTable_Groups();
                    $group_array = $group->getGroups(Zend_Auth::getInstance()->getIdentity()->groupId);
                    $groupId = Zend_Auth::getInstance()->getIdentity()->groupId;
                    if(!$group_array){
                        $group_array['name'] = 'Нет группы';
                        $group_array['nameUa'] = 'Нет групи';
                        $groupId = '0';
                    }


                    $data = array(
                        'user' => Zend_Auth::getInstance()->getIdentity()->username,
                        'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                        'test' => $test_array['name'],
                        'testUa' => $test_array['name'],
                        'testId' => $testId,
                        'result' =>  $result->result($testId),
                        'date' =>  time(),
                        'time' =>  $time,
                        'group' => $group_array['name'],
                        'groupUa' => $group_array['nameUa'],
                        'groupId' => $groupId,
                        'type' => $type,
                    );
                        $bool = $resultBD->addResult($data);
                        if (!$bool){echo 'Больше тест проходить нельзя!';}

                        $_SESSION['time'] = '';
                        $this->_helper->redirector->gotoUrl('/user/profile');
                    }







        }

    }

    public function addquestion1Action()
    {
        $form = new Application_Form_Addquestion1();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Питання  російською:");
            $form->nameUa->setLabel("Питання українською:");
            $form->capture->setLabel("Посилання на картинку (url): * Якщо питання з картинкою");
            $form->answerRight->setLabel("Правильна відповідь");
            $form->cost->setLabel("Кількість балів за відповідь:");
            $form->add->setLabel("Додати питання");
        }

        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $question = new Application_Model_DbTable_Question();
                $answers = serialize(array(   '0' => $form->getValue('answerOne'),
                                              '1' => $form->getValue('answerTwo'),
                                              '2' => $form->getValue('answerThree'),
                                              '3' => $form->getValue('answerFour')));

                $answersUa = serialize(array(   '0' => $form->getValue('answerOneUa'),
                                                '1' => $form->getValue('answerTwoUa'),
                                                '2' => $form->getValue('answerThreeUa'),
                                                '3' => $form->getValue('answerFourUa')));
                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'type' => 0,
                    'topicId' => $form->getValue('topic'),
                    'capture' => $form->getValue('capture'),
                    'answers' => $answers,
                    'answersUa' => $answersUa,
                    'answerRight' => $form->getValue('answerRight'),
                    'cost' => $form->getValue('cost'),
                );

                // Создаём объект модели
                // Вызываем метод модели addMovie для вставки новой записи
                $question->addQuestion($data);
                $this->_helper->redirector->gotoUrl('/test/typequestion');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }

    }

    public function addquestion2Action()
    {
        $form = new Application_Form_Addquestion2();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Питання  російською:");
            $form->nameUa->setLabel("Питання українською:");
            $form->capture->setLabel("Посилання на картинку (url): * Якщо питання з картинкою");
            $form->cost->setLabel("Кількість балів за відповідь:");
            $form->add->setLabel("Додати питання");

        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $question = new Application_Model_DbTable_Question();
                $answers = serialize(array( '1' => $form->getValue('answerOneN'),
                                            'A' => $form->getValue('answerOneS'),
                                            '2' => $form->getValue('answerTwoN'),
                                            'B' => $form->getValue('answerTwoS'),
                                            '3' => $form->getValue('answerThreeN'),
                                            'C' => $form->getValue('answerThreeS'),
                                            '4' => $form->getValue('answerFourN'),
                                            'D' => $form->getValue('answerFourS'),
                                            'E' => $form->getValue('answerFiveS')));

                $answersUa = serialize(array( '1' => $form->getValue('answerOneNUa'),
                    'A' => $form->getValue('answerOneSUa'),
                    '2' => $form->getValue('answerTwoNUa'),
                    'B' => $form->getValue('answerTwoSUa'),
                    '3' => $form->getValue('answerThreeNUa'),
                    'C' => $form->getValue('answerThreeSUa'),
                    '4' => $form->getValue('answerFourNUa'),
                    'D' => $form->getValue('answerFourSUa'),
                    'E' => $form->getValue('answerFiveSUa')));

                $answerRight = serialize(array( '1' => $form->getValue('answerOne'),
                                                '2' => $form->getValue('answerTwo'),
                                                '3' => $form->getValue('answerThree'),
                                                '4' => $form->getValue('answerFour')));

                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'type' => 2,
                    'topicId' => $form->getValue('topic'),
                    'capture' => $form->getValue('capture'),
                    'answers' => $answers,
                    'answersUa' => $answersUa,
                    'answerRight' => $answerRight,
                    'cost' => $form->getValue('cost'),
                );

                // Создаём объект модели
                // Вызываем метод модели addMovie для вставки новой записи
                $question->addQuestion($data);
                $this->_helper->redirector->gotoUrl('/test/typequestion');


            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }

    }

    public function addquestion3Action()
    {
        $form = new Application_Form_Addquestion3();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Питання  російською:");
            $form->nameUa->setLabel("Питання українською:");
            $form->capture->setLabel("Посилання на картинку (url): * Якщо питання з картинкою");
            $form->cost->setLabel("Кількість балів за відповідь:");
            $form->add->setLabel("Додати питання");
        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $question = new Application_Model_DbTable_Question();
                $answers = serialize( array( '1' => $form->getValue('answerOne'),
                                             '2' => $form->getValue('answerTwo'),
                                             '3' => $form->getValue('answerThree'),
                                             '4' => $form->getValue('answerFour'),
                                             '5' => $form->getValue('answerFive'),
                                             '6' => $form->getValue('answerSix')));

                $answersUa = serialize( array( '1' => $form->getValue('answerOneUa'),
                                               '2' => $form->getValue('answerTwoUa'),
                                               '3' => $form->getValue('answerThreeUa'),
                                               '4' => $form->getValue('answerFourUa'),
                                               '5' => $form->getValue('answerFiveUa'),
                                               '6' => $form->getValue('answerSixUa')));
                $answerRight = $form->getValue('answerOneRight').','.$form->getValue('answerTwoRight').','
                                                                    .$form->getValue('answerThreeRight');

                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'type' => 3,
                    'topicId' => $form->getValue('topic'),
                    'capture' => $form->getValue('capture'),
                    'answers' => $answers,
                    'answersUa' => $answersUa,
                    'answerRight' => $answerRight,
                    'cost' => $form->getValue('cost'),
                );

                // Создаём объект модели
                // Вызываем метод модели addMovie для вставки новой записи
                $question->addQuestion($data);
                $this->_helper->redirector->gotoUrl('/test/typequestion');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }

    }

    public function addquestion4Action()
    {
        $form = new Application_Form_Addquestion4();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Питання  російською:");
            $form->nameUa->setLabel("Питання українською:");
            $form->capture->setLabel("Посилання на картинку (url): * Якщо питання з картинкою");
            $form->cost->setLabel("Кількість балів за відповідь:");
            $form->answer->setLabel("Правильна відповідь");
            $form->add->setLabel("Додати питання");
        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $question = new Application_Model_DbTable_Question();


                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'type' => 4,
                    'topicId' => $form->getValue('topic'),
                    'capture' => $form->getValue('capture'),
                    'answers' => '',
                    'answersUa' => '',
                    'answerRight' => $form->getValue('answer'),
                    'cost' => $form->getValue('cost'),
                );

                // Создаём объект модели
                // Вызываем метод модели addMovie для вставки новой записи
                $question->addQuestion($data);
                $this->_helper->redirector->gotoUrl('/test/typequestion');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }

    }

    public function deletequestionAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да' || $del == 'Так') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $question = new Application_Model_DbTable_Question();

                // Вызываем метод модели deleteMovie для удаления записи
                $question->deleteQuestion($id);
                $testQuestionRel = new Application_Model_DbTable_Testquestionrel();
                // Вызываем метод модели deleteMovie для удаления записи
                $testQuestionRel->deleteTestquestionrelQuestionId($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('construct', 'test');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $question = new Application_Model_DbTable_Question();

            // Достаём запись и передаём в view
            $this->view->question = $question->getQuestion($id);
        }
    }

    public function constructAction()
    {
        $topic = new Application_Model_DbTable_Topic();
        $this->view->topic = $topic->fetchAll();
        $tests = new Application_Model_DbTable_Test();
        $this->view->tests = $tests->fetchAll();
        $question = new Application_Model_DbTable_Question();
        $this->view->question = $question->fetchAll($question->select()->limit(5));
    }

    public function dataAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $search = $_POST['search'];
        $search = htmlspecialchars($search);
        if ($search == '')
            exit("Начните вводить запрос");
        elseif (!preg_match("/^[а-я0-9]+$/ui", $search))
            exit("Недопустимые символы в запросе");
        $questions = new Application_Model_DbTable_Question();
        $question_array = $questions->arrayQuestion($search);
        echo '<table class="table table-hover">';
        foreach ($question_array as $question) {
            echo $question->search();
        }
        echo '</table>';

    }

    public function addAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $obj = $_POST['obj'];
        $array = json_decode($obj);
        $test = new Application_Model_DbTable_Testquestionrel();
        $tests = new Application_Model_DbTable_Test();
        $testId = $tests->currentTest();
        for ($i = 1; $i <= count($array); $i++) {
            $data = array('testId' => (int)$testId, 'questionId' => (int)$array[$i - 1], 'number' => (int)$i);
            $test->addTestquestionrel($data);
        }
        echo '<div class="alert alert-success">Тест успешно добавлен!</div>';

    }

    public function topicAction()
    {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $topics = new Application_Model_DbTable_Topic();
        $topics_array = $topics->arrayTopic();
        foreach($topics_array as $topic)
        {
            echo $topic->getName(). "\n";
        }
    }

    public function addtopicAction(){
        $form = new Application_Form_Addtopic();
        $form->add->setLabel("Добавить тему");
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->name->setLabel("Назва російською:");
            $form->nameUa->setLabel("Назва українською:");
            $form->add->setLabel("Додати тему");
        }
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),

                );

                // Создаём объект модели

                $topic = new Application_Model_DbTable_Topic();


                // Вызываем метод модели addMovie для вставки новой записи
                $topic->addTopic($data);
                $this->_helper->redirector('construct', 'test');


            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }
    }

    public function edittopicAction()
    {
        $form = new Application_Form_Addtopic();
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $data = array(
                    'id' => (int)$form->getValue('id'),
                    'name' => (string)$form->getValue('name'),
                    'nameUa' => (string)$form->getValue('nameUa'),
                );


                // Создаём объект модели
                $topic = new Application_Model_DbTable_Topic();

                // Вызываем метод модели addMovie для вставки новой записи
                $topic->updateTopic($data);
                $this->_helper->redirector('construct', 'test');

            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        } else {
            // Если мы выводим форму, то получаем id фильма, который хотим обновить
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                // Создаём объект модели
                $topic = new Application_Model_DbTable_Topic();
                // Заполняем форму информацией при помощи метода populate
                $form->populate($topic->getTopicId($id));

            }
        }
    }

    public  function deletetopicAction(){
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да') {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $topic = new Application_Model_DbTable_Topic();

                // Вызываем метод модели deleteMovie для удаления записи
                $topic->deleteTopic($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('construct', 'test');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $topic = new Application_Model_DbTable_Topic();

            // Достаём запись и передаём в view
            $this->view->topic = $topic->getTopicId($id);
        }
    }

    public function allresultsAction()
    {
        $result = new Application_Model_DbTable_Result();
        $results = $result->fetchAll($result->select()->where('type =?','homework')
            ->order('date DESC'));
        $this->view->results = $results;
    }

    public function uploadtestAction()
    {
        date_default_timezone_set('Europe/Kiev');
        $form = new Application_Form_Uploadtest();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $form->type->addMultiOptions(array(
                '0' => 'Легкий рівень',
                '2' => 'Середній рівень',
                '3' => 'Важкий рівень',
                '4' => 'Задачі'
            ));

            $form->add->setLabel("Завантажити");
        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {

            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

                // закачка файла на сервер
                $file = $form->file->getFileInfo();
                $ext = split("[/\\.]", $file['file']['name']);
                $newName = 'question' . date("His", time()) . '.' . $ext[count($ext) - 1];
                $fileUrl = '/uploads/' . date("d-m-Y", time()) . '/' . $newName;
                if (!file_exists('uploads/' . date("d-m-Y", time()))) {
                    mkdir('uploads/' . date("d-m-Y", time()), 0700);
                }
                $form->file->addFilter('Rename', realpath(dirname('.')) .
                    DIRECTORY_SEPARATOR .
                    'uploads/' . date("d-m-Y", time()) . '/' .
                    DIRECTORY_SEPARATOR .
                    $newName);
                $form->file->receive();

                $xlsData = $this->getXLS($_SERVER['DOCUMENT_ROOT'].$fileUrl);

                foreach ($xlsData as $array){

                    if($form->getValue('type') == 0){
                       $this->insertTestLight($array);}

                    if($form->getValue('type') == 2){
                        $this->insertTestMiddle($array); }

                    if($form->getValue('type') == 3){
                        $this->insertTestHard($array);}

                    if($form->getValue('type') == 4){
                        $this->insertTestTask($array);}




                }
                echo '<div class="alert-success">Файл успешно загружен. Загрузите следующий.</div>';
            } else {

                $form->populate($formData);
            }
        }
    }

    public function insertTestLight($array)
    {
        $capture = '';
        $question = new Application_Model_DbTable_Question();
        if(isset($array[4])){
            $answers = serialize(array(   '0' => $array[4],
                '1' => $array[5],
                '2' => $array[6],
                '3' => $array[7]));}
        else{
            $answers = '';
        }
        if(isset($array[4])){
            $answersUa = serialize(array(   '0' => $array[8],
                '1' => $array[9],
                '2' => $array[10],
                '3' => $array[11]));} else
        {$answersUa = '';}
        $answerRight = $array[12];
        if(isset($array[13])){
            $capture = $array[13];
        }

        $data = array(
            'name' => $array[0],
            'nameUa' => $array[1],
            'topicId' => $array[2],
            'cost' => $array[3],
            'type' => 0,
            'answers' => $answers,
            'answersUa' => $answersUa,
            'answerRight' => $answerRight,
            'capture' => $capture

        );
        $question->addQuestion($data);
    }

    public function insertTestMiddle($array)
    {
        $capture = '';
        $question = new Application_Model_DbTable_Question();
        if(isset($array[4])){
        $answers = serialize(array( '1' => $array[4],
            '2' => $array[5],
            '3' => $array[6],
            '4' => $array[7],
            'A' => $array[8],
            'B' => $array[9],
            'C' => $array[10],
            'D' => $array[11],
            'E' => $array[12]));} else{
            $answers = serialize(array( '1' => $array[4],
                '2' => $array[5],
                '3' => $array[6],
                '4' => $array[7],
                'A' => '-',
                'B' => '-',
                'C' => '-',
                'D' => '-',
                'E' => '-'));
        }
        if(isset($array[4])){
        $answersUa = serialize(array( '1' => $array[13],
            '2' => $array[14],
            '3' => $array[15],
            '4' => $array[16],
            'A' => $array[17],
            'B' => $array[18],
            'C' => $array[19],
            'D' => $array[20],
            'E' => $array[21]));
        } else {
            $answersUa = serialize(array( '1' => $array[13],
                '2' => $array[14],
                '3' => $array[15],
                '4' => $array[16],
                'A' => '-',
                'B' => '-',
                'C' => '-',
                'D' => '-',
                'E' => '-'));
        }
        $answerRight = serialize(array( '1' => $array[22],
            '2' => $array[23],
            '3' => $array[24],
            '4' => $array[25]));
        if(isset($array[26])){
            $capture = $array[26];
        }

        $data = array(
            'name' => $array[0],
            'nameUa' => $array[1],
            'topicId' => $array[2],
            'cost' => $array[3],
            'type' => 2,
            'answers' => $answers,
            'answersUa' => $answersUa,
            'answerRight' => $answerRight,
            'capture' => $capture

        );
        $question->addQuestion($data);

    }

    public function insertTestHard($array)
    {
        $capture = '';
        $question = new Application_Model_DbTable_Question();
        $answers = serialize( array( '1' => $array[4],
            '2' => $array[5],
            '3' => $array[6],
            '4' => $array[7],
            '5' => $array[8],
            '6' => $array[9]));

        $answersUa = serialize( array( '1' => $array[10],
            '2' => $array[11],
            '3' => $array[12],
            '4' => $array[13],
            '5' => $array[14],
            '6' => $array[15]));
        $answerRight = $array[16].','.$array[17].','
            .$array[18];
        if(isset($array[19])){
            $capture = $array[19];
        }

        $data = array(
            'name' => $array[0],
            'nameUa' => $array[1],
            'topicId' => $array[2],
            'cost' => $array[3],
            'type' => 3,
            'answers' => $answers,
            'answersUa' => $answersUa,
            'answerRight' => $answerRight,
            'capture' => $capture

        );
        $question->addQuestion($data);
    }

    public function insertTestTask($array)
    {
        $capture = '';
        $question = new Application_Model_DbTable_Question();
        $answers = '';
        $answersUa = '';
        $answerRight = $array[4];
        if(isset($array[5])){
            $capture = $array[5];
        }

        $data = array(
            'name' => $array[0],
            'nameUa' => $array[1],
            'topicId' => $array[2],
            'cost' => $array[3],
            'type' => 4,
            'answers' => $answers,
            'answersUa' => $answersUa,
            'answerRight' => $answerRight,
            'capture' => $capture

        );
        $question->addQuestion($data);
    }

    public function getXLS($xls){

        $objPHPExcel = PHPExcel_IOFactory::load($xls);
        $objPHPExcel->setActiveSheetIndex(0);
        $aSheet = $objPHPExcel->getActiveSheet();

        //этот массив будет содержать массивы содержащие в себе значения ячеек каждой строки
        $array = array();
        //получим итератор строки и пройдемся по нему циклом
        foreach($aSheet->getRowIterator() as $row){
            //получим итератор ячеек текущей строки
            $cellIterator = $row->getCellIterator();
            //пройдемся циклом по ячейкам строки
            //этот массив будет содержать значения каждой отдельной строки
            $item = array();
            foreach($cellIterator as $cell){
                //заносим значения ячеек одной строки в отдельный массив
                array_push($item, $cell->getCalculatedValue());
            }
            //заносим массив со значениями ячеек отдельной строки в "общий массв строк"
            array_push($array, $item);
        }
        return $array;
    }

    public function buildAction()
    {
        $type = $this->_getParam('type', 0);
        if ($type >= 0) {
            $form = new Application_Form_Build();
            $this->view->form = $form;
        }

    }

    public function ratingAction(){
        $id = $this->_getParam('id', 0);
        if($id > 0){
            $testsM = new Application_Model_DbTable_Test();
            $topicM = new Application_Model_DbTable_Topic();
            $testArr = $testsM->getTest($id);
            $this->view->topic = $topicM->getTopicId($testArr['topicId']);
            $this->view->test = $testArr;
        $result = new Application_Model_DbTable_Result();
        $results = $result->fetchAll($result->select()
            ->where('type =?','rating')
            ->where('testId =?',$id)
            ->order('result DESC')
            ->order('time ASC'));
        $this->view->results = $results;}
    }

    public function randomAction(){
        $form = new Application_Form_Addtest();
        $request = new Zend_Controller_Request_Http();
        $lang = $request->getCookie('lang');
        if($lang == "ua"){
            $topics = new Application_Model_DbTable_Topic();
            $form->topic->addMultiOptions($topics->arrayUaSelect());
            $form->name->setLabel("Назва тесту російською:");
            $form->nameUa->setLabel("Назва тесту українською:");
            $form->comments->setLabel("Коментар:");
            $form->add->setLabel("Додати тест");
        }
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $data = array(
                    'name' => $form->getValue('name'),
                    'nameUa' => $form->getValue('nameUa'),
                    'author' => Zend_Auth::getInstance()->getIdentity()->username,
                    'userId' => Zend_Auth::getInstance()->getIdentity()->id,
                    'topicId' => $form->getValue('topic'),
                    'comments' => $form->getValue('comments'),

                );

                $test = new Application_Model_DbTable_Test();

                $test->addTest($data);

                        $testId = $test->getAdapter()->lastInsertId();
                        $this->randomTestZNO($testId,$form->getValue('pattern'));



            } else {

                $form->populate($formData);
            }
        }
    }

    public function randomTestZNO($testId, $patternId){

        $array = array();
        $patterns = new Application_Model_DbTable_Pattern();
        $arrayPattern = $patterns->getPattern($patternId);
        $structure = unserialize($arrayPattern['structure']);
        foreach ($structure as $struct){
            $array = array_merge($array,$this->getRandomQuestion($struct['type'],$struct['col'],$struct['class']));
        }


        $rel = new Application_Model_DbTable_Testquestionrel();
        $i = 1;
        foreach($array as $quest){
            $data = array(
                'testId' => $testId,
                'questionId' => $quest['id'],
                'number' => $i
            );
           $rel->addTestquestionrel($data);
           $i++;
        }
    }

    public function getRandomQuestion($type, $col, $class){
        $qustion = new Application_Model_DbTable_Question();
        $qustionQuery = $qustion->fetchAll($qustion->select()->where("type = ".$type)->where('topicId = '.$class)->order('RAND()')->limit($col));
        return $qustionQuery->toArray();
    }

    public function patternAction(){
        $form = new Application_Form_Pattern();

        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();

            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $structure = serialize($this->constructPattern($form));
                $data = array(
                    'name' => $form->getValue('name'),
                    'text' => $form->getValue('text'),
                    'structure' => $structure
                );
                $pattern = new Application_Model_DbTable_Pattern();
                $pattern->addPattern($data);
                $this->_helper->redirector('allpattern', 'test');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function constructPattern($form){
        $arrayAll = array();
        for($i = 6; $i < 11; $i++){
        $array = $this->getArrayPattern($form,'typeOneClass'.$i,0,$i);
        if($array){ $arrayAll[] = $array; }
        }

        for($i = 6; $i < 11; $i++){
            $array = $this->getArrayPattern($form,'typeTwoClass'.$i,2,$i);
            if($array){ $arrayAll[] = $array; }
        }

        for($i = 6; $i < 11; $i++){
            $array = $this->getArrayPattern($form,'typeThreeClass'.$i,3,$i);
            if($array){ $arrayAll[] = $array; }
        }

        for($i = 6; $i < 11; $i++){
            $array = $this->getArrayPattern($form,'typeFourClass'.$i,4,$i);
            if($array){ $arrayAll[] = $array; }
        }
        return $arrayAll;
    }

    public function getArrayPattern($form, $name, $type, $class){
        if($form->getValue($name)!=0){
            $array = array('type'=> $type, 'col' => $form->getValue($name), 'class'=>$class);}
        if(isset($array)){
            return $array;
        } else { return false;}

    }

    public function allpatternAction(){
        $pattern = new Application_Model_DbTable_Pattern();
        $this->view->pattern = $pattern->fetchAll();
    }

    public function deletepatternAction()
    {
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем значение
            $del = $this->getRequest()->getPost('del');

            // Если пользователь подтвердил своё желание удалить запись
            if ($del == 'Да' || $del == 'Так' ) {
                // Принимаем id записи, которую хотим удалить
                $id = $this->getRequest()->getPost('id');

                // Создаём объект модели
                $pattern = new Application_Model_DbTable_Pattern();

                $pattern->deletePattern($id);
            }

            // Используем библиотечный helper для редиректа на action = index
            $this->_helper->redirector('construct', 'test');
        } else {
            // Если запрос не Post, выводим сообщение для подтверждения
            // Получаем id записи, которую хотим удалить
            $id = $this->_getParam('id');

            // Создаём объект модели
            $pattern = new Application_Model_DbTable_Pattern();

            // Достаём запись и передаём в view
            $this->view->pattern = $pattern->getPattern($id);
        }
    }

    public function allquestionAction(){
        $question = new Application_Model_DbTable_Question();
        $this->view->question = $question->fetchAll();
    }

    public function rightanswerAction(){
        $testId = $this->_getParam('testId', 0);
        if ($testId > 0) {
            $number = $this->_getParam('number', 0);
            $testquestionrel = new Application_Model_DbTable_Testquestionrel();
            $questionss = $testquestionrel->fetchAll($testquestionrel->select()
                                                                    ->where("testId =".$testId)
                                                                    ->where("number =".$number));
            $array = $questionss->toArray();
            $question_array = $array[0];
            $question = new Application_Model_DbTable_Question();

            $questions = $question->getQuestion($question_array['questionId']);
            $request = new Zend_Controller_Request_Http();
            $lang = $request->getCookie('lang');
            if($lang == "ua")
            {
                $this->view->question = $questions['nameUa'];
                $answer = $questions["answersUa"];

            }else {

                $this->view->question = $questions['name'];
                $answer = $questions["answers"];
            }

            $this->view->type = $questions['type'];
            if($questions['type']!= 4)
            {$answer = unserialize($answer);}
            $this->view->answer = $answer;

            if ($questions["capture"] != NULL) {
                $this->view->capture = '<img src ="' . $questions["capture"] . '">';
            }

            $this->view->questionNumber = $number;
            $this->view->testId = $testId;
            $answerRight = $questions["answerRight"];
            if($questions['type']== 2)
            {$answerRight = unserialize($questions["answerRight"]);}
            $this->view->answerRight = $answerRight;
        }
    }
}