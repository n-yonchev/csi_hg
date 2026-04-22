<?php /* Smarty version 2.6.9, created on 2022-05-30 12:31:05
         compiled from recaseprnt.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'recaseprnt.tpl', 7, false),array('modifier', 'cat', 'recaseprnt.tpl', 14, false),)), $this); ?>
<table align="center">
	<tr>
<td colspan="6"><font size=+1><b>
Регистър на заведените дела за 
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
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver" valign="middle"> изп.дело </td>
<td bgcolor="silver" valign="middle"> молба образуване </td>
<td bgcolor="silver" valign="middle"> дело източник </td>
<td bgcolor="silver" valign="middle"> име на ЧСИ </td>
<td bgcolor="silver" valign="middle"> № ЧСИ </td>
<td bgcolor="silver" valign="middle"> взискател </td>
<td bgcolor="silver" valign="middle"> длъжник </td>
<td bgcolor="silver" valign="middle"> вид и размер на вземането </td>
<td bgcolor="silver" valign="middle"> произход на вземането </td>
<td bgcolor="silver" width="100"> дата на спиране </td>
<td bgcolor="silver" width="100"> дата на възобновяване </td>
<td bgcolor="silver" width="100"> дата на свършване </td>
<td bgcolor="silver" width="100"> дата на прекратяване </td>
<td bgcolor="silver" width="100"> дата на изпращане </td>
	</tr>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr>

<td align=left valign=top> <?php echo $this->_tpl_vars['elem']['fullnumb']; ?>
&nbsp;
<td align=left valign=top> 
	<?php if (empty ( $this->_tpl_vars['elem']['firstdocu']['seri'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['elem']['firstdocu']['seri']; ?>
/<?php echo $this->_tpl_vars['elem']['firstdocu']['year']; ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['firstdocu']['crea'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 
	<?php endif; ?>
<td align=left valign=top> 
	<?php if (empty ( $this->_tpl_vars['elem']['conome'] ) && empty ( $this->_tpl_vars['elem']['coyear'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['ARSORT'][$this->_tpl_vars['elem']['idsort']]; ?>
 <?php echo $this->_tpl_vars['elem']['conome']; ?>
/<?php echo $this->_tpl_vars['elem']['coyear']; ?>
 
	<?php endif; ?>
	<?php if (empty ( $this->_tpl_vars['elem']['idcofrom'] )): ?>
&nbsp;
	<?php else:  echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['elem']['idcofrom']]; ?>

	<?php endif; ?>
<td align=left valign=top> <?php echo $this->_tpl_vars['ROOFFI']['shortname']; ?>

<td align=left valign=top> <?php echo $this->_tpl_vars['ROOFFI']['serial']; ?>

			<?php $this->assign('idcase', $this->_tpl_vars['elem']['id']); ?>
<td align=left valign=top> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_recaseelem.tpl", 'smarty_include_vars' => array('DATALIST' => $this->_tpl_vars['DATACLAI'][$this->_tpl_vars['idcase']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=left valign=top> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_recaseelem.tpl", 'smarty_include_vars' => array('DATALIST' => $this->_tpl_vars['DATADEBT'][$this->_tpl_vars['idcase']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['claimdescrip']; ?>

<td> <?php echo $this->_tpl_vars['ARCLAIORIG'][$this->_tpl_vars['elem']['idclaimorig']]; ?>

	<?php if (empty ( $this->_tpl_vars['elem']['statdate'] )): ?>
	<?php else: ?>
		<?php $_from = $this->_tpl_vars['TXTRANSTAT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['instat'] => $this->_tpl_vars['txstat']):
?>
<td align=left valign=top> 
			<?php if ($this->_tpl_vars['instat'] == $this->_tpl_vars['elem']['statdate']['indx']):  echo ((is_array($_tmp=$this->_tpl_vars['elem']['statdate']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<?php else: ?>
			<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>

	</tr>
		<?php endforeach; endif; unset($_from); ?>
</table>