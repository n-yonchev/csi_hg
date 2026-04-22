<?php /* Smarty version 2.6.9, created on 2020-02-28 11:29:04
         compiled from cale.inc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cale.inc.tpl', 24, false),)), $this); ?>
		<table class="d_table" cellspacing='0' cellpadding='0' align=left>
		<thead>
						<?php if (count ( $this->_tpl_vars['DATA'] ) == 0): ?>
		<tr>
<td class='d_table_title' colspan='200'> НЯМА събития през месец <?php echo $this->_tpl_vars['YEMO']; ?>
 </td>
		</tr>
		</thead>
						<?php else: ?>
		<tr>
<td class='d_table_title' colspan='200'> събития през месец <?php echo $this->_tpl_vars['YEMO']; ?>
 </td>
		</tr>
		</thead>
		<tr class='header'>
<td> дата </td>
		<td class='sep'>&nbsp;</td>
<td align=left> дело </td>
		<td class='sep'>&nbsp;</td>
<td align=left> деловодител </td>
		<td class='sep'>&nbsp;</td>
<td align=left> събитие </td>
		<tbody>
<?php $_from = $this->_tpl_vars['DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mkey'] => $this->_tpl_vars['elem']):
?>
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['elem']['username']; ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo $this->_tpl_vars['elem']['text']; ?>

<?php endforeach; endif; unset($_from); ?>
		</tbody>
						<?php endif; ?>
		</table>