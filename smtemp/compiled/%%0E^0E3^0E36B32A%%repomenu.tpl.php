<?php /* Smarty version 2.6.9, created on 2020-11-16 17:05:09
         compiled from repomenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'repomenu.tpl', 12, false),)), $this); ?>
<style>
.vari {font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer}
.curr {font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer; background-color:lightcyan; padding: 1px 10px;}
.bggrou {font: normal 8pt verdana; background-color:wheat; padding: 10x 10px;}
body {font:normal 10pt verdana;}
</style>
						<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
					<?php $this->assign('txperi', ((is_array($_tmp=$this->_tpl_vars['ARPERI'][0])) ? $this->_run_mod_handler('cat', true, $_tmp, " год.") : smarty_modifier_cat($_tmp, " год."))); ?>
					<?php if (empty ( $this->_tpl_vars['ARPERI'][1] )): ?>
					<?php else: ?>
						<?php $this->assign('txperi', ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['txperi'])) ? $this->_run_mod_handler('cat', true, $_tmp, " полугодие ") : smarty_modifier_cat($_tmp, " полугодие ")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['ARPERI'][1]) : smarty_modifier_cat($_tmp, $this->_tpl_vars['ARPERI'][1]))); ?>
					<?php endif; ?>
	<tr>
<td class='d_table_title' colspan='200'> отчети за <?php echo $this->_tpl_vars['txperi']; ?>
</td>
	</tr>
</thead>
				<tr>
<td>
			<table cellspacing='4' cellpadding='4'>
			<tr>
<?php $_from = $this->_tpl_vars['ARSCEN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<td class="bggrou">
<center><b><?php echo $this->_tpl_vars['elem']; ?>
</b></center>
<hr>
	<?php $_from = $this->_tpl_vars['ARGROU'][$this->_tpl_vars['ekey']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elemgr']):
?>
<span class="<?php if ($this->_tpl_vars['elemgr'] == $this->_tpl_vars['VARI']): ?>curr<?php else: ?>vari<?php endif; ?>" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARVARI'][$this->_tpl_vars['elemgr']]['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['ARVARI'][$this->_tpl_vars['elemgr']]['text']; ?>
 </span>
	<?php endforeach; endif; unset($_from); ?>
<br>&nbsp;
<?php endforeach; endif; unset($_from); ?>
			</table>
									<?php if (isset ( $this->_tpl_vars['ARVARI'][$this->_tpl_vars['VARI']]['isex'] )): ?>
									<?php else: ?>
				<tr>
<td> 
<?php echo $this->_tpl_vars['REP2CONT']; ?>

<br> &nbsp;
									<?php endif; ?>

</table>
									<?php if (isset ( $this->_tpl_vars['ARVARI'][$this->_tpl_vars['VARI']]['isex'] )): ?>
<br> &nbsp;
			<?php if ($this->_tpl_vars['VARI'] == 'resu'): ?>
						<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
<center>
виж дело ном/год 
<input style="font: bold 7pt verdana;background-color:#dddddd; border: 0px solid black;" autocomplete=off
type="text" name="rep2case" id="rep2case" size=14 onkeyup="autosubm(event);" onfocus="this.value='';">
+enter
</center>
						</form>
			<?php else: ?>
			<?php endif; ?>
<?php echo $this->_tpl_vars['REP2CONT']; ?>

									<?php else: ?>
									<?php endif; ?>
						
<script>
function autosubm(event){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
document.forms['myform'].submit();
	}else{
return true;
	}
}
</script>

						<?php if (isset ( $this->_tpl_vars['URLCREATE'] )): ?>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
<iframe id="frarep" width=800 height=400 frameborder=0 style="visibility:visible"></iframe>
</center>
<script>
//function fuprin(p1){
//alert("<?php echo $this->_tpl_vars['URLCREATE']; ?>
");
	document.getElementById("frarep").src= "<?php echo $this->_tpl_vars['URLCREATE']; ?>
";
//}
</script>
						<?php else: ?>
						<?php endif; ?>