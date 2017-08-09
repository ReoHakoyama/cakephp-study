<html>
<head></head>
<p>
<?= $this->Html->link('一覧に戻る',['controller'=>'main', 'action'=>'index']); ?>
</p>
<h2>
『 <?= $post['Post']['title']; ?> 』
</h2>

<h3>
<?= $post['Post']['content']; ?>
</h1>

<h1>コメント</h1>
<?php foreach ($post['Comment'] as $comment): ?>
<?php echo $comment['comment'].'<br>'; ?>
<?php endforeach; ?>
<?php echo $this->Form->create('Comment', ['url' => ['controller' => 'main', 'action' => 'addComment']]); ?>
<?= $this->Form->input('comment',['type' => 'textarea']); ?>
<?= $this->Form->hidden('post_id', ['value' => $post['Post']['id']]); ?>
<?= $this->Form->end('コメントする',['action' => 'addComment']); ?>
<?= $this->Html->link('投稿の編集',['controller' => 'main','action' => 'edit', $post['Post']['id']]); ?>
<br>
<br>
<?= $this->form->postLink(
    '投稿の削除',
    ['action' => 'delete', $post['Post']['id']],
    [],
    '削除しますか？'
    );  ?>


</html>
