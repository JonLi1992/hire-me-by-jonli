<div class="jobs form">
<?php echo $this->Form->create('Job'); ?>
	<fieldset>
		<legend><?php echo __('Edit Job'); ?></legend>
	<?php
		echo $this->Form->input('jobTitle');
		echo $this->Form->input('jobDescription', array('type' => 'textarea', array('resize' => 'none')));
        echo $this->Form->input('jobDetails', array('type' => 'textarea', array('resize' => 'none')));
        echo $this->Form->input('id', array('type' => 'hidden'));
	?>
	</fieldset>
<?php
    echo $this->Form->end(__('Submit'));
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
	    <!--li><?php echo $this->Form->value('Job.id') ?></li-->
	    <!--li><?php echo $this->Form->value('Job.token') ?></li-->
		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Job.id')), array('confirm' => __('Are you sure you want to delete %s?', $this->Form->value('Job.jobTitle')))); ?></li>
		<li><?php echo $this->Html->link(__('List Jobs'), array('action' => 'index')); ?></li>
    </ul>
</div>
