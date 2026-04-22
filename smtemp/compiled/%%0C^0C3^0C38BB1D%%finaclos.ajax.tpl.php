<?php /* Smarty version 2.6.9, created on 2020-03-02 12:39:14
         compiled from finaclos.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "приключване на постъпление")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

												<?php if ($this->_tpl_vars['NOEF']): ?>
<font color=red>
<br>
ВНИМАНИЕ.
<br>
В момента делото е затворено, поради което това постъпление не може да бъде приключено.
</font>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "document.location.reload();",'TITLE' => 'опитай отново','NAME' => 'again','ID' => 'again')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
												<?php else: ?>
<br>
сума <font size=+1><b><?php echo $this->_tpl_vars['DATA']['inco']; ?>
</b></font>
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
Приключването означава, че разпределените суми са преведени на взискателите.
</nobr>
<br>
След приключването няма да може да променяте данните за това постъпление.
<br>
<br>
							<?php if (empty ( $this->_tpl_vars['LOCKNAME'] )): ?>
дата за погасяването
<br>
<input type="text" name="datebala" id="datebala" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'datebala','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
								<?php if ($this->_tpl_vars['FLAGOLD']): ?>
<br>
дата на приключване - задължителна за старо постъпление
<br>
<input type="text" name="dateclos" id="dateclos" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'dateclos','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
								<?php else: ?>
								<?php endif; ?>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'приключи','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
&nbsp;&nbsp;
							<?php else: ?>
<font color=red>
Може да приключите това постъпление само след като <?php echo $this->_tpl_vars['LOCKNAME']; ?>
 затвори дело <?php echo $this->_tpl_vars['LOCKCASE']; ?>

</font>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "document.location.reload();",'TITLE' => 'опитай отново','NAME' => 'again','ID' => 'again')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php endif; ?>
												<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>