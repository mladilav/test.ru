<?php
class Application_Model_TEmail{

    public $from_email;

    public $from_name;

    public $to_email;

    public $to_name;

    public $subject;

    public $data_charset='UTF-8';

    public $send_charset='windows-1251';

    public $body='';

    public $type='text/plain';

    function send(){

        $dc=$this->data_charset;

        $sc=$this->send_charset;

        //Кодируем поля адресата, темы и отправителя

        $enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';

        $enc_subject=mime_header_encode($this->subject,$dc,$sc);

        $enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_email.'>';

        //Кодируем тело письма

        $enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);

        //Оформляем заголовки письма

        $headers='';

        $headers.="Mime-Version: 1.0\r\n";

        $headers.="Content-type: ".$this->type."; charset=".$sc."\r\n";

        $headers.="From: ".$enc_from."\r\n";

        //Отправляем

        return mail($enc_to,$enc_subject,$enc_body,$headers);

    }

}?>