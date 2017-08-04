<?php

class Post extends AppModel {

  public $belongsTo = ['Category'];

  public $hasMany = ['Comment'];

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

}
