<?php

class Post extends AppModel {

  public $belongsTo = ['Category'];

  public $hasMany = ['Comment', 'PostTag'];

  public $actsAs = ['Containable'];

  public $validate = [
    'title' => [
      'rule' => 'notEmpty',
      'message' => 'タイトルを入力してください'
    ],
    'content' => [
      'rule' => 'notEmpty',
      'message' => '本文を入力してください'
    ]
  ];

  public function beforeFind($queryData) {
    $queryData['conditions']['Post.delete_flag'] = false;
    return $queryData;
  }

}
