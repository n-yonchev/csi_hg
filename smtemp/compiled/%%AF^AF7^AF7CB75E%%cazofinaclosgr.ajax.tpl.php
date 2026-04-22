<?php /* Smarty version 2.6.9, created on 2023-04-04 14:57:12
         compiled from cazofinaclosgr.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo3', 'cazofinaclosgr.ajax.tpl', 17, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "групово приключване на постъпления")));
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
В момента делото е отворено от <?php echo $this->_tpl_vars['LOCKNAME']; ?>
, поради което постъпленията не може да бъдат приключени.
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
сума <font size=+1><b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUMA'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b></font> от <?php echo $this->_tpl_vars['COUN']; ?>
 постъпления
<br>
<br>
ВНИМАНИЕ.
<br>
<nobr>
Приключването означава, че разпределените суми са преведени на взискателите.
</nobr>
<br>
След приключването няма да може да променяте данните за тези постъпления.
<br>
<br>
							<?php if (empty ( $this->_tpl_vars['LOCKNAME'] )): ?>
дата за погасяване за всичките <?php echo $this->_tpl_vars['COUN']; ?>
 постъпления
<br>
<input type="text" name="datebala" id="datebala" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'datebala','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
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
Може да приключите тези постъпления само след като <?php echo $this->_tpl_vars['LOCKNAME']; ?>
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