<div class="jobs view">
<h2><?php echo h($job['Job']['jobTitle']); ?></h2>
	<dl>
		<dt><?php echo __('JobDescription'); ?></dt>
		<dd>
			<?php echo h($job['Job']['jobDescription']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('JobDetails'); ?></dt>
		<dd>
			<?php echo h($job['Job']['jobDetails']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($job['Job']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($job['Job']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Jobs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job'), array('action' => 'add')); ?> </li>
	</ul>
</div>
