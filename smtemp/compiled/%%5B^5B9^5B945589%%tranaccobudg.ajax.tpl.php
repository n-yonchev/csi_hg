<?php /* Smarty version 2.6.9, created on 2020-03-04 16:47:34
         compiled from tranaccobudg.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "състояние на сметка",'WIDTH' => 500)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<?php if (empty ( $this->_tpl_vars['ARDATA'] )): ?>
Сметката IBAN=<b><?php echo $this->_tpl_vars['IBAN']; ?>
</b> BIC=<b><?php echo $this->_tpl_vars['BIC']; ?>
</b> 
<br>
не влиза в списъка на бюджетните сметки.
<br>
<br>
Може да я запишете в списъка като сметка за преводи към бюджета с описание
<input type="text" name="desc" id="desc" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'desc','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
						<?php if ($this->_tpl_vars['ISBUDG']): ?>
Сметката IBAN=<b><?php echo $this->_tpl_vars['IBAN']; ?>
</b> BIC=<b><?php echo $this->_tpl_vars['BIC']; ?>
</b> 
<br>
влиза в списъка на бюджетните сметки с описание <b><?php echo $this->_tpl_vars['ARDATA']['desc']; ?>
</b>
<br>
<br>
Може да я ИЗТРИЕТЕ от списъка на сметките за преводи към бюджета
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'изтрий','NAME' => 'submno','ID' => 'submno')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
Сметката IBAN=<b><?php echo $this->_tpl_vars['IBAN']; ?>
</b> BIC=<b><?php echo $this->_tpl_vars['BIC']; ?>
</b> 
<br>
вече е маркирана като сметка <b><?php echo $this->_tpl_vars['ARACCOTYPE'][$this->_tpl_vars['ARDATA']['code']]; ?>
</b>
<br>
с описание <b><?php echo $this->_tpl_vars['ARDATA']['desc']; ?>
</b>
<br>
<br>
Поради това НЕ МОЖЕ да я запишете в списъка като сметка за преводи към бюджета.
						<?php endif; ?>
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