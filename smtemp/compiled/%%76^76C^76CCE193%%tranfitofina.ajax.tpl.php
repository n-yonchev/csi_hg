<?php /* Smarty version 2.6.9, created on 2020-03-04 17:09:32
         compiled from tranfitofina.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'tranfitofina.ajax.tpl', 18, false),array('modifier', 'cat', 'tranfitofina.ajax.tpl', 22, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "изключване постъпление от списъка преводи",'WITDH' => 840)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
td {font:normal 8pt verdana;border-bottom: 1px solid silver;}
.pseu {font: normal 8pt verdana; color:red;}
</style>

		<table>
		<tr bgcolor=silver>
<td colspan=10> постъпление
		<tr bgcolor=silver>
<td align=right> сума
<td> от къде
<td> кога
<td> длъжник
		<tr>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['DATAFINA']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

				<?php $this->assign('idtype', $this->_tpl_vars['DATAFINA']['idtype']); ?>
				<?php $this->assign('bankname', $this->_tpl_vars['ARBANK'][$this->_tpl_vars['DATAFINA']['codebank']]); ?>
				<?php if ($this->_tpl_vars['idtype'] == 1): ?>
					<?php $this->assign('finaba', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="/")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['DATAFINA']['idfinabank']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['DATAFINA']['idfinabank'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "-") : smarty_modifier_cat($_tmp, "-")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['bankname']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['bankname']))); ?>
				<?php else: ?>
					<?php $this->assign('finaba', ""); ?>
				<?php endif; ?>
				<?php $this->assign('debtdata', $this->_tpl_vars['DEBTLIST'][$this->_tpl_vars['elem']['iddebtor']]); ?>
<td> <nobr><?php echo ((is_array($_tmp=$this->_tpl_vars['ARTYPE'][$this->_tpl_vars['idtype']])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['finaba']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['finaba'])); ?>
</nobr>
<td>
						<?php if ($this->_tpl_vars['idtype'] == 1): ?>
<nobr><?php echo $this->_tpl_vars['DATAFINA']['finadate']; ?>
 <?php echo $this->_tpl_vars['DATAFINA']['finahour']; ?>
</nobr>
						<?php elseif ($this->_tpl_vars['idtype'] == 2): ?>
<nobr><?php echo $this->_tpl_vars['DATAFINA']['cashdate']; ?>
</nobr>
						<?php else: ?>
&nbsp;
						<?php endif; ?>
<td> <?php echo $this->_tpl_vars['DEBTNAME']; ?>
&nbsp;
		</table>

		<table>
		<tr bgcolor=silver>
<td colspan=10> разпределения
		<tr bgcolor=silver>
<td align=right> разпред<br>сума
<td> за взискател
<td> сума<br>за превод
<td> от банка
<td> опис
<td> пакет
<td> ръчен
<?php $_from = $this->_tpl_vars['ARTRAN'][$this->_tpl_vars['TOFINA']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['elem']):
?>
								<tr>
<td class="trow" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

			<?php if ($this->_tpl_vars['idclai'] <= 0 && $this->_tpl_vars['idclai'] <> -1): ?>
<td class="trow pseu" > <?php echo $this->_tpl_vars['elem']['clainame']; ?>
&nbsp;
			<?php else: ?>
<td class="trow"> <?php echo $this->_tpl_vars['elem']['clainame']; ?>

			<?php endif; ?>
<td class="trow" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['amount'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td class="trow"> <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>

						<?php if ($this->_tpl_vars['elem']['idinve'] == 0): ?>
<td bgcolor=#dddddd>&nbsp;
						<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idinvestat']]; ?>
"> 
<?php echo $this->_tpl_vars['elem']['idinve']; ?>

						<?php endif; ?>
						<?php if ($this->_tpl_vars['elem']['idinve'] == 0): ?>
		<?php if ($this->_tpl_vars['elem']['idpack'] == 0): ?>
<td bgcolor=#dddddd>&nbsp;
		<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idpackstat']]; ?>
"> 
<?php echo $this->_tpl_vars['elem']['idpack']; ?>

		<?php endif; ?>
						<?php else: ?>
		<?php if ($this->_tpl_vars['elem']['idinvepack'] == 0): ?>
<td bgcolor=#dddddd>&nbsp;
		<?php else: ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idinvepackstat']]; ?>
"> 
<?php echo $this->_tpl_vars['elem']['idinvepack']; ?>

		<?php endif; ?>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['elem']['idstat'] == 9): ?>
<td bgcolor=#dddddd> превед
						<?php elseif ($this->_tpl_vars['elem']['idstat'] == 6): ?>
<td bgcolor=#dddddd> отлож
						<?php else: ?>
<td bgcolor=#dddddd>&nbsp;
						<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		</table>

<br>
					<?php if ($this->_tpl_vars['ISEXCLUDE']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'изключи','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
ВНИМАНИЕ.
<br>
НЕ МОЖЕ да изключите разпределенията по това постъпление от списъка с преводи.
За да стане възможно това, е необходимо :
<br>
<br>
- да няма директно преведена сума
<br>
<br>
- всяка от разпределените суми 
<br>
или да не е включена в опис/пакет,
<br>
или да е включена в актуален опис/пакет (зелен)
<br>
<br>
					<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>