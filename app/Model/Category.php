<?php

class Category extends AppModel {

  public $actsAs = ['Containable'];

  public $useTable = 'categories';

  public $hasMany = ['Post'];

}
?>
