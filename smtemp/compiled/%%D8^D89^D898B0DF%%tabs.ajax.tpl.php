<?php /* Smarty version 2.6.9, created on 2020-02-27 15:04:37
         compiled from tabs.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'tabs.ajax.tpl', 17, false),)), $this); ?>
												<table>
			<tr>
			<td class="contcase" valign=top>
деловодител
			<td class="contcase" valign=top>
<b>
<?php echo $this->_tpl_vars['USERNAME']; ?>

</b>
			<tr>
			<td class="contcase" valign=top>
образувано на
			<td class="contcase" valign=top>
<b>
<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

</b>
			<tr>
			<td class="contcase" valign=top>
описание
			<td class="contcase" valign=top>
<b>
<?php echo $this->_tpl_vars['DATA']['text']; ?>

</b>
			<tr>
			<td class="contcase" valign=top>
идва от
			<td class="contcase" valign=top>
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idcofrom']); ?>
<b>
<?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['arindx']]; ?>

</b>
	<?php if (empty ( $this->_tpl_vars['DATA']['cogrou'] )): ?>
	<?php else: ?>
/ състав <?php echo $this->_tpl_vars['DATA']['cogrou']; ?>

	<?php endif; ?>
			<tr>
			<td class="contcase" valign=top>
изп.титул
			<td class="contcase" valign=top>
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idtitu']); ?>
<b>
<?php echo $this->_tpl_vars['ARTITU'][$this->_tpl_vars['arindx']]; ?>

</b>
			<tr>
			<td class="contcase" valign=top>
вид, номер/год
			<td class="contcase" valign=top>
						<?php $this->assign('arindx', $this->_tpl_vars['DATA']['idsort']); ?>
<b>
<?php echo $this->_tpl_vars['ARSORT'][$this->_tpl_vars['arindx']]; ?>
, <?php echo $this->_tpl_vars['DATA']['conome']; ?>
/<?php echo $this->_tpl_vars['DATA']['coyear']; ?>

</b>
												</table>