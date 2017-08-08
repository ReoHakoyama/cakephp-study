<?php

class MyTestController extends AppController {

    public function index(){
        $post = $this->Post->findById(1);
        /* Post Tag をしたに Foreach で出す */

        exit;
    }

    public function loop(){
        $posts = $this->Post->find('all');
        /* Post を loop で回して、1つずつ Post Tag をしたに Foreach で出す */

        exit;
    }

}
