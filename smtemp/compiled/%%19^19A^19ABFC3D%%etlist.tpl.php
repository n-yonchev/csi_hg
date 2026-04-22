<?php /* Smarty version 2.6.9, created on 2020-12-09 14:14:24
         compiled from etlist.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.mark {font: normal 8pt verdana;background-color:red;color:white}
.deli {background-color:silver;height:4px;}
.case {background-color:wheat;cursor:pointer;}
</style>
			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
			<tr class='head2'>
<td colspan='20'>
списък на делата с ЕТ
			<tr class='head2'>
<td> дело
<td> деловодител
<td> ЦРД-2014
<td> &nbsp;
<td> взиск
<td> длъж
<?php $_from = $this->_tpl_vars['ARCASE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idcase'] => $this->_tpl_vars['elem']):
?>
			<tr>
<td rowspan=2 class="case" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="виж делото"> <?php echo $this->_tpl_vars['elem']['caseri']; ?>
/<?php echo $this->_tpl_vars['elem']['cayear']; ?>

<td rowspan=2> <?php echo $this->_tpl_vars['elem']['usname']; ?>

<td rowspan=2 align=center> 
					<?php if (empty ( $this->_tpl_vars['elem']['reg4text'] )): ?>
&nbsp;
					<?php else: ?>
<img src="images/info.gif" rela="reg4" rel="#reg4cont<?php echo $this->_tpl_vars['idcase']; ?>
" title="последен резултат от ЦРД-2014" style="cursor:help">
<span id="reg4cont<?php echo $this->_tpl_vars['idcase']; ?>
" style="display: none">
	<?php $_from = $this->_tpl_vars['elem']['artext']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['txelem']):
?>
		<nobr><?php echo $this->_tpl_vars['txelem'][0]; ?>
</nobr>
			<?php if (empty ( $this->_tpl_vars['txelem'][1] )): ?>
			<?php else: ?>
		<br>
		<span style="font:normal 8pt courier;color:blue"><?php echo $this->_tpl_vars['txelem'][1]; ?>
</span>
			<?php endif; ?>
		<br>
	<?php endforeach; endif; unset($_from); ?>
</span>
					<?php endif; ?>
<td> брой бивши ЕТ физ.лица
<td align=center> <?php echo $this->_tpl_vars['elem']['c0']; ?>
 &nbsp;
<td align=center> <?php echo $this->_tpl_vars['elem']['d0']; ?>
 &nbsp;
			<tr>
<td> брой настоящи ЕТ юрид.лица
<td align=center class="<?php if ($this->_tpl_vars['elem']['c1'] == $this->_tpl_vars['elem']['c0']):  else: ?>mark<?php endif; ?>"> <?php echo $this->_tpl_vars['elem']['c1']; ?>
 &nbsp;
<td align=center class="<?php if ($this->_tpl_vars['elem']['d1'] == $this->_tpl_vars['elem']['d0']):  else: ?>mark<?php endif; ?>"> <?php echo $this->_tpl_vars['elem']['d1']; ?>
 &nbsp;
			<tr>
<td class="deli" colspan=20> &nbsp;
<?php endforeach; endif; unset($_from); ?>
			</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$("[@rela='reg4']").cluetip({ width: 660, local:true, cursor:'help' });
});
</script>