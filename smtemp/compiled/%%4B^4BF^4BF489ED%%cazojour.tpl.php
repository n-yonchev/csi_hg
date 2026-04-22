<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazojour.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazojour.tpl', 33, false),)), $this); ?>
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<thead>
	<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">извършени действия
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div class='d_table_button' style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
	</tr>
	
</thead>
	<tr class='header'>
		<td><span> дата </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> задълж.лице</span></td>
	</tr>
<tbody>
	<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>		
	<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>	
		<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
		<td class='sep'>&nbsp;</td>			
		<td> <?php echo $this->_tpl_vars['elem']['descrip']; ?>
</td>
		<td class='sep'>&nbsp;</td>
		<td> <?php echo $this->_tpl_vars['elem']['person']; ?>
</td>
		<td class='sep'>&nbsp;</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>