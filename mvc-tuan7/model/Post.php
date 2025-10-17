<?php
class Post
{
public function getAllPost () {    
    $post = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/posts?_limit=5"), true); 
    return $post;
}

public function getPostbyid($id) {
    $post = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/posts/{$id}")); 
    return $post;
}


}