<?php

class Post extends AppModel {

  public $belongsTo = ['Category'];

  public $hasMany = ['Comment'];


}
