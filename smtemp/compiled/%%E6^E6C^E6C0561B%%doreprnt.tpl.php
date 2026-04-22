<?php /* Smarty version 2.6.9, created on 2021-07-02 13:34:47
         compiled from doreprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'doreprnt.tpl', 8, false),array('modifier', 'cat', 'doreprnt.tpl', 15, false),array('modifier', 'replace', 'doreprnt.tpl', 50, false),)), $this); ?>
<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Входящ регистър за 
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
<td bgcolor="silver"> вх.номер </td>
<td bgcolor="silver" width=90> изп.дело </td>
<td bgcolor="silver"> подател </td>
<td bgcolor="silver"> описание </td>
<td bgcolor="silver"> бележки </td>
	</tr>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr>
<td valign="top" align="left"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 </td>
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['serial']; ?>
&nbsp; </td>
<td valign="top" align="left">
						<?php echo $this->_tpl_vars['elem']['caselist'][0]; ?>
&nbsp;
	<?php if (count ( $this->_tpl_vars['elem']['caselist'] ) > 1): ?>
...
	<?php else: ?>
	<?php endif; ?>
</td>
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['from']; ?>
</td>
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['text']; ?>
</td>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
<td valign="top" align="left">
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>

						<?php else: ?>
						<?php endif; ?>
	</tr>
		<?php endforeach; endif; unset($_from); ?>
</table>