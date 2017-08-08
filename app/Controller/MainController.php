<?php

class MainController extends AppController {

  public $uses = [
    'Post',
    'Category',
    'Comment'
  ];
  public $helpers = array('Html', 'Form');
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
    header("Content-type: text/html; charset=utf-8");
    $this->Post->recursive = 2;
    $posts = $this->Post->find('all',[
      'contain' => ['Category', 'PostTag.Tag'],
    ]);
    foreach($posts as $post){
      #$post['PostTag'][0]['Tag']['name'];
      foreach($post['PostTag'] as $postTag){
      }
    }
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
    header("Content-type: text/html; charset=utf-8");
    #$post = $this->Post->findByid($id);
    $post = $this->Post->find('first',[
      'contain' => ['Comment'],
      'conditions' => ['Post.id' => $id]
    ]);
    #foreach ($posts as $post) {
    #  foreach ($post['Comment'] as $comment){
    #  }
    #}
    $this->set('post', $post);
  }

  public function addComment() {
    if ($this->request->is('get')) { return; }
    if($this->Comment->save($this->request->data)){
      return $this->redirect(['action' => 'view', $this->request->data['Comment']['post_id']]);
    }
    $this->Session->setFlash('保存できませんでした');
    return $this->render('view', $this->reqeust->data['Comment']['post_id']);
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
  /* 物理削除*/
  public function old_delete($id = null) {
    if ($this->request->is('get')) { return; }
    $this->Session->setFlash(__( $this->Post->delete($id) ? '投稿を削除しました。' : '削除出来ませんでした' ));
    return $this->redirect(['action' => 'index']);
  }

  /* 論理削除 */
  public function delete($id = null) {
    if ($this->request->is('get')) { return; }
    $saveArray = [
      'id' => $id,
      'delete_flag' => true
    ];
    $this->Post->save($saveArray);
    $this->Session->setFlash(__( $this->Post->save($saveArray) ? '投稿を削除しました。' : '削除出来ませんでした' ));
    return $this->redirect(['action' => 'index']);
  }


}
?>
