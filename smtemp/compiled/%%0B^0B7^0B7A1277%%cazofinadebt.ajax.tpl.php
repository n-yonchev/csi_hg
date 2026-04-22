<?php /* Smarty version 2.6.9, created on 2020-04-09 10:50:58
         compiled from cazofinadebt.ajax.tpl */ ?>
			<?php if (isset ( $this->_tpl_vars['EXITCODE'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>

<form name="formdebt" method="post">
				<?php if (isset ( $this->_tpl_vars['ARLIST'] )):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARLIST'],'ID' => 'debtnewid','SIZE' => 6,'C1' => 'input7','ONCH' => "document.forms['formdebt'].submit();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<br> &nbsp;
				<?php else: ?>
???????????????????????
				<?php endif; ?>
</form>

			<?php endif; ?>