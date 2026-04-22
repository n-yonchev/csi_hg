<?php /* Smarty version 2.6.9, created on 2020-03-10 14:25:46
         compiled from v1addc.tpl */ ?>
<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<style>
td {font: normal 8pt verdana}
.mess {font: normal 8pt verdana; letter-spacing: 2;}
</style>

						<table align=center>
				<?php if (isset ( $this->_tpl_vars['PAGEBACKLINK'] )): ?>
<tr><td align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['PAGEBACKTEXT']; ?>
 </a>
				<?php else: ?>
				<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['PAGEBACKLINK2'] )): ?>
<tr><td align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK2'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['PAGEBACKTEXT2']; ?>
 </a>
				<?php else: ?>
				<?php endif; ?>
<tr><td align=left>
<br>
			<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='10'> добави дело/дела към списъка на наблюдател <?php echo $this->_tpl_vars['ROVIEW']['name']; ?>

			</thead>

			<tr>
<td colspan='10'> 
								<table>
								<tr>
					<td colspan=3>
добави директно дело/год &nbsp;
<input type="text" name="casenumb" id="casenumb" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'casenumb','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
style="font:bold 7pt verdana;" onkeyup="autosu(event);">
+enter
								<tr>
					<td colspan=2>
<br>
или търси за добавяне група дела по филтър
								<tr>
					<td>
име или част от него за взискател
					<td>
<input type="text" name="claitext" id="claitext" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'claitext','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
style="font:bold 7pt verdana;">
								<tr>
					<td>
име или част от него за представител
					<td>
<input type="text" name="agentext" id="agentext" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'agentext','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
style="font:bold 7pt verdana;">
					<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'търси','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								</table>


			</table>
						</table>

<br>
								<?php if (! empty ( $this->_tpl_vars['ERMESS'] )): ?>
<center class="mess">
<font color=red><?php echo $this->_tpl_vars['ERMESS']; ?>
</font>
</center>
								<?php elseif (! empty ( $this->_tpl_vars['INFOMESS'] )): ?>
<center class="mess">
<?php echo $this->_tpl_vars['INFOMESS']; ?>

</center>
								<?php elseif (! empty ( $this->_tpl_vars['FILTTEXT'] )): ?>
			<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='10'> намерени дела с <?php echo $this->_tpl_vars['FILTTEXT']; ?>

			</thead>
			</table>
								<?php else: ?>
								<?php endif; ?>

</form>

<script>
function autosubm(event){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
			document.forms["myseleform"].submit();
return false;
	}else{
return true;
	}
}
</script>

										<?php if (isset ( $this->_tpl_vars['NYROLINK'] )): ?>
<a id="link" href="v1addclist.ajax.php<?php echo $this->_tpl_vars['NYROLINK']; ?>
" class="nyroModal" target="_blank" style="display:none">link</a>
<script type="text/javascript">
	$(function() {
		$('#link').click();
		return false;
	});
</script>
					<?php else: ?>
					<?php endif; ?>
					<a id="linkrelo" href="<?php echo $this->_tpl_vars['LINKRELO']; ?>
" style="display:none;"></a>