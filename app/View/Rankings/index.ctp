<html>
<h2>ランキング</h2>
<head>
<meta charset="UTF-8">
</head>
<p>
<?= $this->Html->link('投稿一覧へ',['controller' => 'main', 'action' => 'index']); ?>
</p>
<table>
  <tr>
    <th>順位</th>
    <th>タイトル</th>
    <th>PV数</th>
  </tr>
  <?php foreach ($posts as $kay => $post): ?>
  <tr>
    <td>
    <?php
      echo $kay+1;
    ?> 位
    </td>
    <td>
    <?= $this->Html->link($post['Post']['title'],[
      'controller' => 'main', 'action' => 'view',$post['Post']['id']
    ]); ?>
    </td>
    <td>
    <?= $post['PostPageview']['view_count']; ?>
    </td>
  </tr>

  <?php endforeach; ?>



</table>
</html>
