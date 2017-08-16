<?php

App::uses('Feed', 'Lib');

class CrawlRssShell extends AppShell {

  public $uses = [
    'Post',
    'Category'
  ];

  public function main(){
    $rss = Feed::load('https://headlines.yahoo.co.jp/rss/natalien-c_ent.xml');
    foreach($rss['channel']['item'] as $item){
      $postLink = $this->PostRssLink->find('first',[
        'conditions' => ['PostRssLink.link_url' => $item['link']]
      ]);
      if (!empty($postLink)) {
        continue;
      }
      $tmpCat = $this->Category->find('first',[
        'conditions' => ['Category.name' => $item['category']]
      ]);
      if (empty($tmpCat)) {
        $this->Category->create();
        $this->Category->save($category);
        $categoryId = $this->Category->getLastInsertId();
      }else{
        $categoryId = $tmpCat['Category']['id'];
      }
      $this->Post->create();
      $this->Post->saveAssociated([
        'category_id' => $categoryId,
        'title' => $item['title'],
        'PostRssLink' => [
          'link_url' => $item['link']
        ]
      ]);
    }
  }

}

