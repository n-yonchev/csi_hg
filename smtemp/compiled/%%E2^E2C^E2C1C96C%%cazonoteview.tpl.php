<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazonoteview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'cazonoteview.tpl', 19, false),)), $this); ?>
<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<thead>
			<tr>
			<td class='d_table_title' colspan=10 onclick="toggle(this,event);">
<div style="float:left">
бележки
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['URLMOD']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'корегирай')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
			<?php endif; ?>
</thead>
			<tr>
			<td>
			<td class="cont">
<?php echo ((is_array($_tmp=$this->_tpl_vars['DATA']['notes'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>


			</table>

<script type="text/javascript">
	$('a.nyroModal').nyroModal();
</script>