<html>
<head></head>

<h2>
<?= $post['Post']['title']; ?>
</h2>

<h1>
<?= $post['Post']['content']; ?>
</h1>

<?= $this->Html->link('Edit',['controller' => 'main','action' => 'edit', $post['Post']['id']]); ?>
</html>
