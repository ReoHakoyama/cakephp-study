<html>
<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h3>投稿者一覧</h3>
<p>
<?php echo $this->Html->link('ブログ一覧',[
  'controller' => 'main', 'action' => 'index']
  ); ?>
</p>
<table>
  <tr>
    <th>ID</th>
    <th>Author</th>
    <th> Favorite FOODS </th>
    <th> Favorite MUSICS  </th>
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
 <!-- Favorite Foods  -->
    <td>
      <?php foreach ($author['AuthorFavoriteFood'] as $key => $food): ?>
      <?php
        echo $food['name'];
        if (($key+1) != count($author['AuthorFavoriteFood'])) {
           echo ',';
        }
      ?>
      <?php endforeach; ?>
    </td>
 <!-- Favorite Musics -->
    <td>
      <?php foreach ($author['AuthorFavoriteMusic'] as $key => $music): ?>
      <?php
      echo "[".$music['music']."]";
      if (($key+1) != count($author['AuthorFavoriteMusic'])) {
        echo ',';
      }
      ?>
      <?php endforeach; ?>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
