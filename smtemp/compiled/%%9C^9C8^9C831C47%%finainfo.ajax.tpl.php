<?php /* Smarty version 2.6.9, created on 2020-02-27 14:00:12
         compiled from finainfo.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney', 'finainfo.ajax.tpl', 31, false),)), $this); ?>

		<table align=center>
		<tr>
<td align=right valign=top> тип
			<?php $this->assign('myindx', $this->_tpl_vars['DATA']['idtype']); ?>
<td align=left valign=top> <b> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['myindx']]; ?>
 </b>
		<tr>
<td align=right valign=top> сума
<td align=left valign=top> <b> <?php echo $this->_tpl_vars['DATA']['inco']; ?>
 </b>
		<tr>
<td align=right valign=top> дело
<td align=left valign=top> <b> <?php echo $this->_tpl_vars['DATA']['caseseri']; ?>
/<?php echo $this->_tpl_vars['DATA']['caseyear']; ?>
 </b>
		<tr>
<td align=right valign=top> описание
<td align=left valign=top> <b> <?php echo $this->_tpl_vars['DATA']['descrip']; ?>
 </b>
		<tr>
<td colspan=3> <hr>
		</table>

		<table>
		<tr>
<td align=right valign=top> за ЧСИ неолихвяеми
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['separa'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>
 </b>
		<tr>
<td align=right valign=top> за ЧСИ т.26
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['separa2'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>
 </b>
		<?php if (count ( $this->_tpl_vars['CLAILIST'] ) == 0): ?>
		<tr>
<td colspan=3> няма взискатели
	<?php else: ?>
		<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['clainame']):
?>
		<tr>
<td align=right valign=top> <nobr>за взискател <?php echo $this->_tpl_vars['clainame']; ?>
</nobr>
<td align=left valign=top><b> <?php echo $this->_tpl_vars['DATA']['claiamou'][$this->_tpl_vars['idclai']]; ?>
 </b>
		<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	<tr>
	<td align=right valign=top> за връщане
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['back'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>
 </b>
		</table>
