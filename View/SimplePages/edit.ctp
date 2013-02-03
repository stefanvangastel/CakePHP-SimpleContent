<?php 
//Include CKEditor through script viewblock
$this->start('script');
	
$this->end();
?>

<h1><?php echo __('Edit page')?></h1>
<blockquote>
<p><?php echo __('You can edit the title and content of the page just by clicking in the text below this line:')?>
</blockquote>

<hr>
			
<?php 
//Actual edit section

if(!empty($this->data['SimplePage'])){
	?>
	<h2 id="PageTitleDiv" contenteditable="true">
			<?php echo $this->data['SimplePage']['title']; ?>
	</h2>
	<div id="PageContentDiv" contenteditable="true">
		<?php 
			echo $this->data['SimplePage']['content'];
		?>	
	</div>
	<div style="clear:both;">
	<hr>
	<?php
	 echo $this->Form->create('SimplePage',array('id'=>'PageSaveForm'));
		echo $this->Form->input('id',array('type'=>'hidden'));
		echo $this->Form->input('title',array('id'=>'EditPageTitle','type'=>'hidden', 'value'=>$this->data['SimplePage']['title']));
		echo $this->Form->input('content',array('id'=>'EditPageContent','type'=>'hidden', 'value'=>$this->data['SimplePage']['content']));
		
		echo $this->Html->link('<i class="icon-chevron-left"></i> '.__('Back'), 'index' ,array('action'=>'index','class'=>'btn pull-left','escape'=>false),__('Discard any changes made?'));
		
		echo $this->Form->button('<i class="icon-ok icon-white"></i> '.__('Save page'),array('type'=>'submit','class'=>'btn btn-success pull-right','escape'=>false));
	echo $this->Form->end();
	?>
	</div>
	<?php  
}

//End edit section
?>


<?php 
$this->start('script');

echo $this->Html->script('/simple_content/js/ckeditor/ckeditor');
?>
<script>
	 //Editable title div on focus lost; update hidden form field
	$("#PageTitleDiv").blur(function() {
	   $('#EditPageTitle').val($("#PageTitleDiv").html());
	});
	
	//Editable content div on focus lost; update hidden form field
	$("#PageContentDiv").blur(function() {
	  $('#EditPageContent').val($("#PageContentDiv").html());
	});

	<?php 
	//Only load filemanager if symlink or dir copy is in place
	if(file_exists(WWW_ROOT.DS.'filemanager'.DS.'index.html')){
		?>
		CKEDITOR.config.filebrowserBrowseUrl='<?php echo $this->Html->url('/filemanager/index.html');?>' //FIRST: COPY filemanager dir from app/Plugin/Content/webroot/filemanager to app/webroot/filemanager !!!!
		<?php 
		
		//Check for default upload existance
		if( ! file_exists(WWW_ROOT.'img'.DS.'upload')){
			@mkdir(WWW_ROOT.'img'.DS.'upload');
		}
	}
	?>

	CKEDITOR.editorConfig = function( config ) {
		// Define changes to default configuration here. For example:
		// config.language = 'fr';
		// config.uiColor = '#AADC6E';
		
		config.toolbar = 'Full';
		//config.toolbar = 'Custom';
		 
		config.toolbar_Custom =
			[
				{ name: 'document', items : [ 'Source','-','Save','Print','-','Templates' ] },
				{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
				{ name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
				{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar' ] },
				{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] },
				'/',
				{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
				{ name: 'styles', items : [ 'Format'] },
				{ name: 'colors', items : [ 'TextColor','BGColor' ] },
				{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-',
				'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
				{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			];
		
		config.toolbar_Full =
		[
			{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
			{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
		        'HiddenField' ] },
			'/',
			{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
			'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
			{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
			'/',
			{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
			{ name: 'colors', items : [ 'TextColor','BGColor' ] },
			{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
		];
		 
		config.toolbar_Basic =
		[
			['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
		];
	};

</script>
<?php $this->end();?>