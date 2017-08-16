<?php

class Post extends AppModel {

  public $belongsTo = [
    'Category',
    'Author'
  ];

  public $hasMany = [
    'Comment',
    'PostTag'
  ];

  public $hasOne = [
    'PostRssLink'
  ];

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

  public function getSortedByViewCount(){
    $posts = $this->find('all',[
      'contain' => ['Category', 'PostTag.Tag'],
      'fields' => ['Category.*', 'PostPageview.*', 'Post.*'],
      'joins' => [
        [
          'type' => 'INNER',
          'table' => 'post_pageviews',
          'alias' => 'PostPageview',
          'conditions' => '`PostPageview`.`post_id`=`Post`.`id`',
        ]
      ],
      'order' => 'PostPageview.view_count desc'
    ]);
    return $posts;
  }

}
