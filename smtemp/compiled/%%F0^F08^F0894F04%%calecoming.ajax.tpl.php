<?php /* Smarty version 2.6.9, created on 2020-03-05 14:49:19
         compiled from calecoming.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'calecoming.ajax.tpl', 21, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "списък на събитията",'WIDTH' => 500)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<table class="d_table" cellspacing='0' cellpadding='0' align=left>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> предстоящи събития в близките 10 дни </td>
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
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
		</table>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>