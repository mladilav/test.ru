<?php
class Application_Model_Question
{
    protected $id;
    protected $name;
    protected $type;
    protected $topicId;

    public function __construct( $array)
    {
        if(!empty($array)){
        $this->id = $array['id'];
        $this->name = $array['name'];
        $this->topicId = $array['topicId'];
        $this->type = $array['type'];
        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getTypeOne()
    {
        $result = array();
        $answers = new Application_Model_DbTable_Answer();
        $answers_array = $answers->arrayAnswer($this->id);
        $i = 1;
        foreach( $answers_array as $answer)
        {
            $key = 'answer'.$i;
            $result[$key] = $answer->getName();
            $i++;
        }
        return $result;
    }
    public function search()
    {
        $result = '<tr><td id="name'.$this->id.'">'.$this->name.'</td>
                   <td>
                   <div onclick="AddQuest('.$this->id.')"><i class="icon-plus"></i></div></td></tr>';
        return $result;
    }

}
?>