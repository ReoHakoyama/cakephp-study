<?php
class RankingsController extends AppController {
  public $uses = [
    'Post',
    'Category'
  ];

  public function index() {
    header("Content-type: text/html; charset=utf-8");
    $posts = $this->Post->getSortedByViewCount();
    $this->set('posts',$posts);
  }


}
