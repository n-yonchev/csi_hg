<?php /* Smarty version 2.6.9, created on 2022-06-14 15:11:47
         compiled from rep2tran2list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'rep2tran2list.tpl', 34, false),array('modifier', 'tointe', 'rep2tran2list.tpl', 56, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.link {background-color:khaki;cursor:pointer;}
.link2 {background-color:gold;cursor:pointer;}
body {margin-left:10px; margin-right:10px;}
</style>
															
															<table align=center>
															<tr>
															<td>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> назад към списъка трансформации </a>
															
															<tr>
															<td>
															
				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head2'>
<td colspan=20> списък дела на взискател <b><?php echo $this->_tpl_vars['NAME']; ?>
</b> и ред за отчета <b><?php echo $this->_tpl_vars['ARREPO'][$this->_tpl_vars['IDRE']]; ?>
</b>
				<tr class='head2'>
<td> дело
<td> деловодител
<td> статус
<td> образувано
<td> идва от
<td> описание
<td> взискатели
<td> длъжници
<?php $_from = $this->_tpl_vars['ARCASE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['indx'] => $this->_tpl_vars['elem']):
?>
				<tr onmouseover="this.style.backgroundColor='#dddddd';" onmouseout="this.style.backgroundColor='';">
<td class="link" title="виж делото" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['edit']; ?>
';return false;"> <?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>

<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

<td> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['elem']['idstat']]; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['timestat'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['casedate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td> <?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['elem']['casefrom']]; ?>

<td> <?php echo $this->_tpl_vars['elem']['casetext']; ?>

<td>
			<?php $this->assign('idcase', $this->_tpl_vars['elem']['idcase']); ?>
					<?php $_from = $this->_tpl_vars['LISTCLAI'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['memb']):
?>
<?php if ($this->_tpl_vars['memb']['idtype'] == 1): ?>юл<?php elseif ($this->_tpl_vars['memb']['idtype'] == 2): ?>фл<?php else: ?>др<?php endif; ?> <?php echo $this->_tpl_vars['memb']['name']; ?>

<br>
					<?php endforeach; endif; unset($_from); ?>
<td>
					<?php $_from = $this->_tpl_vars['LISTDEBT'][$this->_tpl_vars['idcase']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['memb']):
?>
<?php if ($this->_tpl_vars['memb']['idtype'] == 1): ?>юл<?php elseif ($this->_tpl_vars['memb']['idtype'] == 2): ?>фл<?php else: ?>др<?php endif; ?> <?php echo $this->_tpl_vars['memb']['name']; ?>

<br>
					<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>
				
				<?php if (! empty ( $this->_tpl_vars['ARCASE'] ) && isset ( $this->_tpl_vars['ARLINK'] )): ?>
															<tr>
															<td style="font: normal 10pt verdana;">
за всичките <?php echo ((is_array($_tmp=$this->_tpl_vars['PAGIPARA']['TOTREC'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>
 дела от списъка промени текущия ред за отчета в нов, <br>който да е 
<br>
<?php $_from = $this->_tpl_vars['ARLINK']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['newrepo'] => $this->_tpl_vars['elem']):
?>
	<div class="link2" style="float:left;padding:1px 10px;border:1px solid red;" 
	onclick="document.location.href='<?php echo $this->_tpl_vars['elem']; ?>
';return false;"><?php echo $this->_tpl_vars['ARREPO'][$this->_tpl_vars['newrepo']]; ?>
</div>
	<div style="float:left;">&nbsp;&nbsp;</div>
<?php endforeach; endif; unset($_from); ?>
				<?php else: ?>
				<?php endif; ?>
															</table>
