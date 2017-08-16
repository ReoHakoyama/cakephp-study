<?= $this->element('admin_header',['pageTitle' => 'ユーザー一覧']); ?>
<table>
  <tr>
    <td>ユーザー名</td>
    <td>作成日時</td>
  </tr>
  <?php foreach($users as $user): ?>
    <tr>
      <td><?= $user['User']['username']; ?></td>
      <td><?= $user['User']['created']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>


