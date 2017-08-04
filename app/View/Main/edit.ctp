 <html>
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<?= $this->Form->create('Post'); ?>
<?= $this->Form->input('title',['text']); ?>
<?= $this->Form->input('content',['textarea']); ?>
<?= $this->Form->end('投稿する'); ?>
</body>
</html>

