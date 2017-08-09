<?php
class MyTest2Controller extends AppController {

  public $uses = [
    'Author',
  ];

  public function index() {
    header("Content-type: text/html; charset=utf-8");
    $authors = $this->Author->find('all',[
      'contain' => 'AuthorFavoriteFood'
    ]);
    $this->set('authors',$authors);
  }

  public function show($authorId){
    header("Content-type: text/html; charset=utf-8");
    $author = $this->Author->find('first',[
      'contain' => ['Post'],
      'fields' => ['Author.id'],
      'conditions' => ['Author.id' => $authorId]
    ]);
    $this->set('author', $author);


  }

}
