<?php /* Smarty version 2.6.9, created on 2020-02-28 11:27:27
         compiled from case3list.tpl */ ?>
					<?php if (count ( $this->_tpl_vars['LIST'] ) == 0): ?>
-
					<?php else: ?>
			<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<?php if (0): ?>
		<?php elseif ($this->_tpl_vars['elem']['idtype'] == 1): ?>
<span class="membtype">‏כ</span> <font color=blue><b><?php echo $this->_tpl_vars['elem']['bulstat']; ?>
</b></font> <?php echo $this->_tpl_vars['elem']['name']; ?>

		<?php elseif ($this->_tpl_vars['elem']['idtype'] == 2): ?>
<span class="membtype">פכ</span> <font color=blue><b><?php echo $this->_tpl_vars['elem']['egn']; ?>
</b></font> <?php echo $this->_tpl_vars['elem']['name']; ?>

		<?php else: ?>
<span class="membtype">הנ</span> <?php echo $this->_tpl_vars['elem']['name']; ?>

		<?php endif; ?>
<br>
			<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>