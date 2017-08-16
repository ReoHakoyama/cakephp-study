<?php
class Author extends AppModel {

  public $hasMany = [
    'Post' => [
      'conditions' => ['Post.delete_flag' => false]
    ],
    'AuthorFavoriteFood',
    'AuthorFavoriteMusic'
  ];

  public $actsAs = ['Containable'];
}
