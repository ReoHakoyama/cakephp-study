<?= $this->element('admin_header',['pageTitle' => 'ユーザー一覧']); ?>
<table class="table table-bordered table-hove">
  <tr>
    <th>ユーザー名</th>
    <th>作成日時</th>
  </tr>
  <?php foreach($users as $user): ?>
    <tr>
      <th><?= $user['User']['username']; ?></th>
      <td><?= date ('Y/m/d H:i',strtotime($user['User']['created'])); ?></td>
    </tr>
  <?php endforeach; ?>
</table>


