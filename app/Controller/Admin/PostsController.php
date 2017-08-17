<?php

App::uses('AdminAppController', 'Controller/Admin');

class PostsController extends AdminAppController {

  public $uses = [
    'Post',
    'Author'
  ];

  public function admin_index(){
    header("Content-type: text/html; charset=utf-8");
    $this->Post->recursive = 2;
    $posts = $this->Post->find('all',[
      'contain' => ['PostTag.Tag','Author']
    ]);
    $this->set(compact('posts'));
  }



}
