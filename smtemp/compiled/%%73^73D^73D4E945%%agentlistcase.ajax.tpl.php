<?php /* Smarty version 2.6.9, created on 2022-01-31 13:19:12
         compiled from agentlistcase.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'agentlistcase.ajax.tpl', 3, false),array('modifier', 'date_format', 'agentlistcase.ajax.tpl', 40, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp=((is_array($_tmp='списък на дела с представител "')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['AGNAME']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['AGNAME'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '"') : smarty_modifier_cat($_tmp, '"')))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		</thead>
		<tr class='header'>
<td> номер
		<td class='sep'>&nbsp;</td>
<td> опис
		<td class='sep'>&nbsp;</td>
<td> идва от 
		<td class='sep'>&nbsp;</td>
<td> създадено
		<td class='sep'>&nbsp;</td>
<td> деловодител
		<td class='sep'>&nbsp;</td>
<td> статус
		</tr>
		<tbody>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr onmouseover='this.style.backgroundColor="#dddddd";' onmouseout='this.style.backgroundColor="";'>
<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>

		<td class='sep'>&nbsp;</td>
<td align=center> <img src="images/view2.gif" title="<?php echo $this->_tpl_vars['elem']['text']; ?>
">
		<td class='sep'>&nbsp;</td>
<td align=left> <nobr><?php echo $this->_tpl_vars['elem']['coname']; ?>
</nobr>
		<td class='sep'>&nbsp;</td>
<td align=left> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

		<td class='sep'>&nbsp;</td>
<td align=left> <nobr><?php echo $this->_tpl_vars['elem']['username']; ?>
</nobr>
		<td class='sep'>&nbsp;</td>
<td align=left> <nobr><?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['elem']['idstat']]; ?>
</nobr>
		</tr>

<?php endforeach; endif; unset($_from); ?>
		</tbody>
		
		</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>