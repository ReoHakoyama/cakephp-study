<?php
class AuthorFavoriteFood extends AppModel {

  public $belongsTo = ['Author'];
  public  $actsAs = ['Containable'];





}
