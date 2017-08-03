<?php

class MainController extends AppController {

  public $uses = [
    'Post'
  ];

  public function index(){
    header("Content-type: text/html; charset=utf-8");
    $posts = $this->Post->find('all',[
      'conditions' => [
        'Post.content like' => '%'.'内容'.'%'
      ],
      'order' => [
        'Post.id asc'
      ]
    ]);
    $this->set('posts', $posts);
    foreach($posts as $key => $post){
      echo 'タイトル : ' . $post['Post']['title'] . PHP_EOL;
      echo '内容 : ' . $post['Post']['content'] . PHP_EOL;
      echo 'カテゴリ名 : ' . $post['Category']['name'] . PHP_EOL; // belongsTo
      echo 'コメント : ';
      foreach($post['Comment'] as $comment){ // hasMany
        echo $comment['comment'] . ',';
      }
      echo PHP_EOL . PHP_EOL;
    }
    exit;
  }

}
?>
