<?php /* Smarty version 2.6.9, created on 2020-09-17 12:33:04
         compiled from oureprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'oureprnt.tpl', 8, false),array('modifier', 'cat', 'oureprnt.tpl', 15, false),array('modifier', 'replace', 'oureprnt.tpl', 53, false),)), $this); ?>
<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Изходящ регистър за 
				<?php if ($this->_tpl_vars['FLPRIN']): ?>
	<?php if (! empty ( $this->_tpl_vars['DATE']['date'] )): ?>
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
	<?php if (empty ( $this->_tpl_vars['DATE']['adre'] )): ?>
	<?php else: ?>
адресат=<b><?php echo $this->_tpl_vars['DATE']['adre']; ?>
</b>
&nbsp;
	<?php endif; ?>
	<?php if (empty ( $this->_tpl_vars['DATE']['bele'] )): ?>
	<?php else: ?>
бележки=<b><?php echo $this->_tpl_vars['DATE']['bele']; ?>
</b>
&nbsp;
	<?php endif; ?>
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> дата </td>
<td bgcolor="silver"> изх.номер </td>
<td bgcolor="silver" width=90> изп.дело </td>
<td bgcolor="silver"> адресат </td>
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
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
&nbsp;/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
</td>
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['adresat']; ?>
</td>
					<?php if ($this->_tpl_vars['elem']['isentered']): ?>
<td> <?php echo $this->_tpl_vars['elem']['descrip']; ?>

					<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['descriptype']; ?>

					<?php endif; ?>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
<td valign="top" align="left">
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>

						<?php else: ?>
						<?php endif; ?>
	</tr>
		<?php endforeach; endif; unset($_from); ?>
</table>