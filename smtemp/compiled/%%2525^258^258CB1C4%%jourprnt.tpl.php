<?php /* Smarty version 2.6.9, created on 2022-05-28 10:01:43
         compiled from jourprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'jourprnt.tpl', 8, false),array('modifier', 'cat', 'jourprnt.tpl', 15, false),)), $this); ?>
<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Дневник на извършените действия за 
				<?php if ($this->_tpl_vars['FLPRIN']): ?>
	<?php if (isset ( $this->_tpl_vars['DATE']['date'] )): ?>
		<?php if (empty ( $this->_tpl_vars['DATE']['date2'] )): ?>
дата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;
		<?php else: ?>
периода от <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b> до <b><?php echo ((is_array($_tmp=$this->_tpl_vars['DATE']['date2'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
&nbsp;
		<?php endif; ?>
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['YEAR'])) ? $this->_run_mod_handler('cat', true, $_tmp, " год.") : smarty_modifier_cat($_tmp, " год.")); ?>

	<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> дата </td>
<td bgcolor="silver"> пор.№ </td>
<td bgcolor="silver" width=90> изп.дело </td>
<td bgcolor="silver"> описание </td>
<td bgcolor="silver"> задължено лице </td>
<td bgcolor="silver"> тип </td>
<td bgcolor="silver"> рег. </td>
	</tr>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_jour.tpl", 'smarty_include_vars' => array('PRIN' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</table>