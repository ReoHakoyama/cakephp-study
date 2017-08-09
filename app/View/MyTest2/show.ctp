<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
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
