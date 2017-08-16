<div class="users form">
  <?= $this->Form->create('User'); ?>
    <?= $this->Form->input('username'); ?>
    <?= $this->Form->input('password'); ?>
  <?= $this->Form->end(__('Login')); ?>
</div>
