<?php

class AdminAppController extends AppController {

  public function beforeFilter() {

    $this->layout = 'admin';
    $this->Auth->deny();

    $loginUser = $this->Auth->user();
    $this->set(compact('loginUser'));

    }

}
