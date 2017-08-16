<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<p>
<h4><?= $this->Html->link('記事を投稿する', ['controller'=>'main', 'action'=>'add']); ?></h4><br>
<?= $this->Html->link('著者一覧',['controller' => 'my_test2', 'action' => 'index']); ?>
</p>
<table>
  <tr>
    <th>ID</th>
    <th>タイトル</th>
    <th>投稿日時</th>
    <th>Tag</th>
  </tr>
<?php foreach ($posts as $post): ?>
  <tr>
    <td><?= $post['Post']['id']; ?></td>
    <td>
      <?= $this->Html->link($post['Post']['title'],
      ['controller' => 'main','action' => 'view', $post['Post']['id']]); ?></td>
    <td><?= $post['Post']['created']; ?></td>
    <td>
    <?php foreach($post['PostTag'] as $postTag): ?>
    <?php echo $postTag['Tag']['name']; ?>
    <?php endforeach; ?>
    </td>
  </tr>
  <?php endforeach; ?>

</table>
</html>
