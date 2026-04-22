<?php /* Smarty version 2.6.9, created on 2020-02-27 15:24:51
         compiled from cazo2at2.inc.tpl */ ?>
<style>
.t2grou {background-color:beige;padding:1pt 14pt;}
.t2elem {font: normal 8pt verdana;}
</style>
										<table align=center style="border:1px solid black;padding:6px;" cellspacing=0 cellpadding=0>
<?php $_from = $this->_tpl_vars['ARSU2TYPE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t2code'] => $this->_tpl_vars['t2text']):
?>
					<tr>
			<?php if (is_int ( $this->_tpl_vars['t2code'] )): ?>
<td class="t2elem">
<input type="radio" name="idt2" id="t2<?php echo $this->_tpl_vars['t2code']; ?>
" value="<?php echo $this->_tpl_vars['t2code']; ?>
" label="<?php echo $this->_tpl_vars['t2text']; ?>
">
			<?php else: ?>
<td class="t2grou t2elem">
<?php echo $this->_tpl_vars['t2text']; ?>

			<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
					</table>