<?php /* Smarty version 2.6.9, created on 2025-04-11 16:19:06
         compiled from stfinacolo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'stfinacolo.tpl', 10, false),array('modifier', 'truncate', 'stfinacolo.tpl', 101, false),array('function', 'counter', 'stfinacolo.tpl', 71, false),)), $this); ?>
						<table>
						<tr>
						<td>
				<table align=center <?php echo $this->_tpl_vars['bord']; ?>
>
				<tr>
				<td class="hetext" colspan=8>
&nbsp;&nbsp;
общо състояние на <?php echo $this->_tpl_vars['TEX1']; ?>
 (<?php echo $this->_tpl_vars['WHATTEXT']; ?>
)
<br>&nbsp;&nbsp;
към <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>

				<tr>
				<td class="hetext" width=100 align=center>
общо
				<td class="hetext" width=100 align=center>
ненасочени
				<td class="hetext" width=100 align=center>
насочени
				<td class="hetext" width=100 align=center>
насочени=<br>% общо
				<tr>
				<td class="sttext" align=center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['LIS1'][0]+$this->_tpl_vars['LIS1'][1])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="sttext" align=center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['LIS1'][0])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="sttext" align=center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['LIS1'][1])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="sttext" align=center>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_percent.tpl", 'smarty_include_vars' => array('P1' => $this->_tpl_vars['LIS1'][1],'P2' => $this->_tpl_vars['LIS1'][0]+$this->_tpl_vars['LIS1'][1])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>
						<tr>
						<td>&nbsp;
						<tr>
						<td>
				<table align=center <?php echo $this->_tpl_vars['bord']; ?>
>
				<tr>
				<td class="hetext" colspan=8>
&nbsp;&nbsp;
състояние на насочените <?php echo $this->_tpl_vars['TEX2']; ?>
 постъпления (<?php echo $this->_tpl_vars['WHATTEXT']; ?>
) по деловодители
										<?php if ($this->_tpl_vars['FLPRIN']): ?>
											<?php $this->assign('step', 1500); ?>
										<?php else: ?>
											<?php $this->assign('step', 15); ?>
										<?php endif; ?>
													<?php echo smarty_function_counter(array('start' => 0,'assign' => 'mycoun'), $this);?>

		<?php $_from = $this->_tpl_vars['USERLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['userid'] => $this->_tpl_vars['elem']):
?>
													<?php echo smarty_function_counter(array('assign' => 'mycoun'), $this);?>

													<?php if ($this->_tpl_vars['mycoun']%$this->_tpl_vars['step'] == 1): ?>
				<tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "stfinahead.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
													<?php else: ?>
													<?php endif; ?>
											<?php $this->assign('izravn', ($this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][1][0]+$this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][1][1])); ?>
											<?php $this->assign('neizra', ($this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][0][0]+$this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][0][1])); ?>
											<?php $this->assign('obshto', ($this->_tpl_vars['izravn']+$this->_tpl_vars['neizra'])); ?>
																								<?php if ($this->_tpl_vars['userid'] == -1): ?>
								<?php $this->assign('stname', 'hesuma'); ?>
								<?php $this->assign('stdata', 'hesuma');  $this->assign('stcont', "padding:10px 2px 10px 10px"); ?>
							<?php else: ?>
								<?php $this->assign('stname', 'td8'); ?>
								<?php $this->assign('stdata', 'sttext');  $this->assign('stcont', ""); ?>
							<?php endif; ?>
				<tr>
				<td class="<?php echo $this->_tpl_vars['stname']; ?>
" style="<?php echo $this->_tpl_vars['stcont']; ?>
">
		<?php if ($this->_tpl_vars['FULL']): ?>
<nobr><?php echo $this->_tpl_vars['elem']; ?>
</nobr>
		<?php else: ?>
<nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['elem'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "", false) : smarty_modifier_truncate($_tmp, 10, "", false)); ?>
</nobr>
		<?php endif; ?>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['obshto'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['neizra'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['izravn'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][1][0])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_stcell.tpl", 'smarty_include_vars' => array('VALUE' => $this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][1][1])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<font color=red>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_percent.tpl", 'smarty_include_vars' => array('P1' => $this->_tpl_vars['izravn'],'P2' => $this->_tpl_vars['obshto'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</font>
				<td class="<?php echo $this->_tpl_vars['stdata']; ?>
" align=right>
<font color=red>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_percent.tpl", 'smarty_include_vars' => array('P1' => $this->_tpl_vars['LIS2'][$this->_tpl_vars['userid']][1][1],'P2' => $this->_tpl_vars['izravn'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</font>
		<?php endforeach; endif; unset($_from); ?>
				</table>
						</table>
						