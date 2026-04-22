<?php /* Smarty version 2.6.9, created on 2020-02-28 11:27:43
         compiled from caseglob.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'caseglob.tpl', 34, false),array('function', 'counter', 'caseglob.tpl', 50, false),)), $this); ?>
<style>
table.caus td {font: normal 7pt verdana; border-bottom: 1px solid black}
.tdmain {font: normal 8pt verdana; border-bottom: 0px solid black}
</style>

						<?php if (isset ( $this->_tpl_vars['PRNTLINK'] )): ?>
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	<?php $_from = $this->_tpl_vars['YEARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<td class='tabs_sep'>&nbsp;</td> 
		<?php if ($this->_tpl_vars['YEAR'] == $this->_tpl_vars['ekey']): ?>
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td class='tabs_right_selected'></td>
		<?php else: ?>	
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_left'></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_middle'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_right'></td>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
	</table>
</div>
						<?php else: ?>
						<?php endif; ?>

<?php $this->assign('pagecoun', 70); ?>
					<table align=center>
					<tr>
<td class="tdmain" colspan=6>
разпределение на делата за <?php echo $this->_tpl_vars['YEAR']; ?>
 год. към <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>

						<?php if (isset ( $this->_tpl_vars['PRNTLINK'] )): ?>
<form name="foro" method=post action="<?php echo $this->_tpl_vars['PRNTLINK']; ?>
">
със <input type=text name=rowspc size=4 class="input" value=50> реда в колона 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "document.forms['foro'].submit();;",'TITLE' => 'изведи')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</form>
						<?php else:  $this->assign('pagecoun', $this->_tpl_vars['ROWSPC']); ?>
						<?php endif; ?>
					<tr>
<td class="tdmain" valign=top>
							<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

			<table class="caus" border=1 style="border-collapse:collapse;">
<?php $_from = $this->_tpl_vars['ARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
			<tr>
<td>
<nobr>
	<?php if ($this->_tpl_vars['elem']['ser1'] == $this->_tpl_vars['elem']['ser2']): ?>
'<?php echo $this->_tpl_vars['elem']['ser1']; ?>

	<?php else: ?>
'<?php echo $this->_tpl_vars['elem']['ser1']; ?>
-<?php echo $this->_tpl_vars['elem']['ser2']; ?>

	<?php endif; ?>
</nobr>
<td><nobr> <?php echo $this->_tpl_vars['USERLIST'][$this->_tpl_vars['elem']['iduser']]; ?>
 </nobr>
							<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

						<?php if ($this->_tpl_vars['coun'] > $this->_tpl_vars['pagecoun']): ?>
			</table>
<td class="tdmain" valign=top>
			<table class="caus" border=1 style="border-collapse:collapse;">
							<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

						<?php else: ?>
						<?php endif;  endforeach; endif; unset($_from); ?>
			</table>
					</table>