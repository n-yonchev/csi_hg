<?php /* Smarty version 2.6.9, created on 2020-02-28 11:28:16
         compiled from invi.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'invi.tpl', 32, false),)), $this); ?>
	<table class="d_table" cellspacing='0' cellpadding='0' align=center>
	<thead>
	<tr>
<td class='d_table_title' colspan='200'>списък на ПДИ</td>
	</tr>
	</thead>

	<tr class='header'>
<td> изх.номер </td>
	<td class='sep'>&nbsp;</td>
<td> изведена </td>
	<td class='sep'>&nbsp;</td>
<td> връчена </td>
	<td class='sep'>&nbsp;</td>
<td> започ. </td>
	<td class='sep'>&nbsp;</td>
<td> задълж.лице </td>
	<td class='sep'>&nbsp;</td>
<td> по дело </td>
	<td class='sep'>&nbsp;</td>
<td> изп.титул </td>
	<td class='sep'>&nbsp;</td>
<td> срок </td>
	<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
	</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
<td> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 &nbsp;</td>
	<td class='sep'>&nbsp;</td>
<td align=center> <?php if ($this->_tpl_vars['elem']['flag'] == 1): ?>да<?php else:  endif; ?> &nbsp;</td>
	<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['person']; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<?php $this->assign('indxtitu', $this->_tpl_vars['elem']['casetitu']); ?>
<td> <?php echo $this->_tpl_vars['LISTTITU'][$this->_tpl_vars['indxtitu']]; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['TIMETITU'][$this->_tpl_vars['indxtitu']]; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</table>


