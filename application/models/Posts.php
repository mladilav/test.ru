<?php

class Application_Model_Posts
{

    protected $id;
    protected $categoryId;
    protected $title;
    protected $description;
    protected $userId;
    protected $date;
    protected $body;
    protected $icon;

    public function __construct($array)
    {
        if (!empty($array)) {
            $this->id = $array['id'];
            $this->categoryId = $array['categoryId'];
            $this->title = $array['title'];
            $this->description = $array['description'];
            $this->userId = $array['userId'];
            $this->date = $array['date'];
            $this->body = $array['body'];
            $this->icon = $array['icon'];
        }
    }

    public function getData()
    {
        $data = array(
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            'categoryId' => $this->categoryId,
            'userId' => $this->userId,
            'date' => $this->date,
            'icon' => $this->icon,
        );
        return $data;
    }

    public function getPostCategory($categoryId)
    {
        $posts = new Application_Model_DbTable_Posts();
        $posts_array = $posts->getPostByCategory($categoryId);
        $result = '';
        foreach ($posts_array as $post) {
            $Post = $post->getData();
            $result = $result . $Post['title'] . '<br>';
        }
        return $result;
    }
}

?>