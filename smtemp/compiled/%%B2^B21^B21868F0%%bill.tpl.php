<?php /* Smarty version 2.6.9, created on 2020-02-28 11:26:47
         compiled from bill.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'bill.tpl', 49, false),array('modifier', 'tomo3', 'bill.tpl', 53, false),array('modifier', 'cat', 'bill.tpl', 55, false),)), $this); ?>
<style>
.link {font: normal 7pt verdana; color:black; cursor:pointer; border-bottom: 1px solid black}
.text {font: normal 7pt verdana; color:black;}
</style>

			<table align=center class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr>
<td class='d_table_title' colspan='30'> 
списък на сметките
		</thead>
		<tr class='header'>
<td> номер </td>
		<td class='sep'>&nbsp;</td>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td> взискател </td>
		<td class='sep'>&nbsp;</td>
<td> сума </td>
		<td class='sep'>&nbsp;</td>
<td> дело </td>
		<td class='sep'>&nbsp;</td>
<td> деловодител </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		</tr>
		<tbody>

		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
								<?php if ($this->_tpl_vars['elem']['serial'] == -1): ?>
			<tr>
											<?php if ($this->_tpl_vars['elem']['arch2'] == $this->_tpl_vars['elem']['arch1']): ?>
<td colspan=7 bgcolor=salmon> ЛИПСВА АРХИВЕН НОМЕР <b><?php echo $this->_tpl_vars['elem']['arch2']; ?>
</b>
											<?php else: ?>
<td colspan=7 bgcolor=salmon> липсват <b><?php echo $this->_tpl_vars['elem']['archcoun']; ?>
</b> бр. архивни номера <b><?php echo $this->_tpl_vars['elem']['arch2']; ?>
 - <?php echo $this->_tpl_vars['elem']['arch1']; ?>
</b>
											<?php endif; ?>
								<?php else: ?>
			<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['persname']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['LISTSUMA'][$this->_tpl_vars['elem']['id']])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</td>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['caseseri'])) ? $this->_run_mod_handler('cat', true, $_tmp, "/") : smarty_modifier_cat($_tmp, "/")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['elem']['caseyear']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['elem']['caseyear'])); ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_sepa.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<a href="<?php echo $this->_tpl_vars['elem']['prinbill']; ?>
" class="nyroModal" target="_blank"><img src="images/print.gif" title="отпечати"></a>
								<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

		</tbody>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>
			</table>