<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:58
         compiled from tranpack.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'tranpack.tpl', 97, false),array('modifier', 'tomo3', 'tranpack.tpl', 146, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.pa0 {background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][0]; ?>
;}
.pa1 {background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][1]; ?>
;}
.pa2 {background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][2]; ?>
;}
.to0 {background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][0]; ?>
;cursor:pointer;}
.to1 {background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][1]; ?>
;cursor:pointer;}
.to2 {background-color:<?php echo $this->_tpl_vars['ARPACKCOLO'][2]; ?>
;cursor:pointer;}
</style>
					<table class="tab2" cellspacing='0' cellpadding='2' align=center>
					<tr class='head1'>
<td colspan='200'>списък на пакетите с преводи
					<tr class='head2'>
<td colspan=7 align=center style="font-size:7pt;"> описание на пакета
<td colspan=5 align=center style="font-size:7pt;"> съдържание на пакета
<td colspan=3 align=center style="font-size:7pt;"> файлове
					<tr class='head2'>
<td colspan=3 align=center> номер
<td> статус
<td colspan=2> създаден
<td> банка
<td> общ<br>брой<br>преводи
<td align=center> номера описи
<td> прев<br>извън<br>описи
<td> брой<br>пре<br>води
<td> обща<br>сума
<td> файл
<td> 
<td align=center> описи

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php $this->assign('txstat', $this->_tpl_vars['ARPACKTEXT'][$this->_tpl_vars['elem']['idstat']]); ?>
									<?php $this->assign('padata', $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']]); ?>
					<?php if ($this->_tpl_vars['elem']['idstat'] == 0): ?>
<td align=center class="pa<?php echo $this->_tpl_vars['elem']['idstat']; ?>
">&nbsp;<?php echo $this->_tpl_vars['elem']['id']; ?>
&nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 1): ?>
<td align=center>
<span class="to0" title="активирай" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tostat0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>><sup>&nbsp;&nbsp;&nbsp;</sup></span>
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 2): ?>
<td> &nbsp;
					<?php else: ?>
<td> ??????
					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']['idstat'] == 0): ?>
						<?php if ($this->_tpl_vars['padata']['coun'] == 0): ?>
<td>&nbsp;
						<?php else: ?>
<td align=center>
<span class="to1" title="заключи" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tostat1'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>><sup>&nbsp;&nbsp;&nbsp;</sup></span>
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 1): ?>
<td align=center class="pa<?php echo $this->_tpl_vars['elem']['idstat']; ?>
">&nbsp;<?php echo $this->_tpl_vars['elem']['id']; ?>
&nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 2): ?>
<td align=center>
<span class="to1" title="маркирай като заключен" onclick="goto1(<?php echo $this->_tpl_vars['elem']['id']; ?>
,'<?php echo $this->_tpl_vars['elem']['tostat1']; ?>
','<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>
'); return false;">
<sup>&nbsp;&nbsp;&nbsp;</sup></span>
					<?php else: ?>
<td> ??????
					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']['idstat'] == 0): ?>
<td> &nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 1): ?>
						<?php if ($this->_tpl_vars['padata']['coun'] == 0): ?>
<td>&nbsp;
						<?php else: ?>
<td align=center>
<span class="to2" title="маркирай като приключен" onclick="goto2(<?php echo $this->_tpl_vars['elem']['id']; ?>
,'<?php echo $this->_tpl_vars['elem']['tostat2']; ?>
','<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>
'); return false;">
<sup>&nbsp;&nbsp;&nbsp;</sup></span>
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 2): ?>
<td align=center class="pa<?php echo $this->_tpl_vars['elem']['idstat']; ?>
">&nbsp;<?php echo $this->_tpl_vars['elem']['id']; ?>
&nbsp;
					<?php else: ?>
<td> ??????
					<?php endif; ?>



<td> <?php echo $this->_tpl_vars['txstat']; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 
<td> <?php echo $this->_tpl_vars['elem']['usernamepack']; ?>

<td> <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>
 <?php if ($this->_tpl_vars['elem']['code'] == $this->_tpl_vars['CODEBANKPOST']): ?>/бюджетен<?php else:  endif; ?>
		<?php if ($this->_tpl_vars['padata']['coun'] == 0): ?>
<td>&nbsp;
		<?php else: ?>
<td align=center> <?php echo $this->_tpl_vars['padata']['coun']; ?>

		<?php endif; ?>
<td> 
		<?php if (count ( $this->_tpl_vars['ARINVE'][$this->_tpl_vars['elem']['id']] ) == 0): ?>
