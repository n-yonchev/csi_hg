<?php /* Smarty version 2.6.9, created on 2020-03-11 08:46:14
         compiled from cazoactuinfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazoactuinfo.tpl', 35, false),array('modifier', 'tomoney2', 'cazoactuinfo.tpl', 55, false),)), $this); ?>
													<?php $this->assign('ACTUDEBT', true); ?>
		<table class="d_table" cellspacing='0' cellpadding='0'>
		<thead>
		<tr class='header'>
<td>дата описание сума</td>
			<td class='sep'>&nbsp;</td>	
<td></td>
<td> движение </td>
<td> актуален дълг </td>
<td> %погас </td>
		</tr>
		</thead>
		<tbody>

		<tr>
		<td colspan='200'>
състояние на дълга
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>

<tr>
<td> 
	<?php if (empty ( $this->_tpl_vars['elem']['date'] )): ?>
<font color=red>няма</font>
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

	<?php endif; ?>
				<?php $this->assign('arindx', $this->_tpl_vars['elem']['oper']); ?>
<br>
<nobr>
&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $this->_tpl_vars['ARBALAOPER'][$this->_tpl_vars['arindx']]; ?>

</nobr>
<br>
<nobr>
&nbsp;&nbsp;&nbsp;&nbsp;
	<?php echo $this->_tpl_vars['elem']['desc']; ?>

			<?php if ($this->_tpl_vars['elem']['desctran']): ?>
&nbsp;<font color="red">без-олихв</font>
			<?php else: ?>
			<?php endif; ?>
</nobr>
<div style="text-align:right;">
<b><?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amou'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b>
</div>
		<td class='sep'>&nbsp;</td>
<td valign=top>
				<table cellspacing=0 cellpadding=0>
				<tr>
<td class="tdbalahead" width=160> направление
	<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claiid'] => $this->_tpl_vars['clainame']):
?>
				<tr>
<td class="tdbala"> <nobr><?php echo $this->_tpl_vars['clainame']; ?>
</nobr>
	<?php endforeach; endif; unset($_from); ?>
				</table>
</td>
						<?php $this->assign('movebg', ""); ?>
						<?php $this->assign('plusbg', ""); ?>
						<?php $this->assign('minubg', ""); ?>
						<?php $this->assign('resubg', ""); ?>
						<?php if ($this->_tpl_vars['elem']['direction'] == "+"): ?>
							<?php $this->assign('movebg', "#f8c4bf"); ?>
							<?php $this->assign('plusbg', "#f8c4bf"); ?>
						<?php else: ?>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['elem']['direction'] == "-"): ?>
							<?php $this->assign('movebg', "#ddffdd"); ?>
							<?php $this->assign('minubg', "#ddffdd"); ?>
						<?php else: ?>
						<?php endif; ?>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastat.tpl", 'smarty_include_vars' => array('VARI' => 'move','BGCO' => $this->_tpl_vars['movebg'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalastat.tpl", 'smarty_include_vars' => array('VARI' => 'resu','BGCO' => $this->_tpl_vars['resubg'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazobalaproc.tpl", 'smarty_include_vars' => array('VARI' => 'percpaid')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
		
		<?php endforeach; endif; unset($_from); ?>

		</tbody>
		</table>


