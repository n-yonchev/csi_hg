<?php /* Smarty version 2.6.9, created on 2020-03-04 17:43:08
         compiled from traniban.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'traniban.ajax.tpl', 7, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "корекция на сметка за превод",'WIDTH' => 360)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

										<?php if ($this->_tpl_vars['CONF']): ?>

Сумата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARDATA']['amount'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> ще бъдe преведена 
				<?php if ($this->_tpl_vars['ARDATA']['idclaimer'] <= 0): ?>
				<?php else: ?>
<br>
на взискател <b><?php echo $this->_tpl_vars['CLAINAME']; ?>
</b>
				<?php endif; ?>
<br>
по сметка <b><?php echo $_POST['iban']; ?>
</b>
<br>
в банка <b><?php echo $this->_tpl_vars['NEWBANK']; ?>
</b>
<br>
<br>
ОБАЧЕ 
<br>
Тази сметка се различава от <?php if (empty ( $this->_tpl_vars['CLAIIBAN'] )): ?>празната сметка<?php else: ?>сметката <b><?php echo $this->_tpl_vars['CLAIIBAN']; ?>
</b><br>в банка <b><?php echo $this->_tpl_vars['OLDBANK']; ?>
</b><?php endif; ?>
<br>
записана в данните на взискателя.
<br>
<br>
АКО ПОТВЪРДИТЕ,
<br>
сметката за превода <b><?php echo $_POST['iban']; ?>
</b>
<br>
в банка <b><?php echo $this->_tpl_vars['NEWBANK']; ?>
</b>
<br>
ще бъде записана като сметка на взискателя.
<br>
<br>
<input type=hidden name="iban" id="iban" value="<?php echo $_POST['iban']; ?>
">
<input type=hidden name="bic" id="bic" value="<?php echo $_POST['bic']; ?>
">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'да','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'отказ','NAME' => 'submno','ID' => 'submno')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

										<?php else: ?>

<br>
Сумата <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARDATA']['amount'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b> ще бъдe преведена 
				<?php if ($this->_tpl_vars['ARDATA']['idclaimer'] <= 0): ?>
				<?php else: ?>
<br>
на взискател <b><?php echo $this->_tpl_vars['CLAINAME']; ?>
</b>
				<?php endif; ?>
по сметка
<br>
IBAN
<br>
<input type="text" name="iban" id="iban" size=30 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'iban','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		<?php if ($this->_tpl_vars['ISPOSTBANK']): ?>
<br>
банка
<br>
<input disabled type="text" name="bankname" id="bankname" size=100 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'bankname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		<?php else: ?>
		<?php endif; ?>
				<?php if (isset ( $this->_tpl_vars['ARIBAN'] )): ?>
<br>
<br>
<style>
.iban {font:normal 8pt verdana;}
.ibhe {background-color:khaki;}
.note {color:red;}
</style>
		<table>
		<tr>
<td class="iban ibhe" colspan=3> сметки за връщане на длъжници
<?php $_from = $this->_tpl_vars['ARIBAN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<tr>
<td class="iban"> <?php echo $this->_tpl_vars['elem']['name']; ?>

<td width=20>
			<?php if (empty ( $this->_tpl_vars['elem']['iban'] )): ?>
<td class="iban note"> липсва
			<?php else: ?>
<td class="iban"> <b><?php echo $this->_tpl_vars['elem']['iban']; ?>
</b>
			<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		</table>
				<?php else: ?>
				<?php endif; ?>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

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