&nbsp;
		<?php else: ?>
				<?php $_from = $this->_tpl_vars['ARINVE'][$this->_tpl_vars['elem']['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idinve'] => $this->_tpl_vars['inveelem']):
?>
<nobr>
&nbsp;
<span class="toin" style="background-color:wheat" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['inveelem']['view'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
title="виж <?php echo $this->_tpl_vars['inveelem']['coun']; ?>
 превода от описа за &quot;<?php echo $this->_tpl_vars['inveelem']['accodesc']; ?>
&quot;"> 
<?php echo $this->_tpl_vars['idinve']; ?>
 
</span>
</nobr>
				<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
							<?php $this->assign('oudata', $this->_tpl_vars['ARCOUN2'][$this->_tpl_vars['elem']['id']]); ?>
		<?php if ($this->_tpl_vars['oudata']['coun'] == 0): ?>
<td>&nbsp;
		<?php else: ?>
<td align=center bgcolor=wheat style="cursor:pointer;" title="виж преводите"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARLINK2'][$this->_tpl_vars['elem']['id']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['oudata']['coun']; ?>

		<?php endif; ?>
<td align=center> <?php echo $this->_tpl_vars['padata']['countota']; ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['padata']['sumatota'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>


					<?php if ($this->_tpl_vars['elem']['idstat'] == 0 || $this->_tpl_vars['padata']['coun'] == 0): ?>
<td> &nbsp;
					<?php else: ?>
<td align=center bgcolor=wheat style="cursor:pointer;" title="генерирай файла за банката" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['filegene'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>">
<?php echo $this->_tpl_vars['ARBANKPAYMSUFF'][$this->_tpl_vars['elem']['idbank']]; ?>

					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']['idstat'] == 0 || $this->_tpl_vars['padata']['coun'] == 0): ?>
<td> &nbsp;
					<?php else: ?>
<td align=center>
<img src="images/print.gif" title="отпечати всички преводи от пакета" style="cursor:pointer" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['linkprnt']; ?>
');">
					<?php endif; ?>
<td>
					<?php if ($this->_tpl_vars['elem']['idstat'] == 0 || $this->_tpl_vars['padata']['coun'] == 0): ?>
					<?php else: ?>
		<?php if (count ( $this->_tpl_vars['ARINVE'][$this->_tpl_vars['elem']['id']] ) == 0): ?>
&nbsp;
		<?php else: ?>
				<?php $_from = $this->_tpl_vars['ARINVE'][$this->_tpl_vars['elem']['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idinve'] => $this->_tpl_vars['inveelem']):
?>
<nobr>
&nbsp;
<span style="cursor:pointer" onclick="fuprin('<?php echo $this->_tpl_vars['inveelem']['gene']; ?>
'); return false;"
title="генерирай документ по опис <?php echo $this->_tpl_vars['idinve']; ?>
 за &quot;<?php echo $this->_tpl_vars['inveelem']['accodesc']; ?>
&quot;"> 
<?php echo $this->_tpl_vars['idinve']; ?>
<img src="images/excel.gif"> 
</span>
</nobr>
				<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
					<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					</table>

<script>
function goto1(paid,link,bank){
	if(confirm(
"ВНИМАНИЕ."
+"\\n\\nДосегашния статус на пакет #"+paid+" като ПРИКЛЮЧЕН означаваше,"
+"\\nче всички преводи и описи, включени в него,"
+"\\nса ПРИЕТИ УСПЕШНО от електронното банкиране на банка "+bank
+"\\nи се считаха за ПРИКЛЮЧЕНИ."
+"\\n\\nНовото състояние на пакета като ЗАКЛЮЧЕН"
+"\\nдава възможност да се промени в АКТИВЕН,"
+"\\nслед което от него да бъдат изключени преводи и описи"
+"\\nили към него да се включат нови преводи и описи."
+"\\n\\nПреценете ВНИМАТЕЛНО кои точно преводи и описи от пакета"
+"\\nса ПРИЕТИ УСПЕШНО от електронното банкиране на банка "+bank
+"\\n\\nПотвърди или Откажи маркирането на пакета като ЗАКЛЮЧЕН"
	)) window.location.href=link;
}
function goto2(paid,link,bank){
	if(confirm(
"ВНИМАНИЕ."
+"\\n\\nМаркирането на пакет #"+paid+" като ПРИКЛЮЧЕН означава,"
+"\\nче всички преводи и описи, включени в него,"
+"\\nса ПРИЕТИ УСПЕШНО от електронното банкиране на банка "+bank
+"\\nи ще се считат за ПРИКЛЮЧЕНИ."
+"\\n\\nПотвърди или Откажи"
	)) window.location.href=link;
}
</script>