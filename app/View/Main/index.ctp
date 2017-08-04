<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<table>
  <tr>
    <th>ID</th>
    <th>タイトル</th>
    <th>投稿日時</th>
  </tr>
<?php foreach ($posts as $post): ?>
  <tr>
    <td><?= $post['Post']['id']; ?></td>
    <td>
      <?= $this->Html->link($post['Post']['title'],
      ['controller' => 'main','action' => 'view', $post['Post']['id']]); ?></td>
    <td><?= $post['Post']['created']; ?></td>
  </tr>
  <?php endforeach; ?>

</table>
</html>
