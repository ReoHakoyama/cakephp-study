<?php

class MyTestController extends AppController {

  public $uses = [
    'Post',
    'PostTag',
    ];

  public function index(){
    header("Content-type: text/html; charset=utf-8");
    $this->Post->recursive = 2;
    $post = $this->Post->find('first',[
      'contain' => ['PostTag.Tag'],
      'conditions' => ['Post.id' => 1],
      'fields' => ['Post.id']
    ]);
    /* Post Tag をしたに Foreach で出す */
    foreach($post['PostTag'] as $postTag){
      var_dump($postTag);
    }
    exit;
  }

    public function loop(){
      header("Content-type: text/html; charset=utf-8");
      $posts = $this->Post->find('all',[
        'contain' => ['PostTag.Tag'],
      ]);
        /* Post を loop で回して、1つずつ Post Tag をしたに Foreach で出す */
      foreach ($posts as $post) {
        foreach ($post['PostTag'] as $postTag) {
        var_dump($postTag);
        }
      }

       exit;
    }

}
