<?php
class AuthorFavoriteMusic extends AppModel {

  public $belongsTo = ['Author'];
  public $actsAs = ['Containable'];



}
