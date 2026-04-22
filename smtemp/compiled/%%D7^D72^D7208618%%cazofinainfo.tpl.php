<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazofinainfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazofinainfo.tpl', 16, false),array('modifier', 'tomo3', 'cazofinainfo.tpl', 50, false),)), $this); ?>
	<table align=center>
	<tr>
	<td align=left valign=top colspan=4> сума
<div style="margin-left:10px;">
<b><?php echo $this->_tpl_vars['elem']['inco']; ?>
</b>
</div>
	<tr>
	<td align=left valign=top colspan=4> 
					<?php if ($this->_tpl_vars['elem']['banktype'] == 1): ?>
време на постъпване в банката
					<?php else: ?>
време на въвеждане 
					<?php endif; ?>
<div style="margin-left:10px;">
<b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['banktime'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M:%S")); ?>
</b>
</div>
	<tr>
	<td align=left valign=top colspan=4> описание
<div style="margin-left:10px;">
<b><?php echo $this->_tpl_vars['elem']['descrip']; ?>
</b>
</div>
						<?php if ($this->_tpl_vars['elem']['idtype'] == 2): ?>
	<tr>
	<td align=left valign=top colspan=4> прих.касов ордер
<div style="margin-left:10px;">
номер <b><?php echo $this->_tpl_vars['elem']['cashserial']; ?>
/<?php echo $this->_tpl_vars['elem']['cashyear']; ?>
</b>
<br>
дата <b><?php echo $this->_tpl_vars['elem']['cashdate']; ?>
</b>
<br>
вносител <b><?php echo $this->_tpl_vars['elem']['cashname']; ?>
</b>
</div>
			<?php else: ?>
			<?php endif; ?>
	<tr>
	<td align=left valign=top colspan=4> последна корекция
<div style="margin-left:10px;">
<b>
<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['time'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S") : smarty_modifier_date_format($_tmp, "%H:%M:%S")); ?>

<?php echo $this->_tpl_vars['elem']['finaname']; ?>

</b>
</div>

	<tr>
	<td align=right valign=top> за ЧСИ неолихвяеми
	<td width=10>
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
	<tr>
	<td align=right valign=top> за ЧСИ т.26
	<td width=10>
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['separa2'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
				<?php if (count ( $this->_tpl_vars['elem']['clailist'] ) == 0): ?>
	<tr>
<td align=right valign=top colspan=3> няма взискатели
		<?php else: ?>
			<?php $_from = $this->_tpl_vars['elem']['clailist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['clainame']):
?>
	<tr>
<td align=right valign=top> за взискател <?php echo $this->_tpl_vars['clainame']; ?>

	<td width=10>
<td align=left valign=top> <b> <?php echo $this->_tpl_vars['elem']['claiamou'][$this->_tpl_vars['idclai']]; ?>
 </b>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	<tr>
	<td align=right valign=top> за връщане
	<td width=10>
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['back'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
					<?php if ($this->_tpl_vars['ISBANKTAX']): ?>
	<tr>
	<td align=right valign=top> за банкови такси
	<td width=10>
<td align=left valign=top> <b> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['banktax'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
 </b>
					<?php else: ?>
					<?php endif; ?>
	</table>