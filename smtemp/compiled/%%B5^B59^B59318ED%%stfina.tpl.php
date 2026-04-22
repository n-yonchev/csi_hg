<?php /* Smarty version 2.6.9, created on 2025-04-11 16:19:06
         compiled from stfina.tpl */ ?>
										<?php if ($this->_tpl_vars['FLPRIN']): ?>
										<?php else: ?>
<a class="<?php if ($this->_tpl_vars['TYPE'] == 'count'): ?>curr<?php else:  endif; ?>" href="<?php echo $this->_tpl_vars['ARLINK']['count']; ?>
">броя</a>
&nbsp;
<a class="<?php if ($this->_tpl_vars['TYPE'] == 'amount'): ?>curr<?php else:  endif; ?>" href="<?php echo $this->_tpl_vars['ARLINK']['amount']; ?>
">лева</a>
&nbsp;
<a class="" href="#" onclick="fuprin('<?php echo $this->_tpl_vars['CURINT']; ?>
');">изход в Excel</a>
										<?php endif; ?>
										<?php if ($this->_tpl_vars['FLPRIN']): ?>
<style>
td {font: normal 8pt verdana;}
.hetext {background-color:#d0d0d0; text-align:center;}
.hesuma {background-color:#d0d0d0;}
</style>
								<?php $this->assign('bord', "border=1"); ?>		
										<?php else: ?>
<style>
.hesuma {background-color:#add8e6; font: normal 8pt verdana;}
</style>
										<?php endif; ?>

					<table>
					<tr>
					<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "stfinacolo.tpl", 'smarty_include_vars' => array('LIS1' => $this->_tpl_vars['DATA'],'LIS2' => $this->_tpl_vars['DATAUSER'],'TEX1' => "постъпленията",'TEX2' => "",'FULL' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<td valign=top>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "stfinacolo.tpl", 'smarty_include_vars' => array('LIS1' => $this->_tpl_vars['DATABANK'],'LIS2' => $this->_tpl_vars['DATAUSERBANK'],'TEX1' => "БАНКОВИТЕ постъпления",'TEX2' => "БАНКОВИ",'FULL' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</table>

										<?php if ($this->_tpl_vars['FLPRIN']): ?>
										<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_download.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										<?php endif; ?>