<?php
class Author extends AppModel {

  public $hasMany = [
    'Post' => [
      'conditions' => ['Post.delete_flag' => false]
    ],
    'AuthorFavoriteFood'
  ];

  public $actsAs = ['Containable'];
}
