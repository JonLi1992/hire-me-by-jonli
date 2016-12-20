<div class="jobs form">
<?php echo $this->Form->create('Job'); ?>
	<fieldset>
		<legend><?php echo __('Submit new Job'); ?></legend>
	<?php
		echo $this->Form->input('jobTitle');
		echo $this->Form->input('firmEmail');
		echo $this->Form->input('jobDescription', array('type' => 'textarea', array('resize' => 'none')));
		echo $this->Form->input('jobDetails', array('type' => 'textarea', array('resize' => 'none')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Jobs'), array('action' => 'index')); ?></li>
	</ul>
</div>
