<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazobalaproc.tpl */ ?>
				<table cellspacing=0 cellpadding=0">
				<tr>
<td class="tdbalahead" align=right <?php if ($this->_tpl_vars['ACTUDEBT']):  else: ?>width=40<?php endif; ?>> %
	<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claiid'] => $this->_tpl_vars['clainame']):
?>
				<tr>
<td class="tdbala" align=right>
					<?php $this->assign('cont', $this->_tpl_vars['elem'][$this->_tpl_vars['VARI']][$this->_tpl_vars['claiid']]); ?>
					<?php if ($this->_tpl_vars['cont'] < 0 || $this->_tpl_vars['cont'] === "???"): ?>
<span class="red7bg"> <b><?php echo $this->_tpl_vars['cont']; ?>
</b> </span>
					<?php elseif ($this->_tpl_vars['cont'] == 0): ?>
&nbsp;
					<?php else:  echo $this->_tpl_vars['cont']; ?>

					<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
				</table>
				