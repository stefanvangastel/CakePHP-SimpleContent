<h1><?php echo __('Pages index');?></h1>

<?php 
echo $this->Form->create('SimplePage',array('id'=>'PageCreateForm','url'=>array('action'=>'create')));
	echo $this->Form->input('title', array('label'=>'','value'=>''));
	echo $this->Form->button(__('Create page'),array('type'=>'submit','class'=>'btn btn-success','escape'=>false));
echo $this->Form->end();
?>


<table class="table table-hover table-condesed">
	<tr>
		<th><?php echo __('Page title');?></th>
		<th><?php echo __('Last modified');?></th>
		<th><?php echo __('Link code');?></th>
		<th><?php echo __('Actions');?></th>
	</tr>
	<?php 
	foreach($pages as $page){
	?>
	<tr>
		<td>
			<?php echo $page['SimplePage']['title'] ?>
		</td>
		<td>
			<?php echo date('d-m-Y H:i:s',$page['SimplePage']['modified']); ?>
		</td>
		<td>
			<pre>$this->Html->link('<?php echo $page['SimplePage']['title'];?>','/sp/<?php echo $page['SimplePage']['id'];?>/<?php echo $page['SimplePage']['key'];?>');</pre>
		</td>
		<td>
			<div class="btn-group">
				<?php echo $this->Html->link(__('Preview'), '/sp/'.$page['SimplePage']['id'].'/'.$page['SimplePage']['key'],array('class'=>'btn btn-small btn-success','target'=>'_blank')); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $page['SimplePage']['id']),array('class'=>'btn btn-small btn-warning')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $page['SimplePage']['id']), array('class'=>'btn btn-small btn-danger'), __('Are you sure you want to delete page "%s"?', $page['SimplePage']['title'])); ?>
			</div>
		</td>
	</tr>
	<?php 
	}
	?>
</table>