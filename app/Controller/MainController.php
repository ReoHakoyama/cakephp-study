<?php

class MainController extends AppController {

  public $uses = [
    'Post',
    'Category'
  ];

 /*
  public function index(){
    header("Content-type: text/html; charset=utf-8");
    $posts = $this->Post->find('all',[
      'conditions' => [
        'Post.content like' => '%'.'内容'.'%'
      ],
      'order' => [
        'Post.id desc'
      ]
    ]);
    $this->set('posts', $posts);
    foreach($posts as $key => $post){
      echo 'タイトル : ' . $post['Post']['title'] . PHP_EOL;
      echo '内容 : ' . post['Post']['content'] . PHP_EOL;
      echo 'カテゴリ名 : ' . $post['Category']['name'] . PHP_EOL; // belongsTo
      echo 'コメント : ';
      foreach($post['Comment'] as $comment){ // hasMany
        echo $comment['comment'] . ',';
      }
      echo PHP_EOL . PHP_EOL;
    }
    exit;
  }
   */

  public function index(){
    $posts = $this->Post->find('all');
    $this->set('posts', $posts);
  }

  public function add(){
    if($this->request->is('get')) { return; }
    $this->Post->create();
    if ($this->Post->save($this->request->data)) {
      $this->Session->setFlash(__('saved'));
      return $this->redirect(['action' => 'index']);
    }else{
      $this->Session->setFlash(__('保存出来ませんでした'));
      return $this->render();
    }
  }

  public function view($id = null) {
    $post = $this->Post->findById($id);
    $this->set('post', $post);
  }


  public function edit($id = null) {
    $post = $this->Post->findById($id);
    $categories = $this->Category->find('all',[
      'contain' => false
    ]);
    $categoryList = Set::Combine($categories, '{n}.Category.id', '{n}.Category.name');
    $this->set(compact('post','categoryList'));
    if ($this->request->is('get')) {
      $this->request->data = $post;
      return;
    }// ↓ Post のときだけ
    $this->Post->id = $id;
    if ($this->Post->save($this->request->data)) {
      $this->Session->setFlash(__('投稿完了'));
      return $this->redirect(['action' => 'view', $id]);
    }else{
      $this->Session->setFlash('保存できませんでした');
      return $this->render();
    }
  }


}
?>
