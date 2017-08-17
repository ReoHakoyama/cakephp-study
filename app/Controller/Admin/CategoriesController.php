<?php

App::uses('AdminAppController', 'Controller/Admin');

class CategoriesController extends AdminAppController{

  public $uses = [
    'Category'
  ];

  public $components = [
    'Session',
  ];

  public function admin_index() {
    header("Content-type: text/html; charset=utf-8");
    $categories = $this->Category->find('all');
    $this->set(compact('categories'));
  }

  public function admin_add() {
    if ($this->request->is('get')) { return; }
    $this->Category->create();
    if ($this->Category->save($this->request->data)) {
      $this->Session->setFlash(__('saved'));
      return $this->redirect(['action' => 'admin_index']);
    }else{
      $this->Session->setFlash(__('NOT SAVED'));
      return $this->render();
    }
  }

}
?>
