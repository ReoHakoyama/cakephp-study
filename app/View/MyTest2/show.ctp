<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
  <h3>
  <?= '著者'.$author['Author']['name'].'の投稿一覧'; ?>
  </h3>
  <p>
  <?= $this->Html->link('著者一覧',['controller' => 'my_test2', 'action' => 'index']); ?>
  </p>
<table>
  <tr>
    <th>投稿ID</th>
    <th>タイトル</th>
  </tr>
  <?php foreach ($author['Post'] as $row): ?>

  <tr>
    <td><?= $row['id']; ?></td>
    <td><?= $this->Html->link($row['title'],
        ['controller' => 'main', 'action' => 'view', $row['id']]
      );  ?></td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
