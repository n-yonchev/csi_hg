<?php /* Smarty version 2.6.9, created on 2020-11-16 17:05:53
         compiled from rep2v1.tpl */ ?>

<style>
.mark {font: bold 14pt verdana;}
</style>
<br>
<center>
			<?php if ($this->_tpl_vars['NODISPLAY']): ?>
<b>ОНВЮЙЮИ......</b>
			<?php else: ?>
				<?php if ($this->_tpl_vars['ISEND']): ?>
<b>ондцнрнбйюрю опхйкчвх</b>
				<?php else: ?>
					<?php if (isset ( $this->_tpl_vars['GROU'] )): ?>
ярзойю <span class="mark"><?php echo $this->_tpl_vars['STEP']; ?>
</span>&nbsp;&nbsp;&nbsp; цпсою <span class="mark"><?php echo $this->_tpl_vars['GROU']; ?>
</span>
					<?php else: ?>
ярзойю <span class="mark"><?php echo $this->_tpl_vars['STEP']; ?>
</span>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
</center>
<br> &nbsp;
				<?php if (! $this->_tpl_vars['ISEND'] && isset ( $this->_tpl_vars['NEXTURL'] )): ?>
<script>
document.location.href="<?php echo $this->_tpl_vars['NEXTURL']; ?>
";
</script>
				<?php else: ?>
				<?php endif; ?>
	