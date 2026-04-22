<?php /* Smarty version 2.6.9, created on 2020-03-04 15:12:19
         compiled from traninve.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'traninve.tpl', 76, false),array('modifier', 'tomo3', 'traninve.tpl', 87, false),)), $this); ?>
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
<td colspan='200'>списък на описите с преводи
					<tr class='head2'>
<td colspan=3 align=center> номер
<td> статус
<td colspan=2> създаден
<td> описание
<td> банка
<td> iban
<td> брой<br>прев
<td align=right> сума
<td colspan=3 align=center> включен в пакет
<td> включи към пакет

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php $this->assign('txstatinve', $this->_tpl_vars['ARPACKTEXT'][$this->_tpl_vars['elem']['idstatinve']]); ?>
									<?php $this->assign('sudata', $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']]); ?>
					<?php if ($this->_tpl_vars['elem']['idstatinve'] == 0): ?>
<td align=center class="pa<?php echo $this->_tpl_vars['elem']['idstatinve']; ?>
">&nbsp;<?php echo $this->_tpl_vars['elem']['id']; ?>
&nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstatinve'] == 1): ?>
						<?php if ($this->_tpl_vars['elem']['idstat'] == 0): ?>
<td align=center>
<span class="to0" title="активирай" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tostat0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>><sup>&nbsp;&nbsp;&nbsp;</sup></span>
						<?php else: ?>
<td> &nbsp;
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['elem']['idstatinve'] == 2): ?>
<td> &nbsp;
					<?php else: ?>
<td> ??????
					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']['idstatinve'] == 0): ?>
						<?php if ($this->_tpl_vars['sudata']['coun'] == 0): ?>
<td>&nbsp;
						<?php else: ?>
<td align=center>
<span class="to1" title="заключи" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tostat1'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>><sup>&nbsp;&nbsp;&nbsp;</sup></span>
						<?php endif; ?>
					<?php elseif ($this->_tpl_vars['elem']['idstatinve'] == 1): ?>
<td align=center class="pa<?php echo $this->_tpl_vars['elem']['idstatinve']; ?>
">&nbsp;<?php echo $this->_tpl_vars['elem']['id']; ?>
&nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstatinve'] == 2): ?>
<td> &nbsp;
					<?php else: ?>
<td> ??????
					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']['idstatinve'] == 0): ?>
<td> &nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstatinve'] == 1): ?>
<td> &nbsp;
					<?php elseif ($this->_tpl_vars['elem']['idstatinve'] == 2): ?>
<td align=center class="pa<?php echo $this->_tpl_vars['elem']['idstatinve']; ?>
">&nbsp;<?php echo $this->_tpl_vars['elem']['id']; ?>
&nbsp;
					<?php else: ?>
<td> ??????
					<?php endif; ?>
<td> <?php echo $this->_tpl_vars['txstatinve']; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 
<td> <?php echo $this->_tpl_vars['elem']['usernameinve']; ?>

<td> <?php echo $this->_tpl_vars['elem']['desc']; ?>

<td> <?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>

<td> <?php echo $this->_tpl_vars['elem']['iban']; ?>

		<?php if ($this->_tpl_vars['sudata']['coun'] == 0): ?>
<td>&nbsp;
		<?php else: ?>
<td align=center bgcolor=wheat style="cursor:pointer;" title="виж преводите"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['view'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['sudata']['coun']; ?>

		<?php endif; ?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['sudata']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>

					<?php if ($this->_tpl_vars['elem']['idpack'] == 0): ?>
<td align=center> не
									<?php $this->assign('txstat', ""); ?>
					<?php else: ?>
									<?php $this->assign('txstat', $this->_tpl_vars['ARPACKTEXT'][$this->_tpl_vars['elem']['idstat']]); ?>
<td align=center bgcolor="<?php echo $this->_tpl_vars['ARPACKCOLO'][$this->_tpl_vars['elem']['idstat']]; ?>
" title="<?php echo $this->_tpl_vars['txstat']; ?>
">
<?php echo $this->_tpl_vars['elem']['idpack']; ?>

					<?php endif; ?>
<td> <?php echo $this->_tpl_vars['txstat']; ?>
 &nbsp;
<td> 
			<?php if ($this->_tpl_vars['elem']['idpack'] == 0): ?>
&nbsp;
			<?php else: ?>
				<?php if ($this->_tpl_vars['elem']['idstat'] == 0): ?>
<img src="images/exclude.gif" style="cursor:pointer;" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['exde'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="изключи описа от пакета"> 
				<?php else: ?>
&nbsp;
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['elem']['idpack'] == 0): ?>
<td>
								<?php if ($this->_tpl_vars['elem']['idstatinve'] == 1 && $this->_tpl_vars['sudata']['coun'] <> 0 && isset ( $this->_tpl_vars['ARPACKLINK'][$this->_tpl_vars['elem']['id']] )): ?>
				<?php $_from = $this->_tpl_vars['ARPACKLINK'][$this->_tpl_vars['elem']['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
&nbsp;
					<?php if ($this->_tpl_vars['ekey'] == 0): ?>
<span class="toin" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
нов </span>
					<?php else: ?>
<span class="toin" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> title="<?php echo $this->_tpl_vars['ARBANKPAYM'][$this->_tpl_vars['elem']['idbank']]; ?>
 <?php if (isset ( $this->_tpl_vars['elem']['coun'] )):  echo $this->_tpl_vars['elem']['coun'];  else: ?>0<?php endif; ?> превода"> 
<?php echo $this->_tpl_vars['ekey']; ?>
 </span>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
						<?php if (isset ( $this->_tpl_vars['PACKER'] )): ?>
&nbsp;&nbsp;
<font color=red><?php echo $this->_tpl_vars['PACKER']; ?>
</font>
						<?php else: ?>
						<?php endif; ?>
								<?php else: ?>
&nbsp;
								<?php endif; ?>
			<?php else: ?>
<td>&nbsp;
			<?php endif; ?>




<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					</table>