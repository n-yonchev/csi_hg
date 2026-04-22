<?php /* Smarty version 2.6.9, created on 2020-04-02 19:38:50
         compiled from depuedit.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "заместване")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

							<?php if ($this->_tpl_vars['ACTION']): ?>
<input type=hidden name="iduserdepu">
<b>прехвърляне на дела</b>
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
Всичките <b><?php echo $this->_tpl_vars['COUNORIG']; ?>
 дела</b> на деловодителя <b><?php echo $this->_tpl_vars['NAMEORIG']; ?>
</b>
</nobr>
<br>
<nobr>
ще бъдат прехвърлени на заместника му <b><?php echo $this->_tpl_vars['NAMEDEPU']; ?>
</b>
</nobr>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'прехвърли временно','NAME' => 'submyes','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
с възможност за възстановяване
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'премести постоянно','NAME' => 'submperm','ID' => 'submyes')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
БЕЗ възможност за възстановяване
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'откажи','NAME' => 'submno','ID' => 'submno')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

							<?php else: ?>

избери заместник на деловодителя
<br>
<b><?php echo $this->_tpl_vars['NAMEORIG']; ?>
</b>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARDEPUNAME'],'ID' => 'iduserdepu','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>