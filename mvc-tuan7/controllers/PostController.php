<?php
include(ROOT . "/model/Post.php");

class PostController
{
    public $postModel;
    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function show()
    {
        if (isset($_GET["id"])) {
            $post = $this->postModel-> getPostbyid($_GET["id"]);
               include(ROOT ."/view/PostDetail.php");
        } else {
            $post = $this->postModel-> getAllPost();
             include(ROOT ."/view/Post.php");
        }

        

    }

}

