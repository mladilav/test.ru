<?php

require_once ('../library/PHPExcel.php');
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAcl()
    {
        // Создаём объект Zend_Acl
        $acl = new Zend_Acl();

        // Добавляем ресурсы нашего сайта,
        // другими словами указываем контроллеры и действия

        // указываем, что у нас есть ресурс index
        $acl->addResource('index');

        // ресурс add является потомком ресурса index
        $acl->addResource('add', 'index');
        $acl->addResource('edit', 'index');
        $acl->addResource('delete', 'index');
        $acl->addResource('addpart', 'index');
        $acl->addResource('editpart', 'index');
        $acl->addResource('deletepart', 'index');
        $acl->addResource('addcat', 'index');
        $acl->addResource('editcat', 'index');
        $acl->addResource('deletecat', 'index');
        $acl->addResource('addsubcat', 'index');
        $acl->addResource('editsubcat', 'index');
        $acl->addResource('deletesubcat', 'index');
        $acl->addResource('post', 'index');
        $acl->addResource('part', 'index');
        $acl->addResource('category', 'index');
        $acl->addResource('subcategory', 'index');
        $acl->addResource('settings', 'index');
        $acl->addResource('analytic', 'index');
        $acl->addResource('lang', 'index');
        $acl->addResource('content', 'index');

        $acl->addResource('error');

        $acl->addResource('auth');

        $acl->addResource('login', 'auth');
        $acl->addResource('logout', 'auth');
        $acl->addResource('registration', 'auth');
        $acl->addResource('regvk', 'auth');
        $acl->addResource('regfc', 'auth');
        $acl->addResource('regtw', 'auth');

        $acl->addResource('test');

        $acl->addResource('addtest', 'test');
        $acl->addResource('edittest', 'test');
        $acl->addResource('deletetest', 'test');
        $acl->addResource('typequestion', 'test');
        $acl->addResource('question', 'test');
        $acl->addResource('deletequestion', 'test');
        $acl->addResource('result', 'test');
        $acl->addResource('addquestion1', 'test');
        $acl->addResource('addquestion2', 'test');
        $acl->addResource('addquestion3', 'test');
        $acl->addResource('addquestion4', 'test');
        $acl->addResource('construct', 'test');
        $acl->addResource('data', 'test');
        $acl->addResource('topic', 'test');
        $acl->addResource('addtopic', 'test');
        $acl->addResource('edittopic', 'test');
        $acl->addResource('deletetopic', 'test');
        $acl->addResource('allresults', 'test');
        $acl->addResource('uploadtest', 'test');
        $acl->addResource('build', 'test');
        $acl->addResource('rating', 'test');
        $acl->addResource('random', 'test');
        $acl->addResource('pattern', 'test');
        $acl->addResource('allpattern', 'test');
        $acl->addResource('deletepattern', 'test');
        $acl->addResource('allquestion', 'test');
        $acl->addResource('rightanswer', 'test');


        $acl->addResource('user');

        $acl->addResource('profile', 'user');
        $acl->addResource('addgroups', 'user');
        $acl->addResource('editgroups', 'user');
        $acl->addResource('deletegroups', 'user');
        $acl->addResource('homework', 'user');
        $acl->addResource('addhomework', 'user');
        $acl->addResource('deletehomework', 'user');
        $acl->addResource('sendhomework', 'user');
        $acl->addResource('group', 'user');
        $acl->addResource('deleteuser', 'user');
        $acl->addResource('addgroupsuser', 'user');
        $acl->addResource('adduser', 'user');
        $acl->addResource('messege', 'user');
        $acl->addResource('userhomework', 'user');
        $acl->addResource('messegesend', 'user');

        // далее переходим к созданию ролей, которых у нас 2:
        // гость (неавторизированный пользователь)
        $acl->addRole('guest');

        // администратор, который наследует доступ от гостя
        $acl->addRole('admin', 'guest');

        // разрешаем гостю просматривать ресурс index
        $acl->allow('guest', 'index', array('index', 'part', 'category','subcategory','lang','post','content'));

        // разрешаем гостю просматривать ресурс auth и его подресурсы
        $acl->allow('guest', 'auth', array('index', 'login', 'logout', 'registration', 'regvk','regfc','regtw'));
        $acl->allow('guest', 'test', array('index','question', 'result', 'data', 'topic', 'rating'));
        $acl->allow('guest', 'user', array('index','edit', 'profile', 'messege', 'userhomework','messegesend'));

        // даём администратору доступ к ресурсам 'add', 'edit' и 'delete'
        $acl->allow('admin', 'index', array('add', 'edit', 'delete', 'addpart', 'editpart', 'deletepart', 'addcat',
            'editcat', 'deletecat', 'addsubcat', 'editsubcat', 'deletesubcat', 'settings', 'analytic' ));

        $acl->allow('admin', 'test', array( 'addtest', 'edittest', 'deletetest', 'typequestion', 'question',
            'deletequestion', 'addquestion1', 'addquestion2', 'addquestion3', 'addquestion4', 'construct', 'add',
            'addtopic', 'edittopic', 'deletetopic', 'allresults', 'uploadtest', 'build','random','pattern','allpattern',
            'deletepattern','allquestion','rightanswer'));

        $acl->allow('admin', 'user', array('edit', 'delete', 'addgroups', 'editgroups', 'deletegroups', 'settings',
            'homework', 'addhomework', 'deletehomework', 'sendhomework', 'group','deleteuser', 'addgroupsuser', 'adduser', ));

        // разрешаем администратору просматривать страницу ошибок
        $acl->allow('admin', 'error');

        // получаем экземпляр главного контроллера
        $fc = Zend_Controller_Front::getInstance();

        // регистрируем плагин с названием AccessCheck, в который передаём
        // на ACL и экземпляр Zend_Auth
        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
    }

}

