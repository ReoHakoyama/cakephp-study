<?= $this->element('admin_header',['pageTitle' => 'カテゴリー一覧']); ?>

<label>新カテゴリー追加</label>
<?= $this->Form->create('Category', ['action' => 'admin_add']); ?>
<?= $this->Form->input('name',['text']); ?>
<?= $this->Form->end('カテゴリーを追加する'); ?>


<table class="table table-bordered table-hove">
</table>
