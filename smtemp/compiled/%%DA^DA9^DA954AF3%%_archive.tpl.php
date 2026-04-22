<?php /* Smarty version 2.6.9, created on 2020-02-27 13:05:07
         compiled from _archive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', '_archive.tpl', 17, false),)), $this); ?>
									<?php if ($this->_tpl_vars['FLAGARCHIVE']): ?>
<td class='sep'>&nbsp;</td>
										<?php if (empty ( $this->_tpl_vars['elem']['archive'] )): ?>
<td>
&nbsp;
										<?php else: ?>
<td align=right>
<img src="images/archive.gif" class="arch" rel="#arch<?php echo $this->_tpl_vars['ID']; ?>
" title="данни за архива" style="cursor:help;">
<span id="arch<?php echo $this->_tpl_vars['ID']; ?>
" style="display: none">
последна корекция от <b><?php echo $this->_tpl_vars['elem']['archive']['username']; ?>
</b>
<br>
на <b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['archive']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>
</b>
	<table align=center>
	<tr>
<td align=left>номер/дата <td> <b><?php echo $this->_tpl_vars['elem']['archive']['serial']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['archive']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</b>
	<tr>
<td align=left>връзка № <td> <b><?php echo $this->_tpl_vars['elem']['archive']['packet']; ?>
</b>
	<tr>
<td align=left>протокол <td> <b><?php echo $this->_tpl_vars['elem']['archive']['protocol']; ?>
</b>
	<tr>
<td align=left>документи <td> <b><?php echo $this->_tpl_vars['elem']['archive']['documents']; ?>
</b>
	<tr>
<td align=left>том/година <td> <b><?php echo $this->_tpl_vars['elem']['archive']['volume']; ?>
/<?php echo $this->_tpl_vars['elem']['archive']['year']; ?>
</b>
	<tr>
<td align=left>забележка <td> <b><?php echo $this->_tpl_vars['elem']['archive']['notes']; ?>
</b>
	</table>
</span>
										<?php endif; ?>
</td>
									<?php else: ?>
									<?php endif; ?>