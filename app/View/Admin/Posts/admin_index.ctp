<?= $this->element('admin_header',['pageTitle' => '投稿一覧']); ?>
<table class="table table-bordered table-hove">
  <tr>
    <th>タイトル</th>
    <th>著者</th>
    <th>タグ</th>
    <th>日時</th>
  </tr>
<?php foreach ($posts as $post): ?>
 <?php // new dBug($post); ?>
 <?php // die; ?>
 <tr>
    <td><?= $post['Post']['title']; ?></td>
    <td>
    <?php echo $post['Author']['name']; ?>
    </td>
    <td>
    <?php
    foreach ($post['PostTag'] as $key => $postTag){
      echo $postTag['Tag']['name'];
      if (($key+1) != count($post['PostTag'])){
        echo ',';
        }
      }
    ?>
    </td>
    <td><?= date ('Y/m/d H:i',strtotime($post['Post']['created'])); ?></td>
  </tr>
<?php endforeach; ?>
</table>
