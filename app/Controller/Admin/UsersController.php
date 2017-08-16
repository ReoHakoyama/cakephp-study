<?php

App::uses('AdminAppController', 'Controller/Admin');

class UsersController extends AdminAppController {

  public function beforeFilter(){
    parent::beforeFilter();
    $this->Auth->allow('admin_add','admin_logout');
  }

  public function admin_add(){
    $this->layout = 'default';
    if($this->request->is('get')){ return; }
    if ($this->User->save($this->request->data)) {
      return $this->redirect(['action'=>'admin_login']);
    }
  }
  public function admin_login(){
    $this->layout = 'default';
    if($this->request->is('get')){ return; }
    if($this->request->is('post')){
      if($this->Auth->login()){
        $this->redirect($this->Auth->redirect());
      } else {
        echo ('失敗しました');
      }
    }
  }

  public function admin_index(){
    $users = $this->User->find('all');
    $this->set(compact('users'));
  }


}
