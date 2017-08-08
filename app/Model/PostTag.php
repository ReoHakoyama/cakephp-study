<?php

class PostTag extends AppModel {

  public $belongsTo = ['Post', 'Tag'];

}
