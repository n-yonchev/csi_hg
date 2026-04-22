<?php /* Smarty version 2.6.9, created on 2022-03-25 14:19:27
         compiled from archprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'archprnt.tpl', 8, false),array('modifier', 'cat', 'archprnt.tpl', 15, false),array('modifier', 'nl2br', 'archprnt.tpl', 54, false),array('modifier', 'replace', 'archprnt.tpl', 57, false),)), $this); ?>
<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Архивна книга за 
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
	<?php else: ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['YEAR'])) ? $this->_run_mod_handler('cat', true, $_tmp, " год.") : smarty_modifier_cat($_tmp, " год.")); ?>

	<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>
</b></font>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> арх.№ </td>
<td bgcolor="silver"> изп.дело </td>
<td bgcolor="silver"> дата на <br>архивиране </td>
<td bgcolor="silver"> връзка № </td>
<td bgcolor="silver"> протокол <br>№ и дата</td>
<td bgcolor="silver"> запазени<br>документи</td>
<td bgcolor="silver"> том <br>год.и №</td>
<td bgcolor="silver"> забележка </td>
	</tr>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
								<?php if ($this->_tpl_vars['elem']['serial'] == -1): ?>
								<?php else: ?>
	<tr>
<td valign="top" align="right"> <?php echo $this->_tpl_vars['elem']['serial']; ?>
&nbsp; </td>
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
&nbsp;/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
</td>
<td valign="top" align="left"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 </td>
<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['packet']; ?>

						<?php $this->assign('protda', ((is_array($_tmp=$this->_tpl_vars['elem']['protdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
<td valign="top" align="left"> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['protocol'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['protda']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['protda'])); ?>

<td valign="top" align="left"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['doculist'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>

<td valign="top" align="left"> <?php echo $this->_tpl_vars['elem']['volume']; ?>

<td valign="top" align="left">
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>

&nbsp;
	</tr>
								<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
</table>