<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from deliinfo.ajax.tpl */ ?>
<td align=left>
<nobr>
							<?php $this->assign('ardata', $this->_tpl_vars['ARDELI'][$this->_tpl_vars['iddocu']]); ?>
							<?php $this->assign('armeth', $this->_tpl_vars['ARDELIMETH'][$this->_tpl_vars['iddocu']]); ?>
		<?php if (isset ( $this->_tpl_vars['ardata'] )): ?>
			<?php if ($this->_tpl_vars['armeth'] == -1): ?>
			<?php else: ?>
<?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['armeth']]; ?>

			<?php endif; ?>
					<?php if ($this->_tpl_vars['ARDELINODA'][$this->_tpl_vars['iddocu']] == 0): ?>
					<?php else: ?>
<span style="background-color:violet;padding:2px 6px 2px 6px;">
					<?php endif; ?>
<sub>
<img src="images/view.png" class="deliinfo" style="cursor:help;" 
rel="deliinfo.ajax.php?p=<?php echo $this->_tpl_vars['iddocu']; ?>
" title="информация за връчване на изх.док.<?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
">
</sub>
					<?php if ($this->_tpl_vars['ARDELINODA'][$this->_tpl_vars['iddocu']] == 0): ?>
					<?php else: ?>
</span>
					<?php endif; ?>
		<?php else: ?>
-
		<?php endif; ?>
</nobr>