<html>
<h2>ランキング</h2>
<head>
<meta charset="UTF-8">
</head>
<table>
  <tr>
    <th>順位</th>
    <th>タイトル</th>
    <th>PV数</th>
  </tr>
  <?php foreach ($posts as $post): ?>
  <tr>
    <td></td>
    <td>
    <?= $post['Post']['title'];?>
    </td>
    <td></td>
  </tr>

  <?php endforeach; ?>



</table>
</html>
