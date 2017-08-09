<html>
<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table>
  <tr>
    <th>ID</th>
    <th>Author</th>
    <th> Favorite FOODS </th>
  </tr>
<?php foreach ($authors as $author): ?>
<?php // new dBug($author); ?>
<?php // die; ?>
  <tr>
    <th><?= $author['Author']['id']; ?></th>
    <th><?= $this->Html->link($author['Author']['name'],
      ['controller' => 'my_test2','action' => 'show',$author['Author']['id']]
    ); ?>
    </th>
    <th>
      <?php foreach ($author['AuthorFavoriteFood'] as $key => $food): ?>
      <?= $food['name'];
        if (($key+1) != count($author['AuthorFavoriteFood'])) {
           echo ',';
        }
      ?>
      <?php


       ?>
      <?php endforeach; ?>
    </th>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
