<?php /* Smarty version 2.6.9, created on 2020-04-02 19:35:38
         compiled from fiuslist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'fiuslist.tpl', 50, false),)), $this); ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
<td class='d_table_title' colspan='200'> 
		<?php if ($this->_tpl_vars['USERID'] == 0): ?>
списък СВОБОДНИ дела <?php echo $this->_tpl_vars['USERNAME']; ?>

		<?php else: ?>
списък дела на деловодител <?php echo $this->_tpl_vars['USERNAME']; ?>

		<?php endif; ?>
за <?php echo $this->_tpl_vars['YEAR']; ?>
 год.
</td>
	</tr>
</thead>
					<?php if (count ( $this->_tpl_vars['LIST'] ) == 0): ?>
<tr>
<td>
няма дела
					<?php else: ?>
<tr class='header'>
<td> дело </td>
	<td class='sep'>&nbsp;</td>
<td> създадено </td>
	<td class='sep'>&nbsp;</td>
<td> идва от </td>
	<td class='sep'>&nbsp;</td>
<td> описание </td>
	<td class='sep'>&nbsp;</td>
<td> деловодител </td>
	<td class='sep'>&nbsp;</td>
<td> статус </td>
	<td class='sep'>&nbsp;</td>
<td> взискатели </td>
	<td class='sep'>&nbsp;</td>
<td> длъжници </td>
	<td class='sep'>&nbsp;</td>
<td> виж </td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_archive.head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr onmouseover='this.style.backgroundColor="#eeeeff";' onmouseout='this.style.backgroundColor="";' >
<td > <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td > <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 </td>
	<td class='sep'>&nbsp;</td>
			<?php $this->assign('myindx', $this->_tpl_vars['elem']['idcofrom']); ?>
<td > <nobr><?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['myindx']]; ?>
</nobr> </td>
	<td class='sep'>&nbsp;</td>
<td > <?php echo $this->_tpl_vars['elem']['text']; ?>
 </td>
	<td class='sep'>&nbsp;</td>
<td > <nobr><?php echo $this->_tpl_vars['elem']['username']; ?>
</nobr> </td>
	<td class='sep'>&nbsp;</td>
		<?php $this->assign('indxstat', $this->_tpl_vars['elem']['idstat']); ?>
<td> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['indxstat']]; ?>
 &nbsp;
	<td class='sep'>&nbsp;</td>
<td>
			<?php $this->assign('idcase', $this->_tpl_vars['elem']['id']); ?>
					<?php $_from = $this->_tpl_vars['LISTCLAI'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['memb']):
 if ($this->_tpl_vars['memb']['idtype'] == 1): ?>юл<?php elseif ($this->_tpl_vars['memb']['idtype'] == 2): ?>фл<?php else: ?>др<?php endif; ?> <?php echo $this->_tpl_vars['memb']['name']; ?>

<br>
					<?php endforeach; endif; unset($_from); ?>
	<td class='sep'>&nbsp;</td>
<td>
					<?php $_from = $this->_tpl_vars['LISTDEBT'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['memb']):
 if ($this->_tpl_vars['memb']['idtype'] == 1): ?>юл<?php elseif ($this->_tpl_vars['memb']['idtype'] == 2): ?>фл<?php else: ?>др<?php endif; ?> <?php echo $this->_tpl_vars['memb']['name']; ?>

<br>
					<?php endforeach; endif; unset($_from); ?>
	<td class='sep'>&nbsp;</td>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
"> <img src="images/view.png" title="подробно">
</a></td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_archive.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['elem']['id'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</tr>
	<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>
					<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_archive.inc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>