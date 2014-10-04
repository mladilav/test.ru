<?php

class Application_Model_Menu
{
    public function getMenu()
    {
        $result = '<li><a href="/">Главная</a></li>
                   <li><a href="/index/about">О проекте</a></li>';

        if (Zend_Auth::getInstance()->hasIdentity()) {



            if(Zend_Auth::getInstance()->getIdentity()->role == 'admin')
            {
                $result = $result.'<li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                             Управление <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/user/settings/"><i class="icon-user"></i> Пользователи</a></li>
                                                <li><a href="/index/analytic"><i class="icon-search"></i> Аналитика</a></li>
                                                <li><a href="/index/settings"><i class="icon-book"></i> Управление материалами</a></li>
                                                <li class="divider"></li>
                                                <li><a href="/test/construct"> <i class="icon-tasks"></i> Конструктор тестов</a></li>
                                                <li><a href="/user/homework/"> <i class="icon-home"></i> Домашнее задание</a></li>
                                            </ul>
                               </li>';
            }
        }

        return $result;
    }


    public function getUaMenu()
    {
        $result = '<li><a href="/">Головна</a></li>
                   <li><a href="/index/about">Про проект</a></li>';

        if (Zend_Auth::getInstance()->hasIdentity()) {

            if(Zend_Auth::getInstance()->getIdentity()->role == 'admin')
            {
                $result = $result.'<li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                             Управління <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/user/settings/"><i class="icon-user"></i> Користувачі</a></li>
                                                <li><a href="/index/analytic"><i class="icon-search"></i> Аналітика</a></li>
                                                <li><a href="/index/settings"><i class="icon-book"></i> Управління матеріалами</a></li>
                                                <li class="divider"></li>
                                                <li><a href="/test/construct"> <i class="icon-tasks"></i> Конструктор тестів</a></li>
                                                <li><a href="/user/homework/"> <i class="icon-home"></i> Домашнє завдання</a></li>
                                            </ul>
                               </li>';
            }
        }

        return $result;
    }

    public function getAuth()
    {
        if (Zend_Auth::getInstance()->getIdentity())
        {
            $table = new Application_Model_DbTable_Messege();
            $messege = $table->fetchAll($table->select()->where('userIdTo = '.Zend_Auth::getInstance()->getIdentity()->id)
                ->where('status = 1')
                ->order('date DESC '));

            $result = '<a href="/user/profile/id/'.Zend_Auth::getInstance()->getIdentity()->id.'">Личный кабинет </a>';
            if($messege->count()>0){
                $result =  $result.'<a class="label label-success" style="padding:4px;" href="/user/messege">'.$messege->count().'</a>';

            }
            $result = $result.' <a href="/auth/logout">Выход</a>';
        }
        else {
            $result = '<a class="regist" href="/auth/registration">Регистрация</a>';
            $result .= '<a href="/auth/login">Вход</a>';


        }
        return $result;
    }

    public function getAuthUa()
    {
        if (Zend_Auth::getInstance()->getIdentity())
        {
            $table = new Application_Model_DbTable_Messege();
            $messege = $table->fetchAll($table->select()->where('userIdTo = '.Zend_Auth::getInstance()->getIdentity()->id)
                ->where('status = 1')
                ->order('date DESC '));
            $result = '<a href="/user/profile/id/'.Zend_Auth::getInstance()->getIdentity()->id.'">Особистий кабінет</a>';
            if($messege->count()>0){
                $result =  $result.' <a class="label label-success" style="padding:4px;"  href="/user/messege">'.$messege->count().'</a>';

            }
            $result = $result.'<a href="/auth/logout">Вихід</a>';
        }
        else {
            $result = '<a class="regist" href="/auth/registration">Реєстрація</a>';
            $result .= '<a href="/auth/login">Вхід</a>';
        }
        return $result;
    }

    public function message(){
        $table = new Application_Model_DbTable_Messege();
        $messege = $table->fetchAll($table->select()->where('userIdTo = '.Zend_Auth::getInstance()->getIdentity()->id)
            ->where('status = 1')
            ->order('date DESC '));
        if($messege->count()>0){
            $result =  '<span class="label label-success" style="padding:2px 3px;margin-left:7px;" ">'.$messege->count().'</span>';
            return $result;

        }
    }
}
?>