<?php /* Smarty version 2.6.9, created on 2026-03-10 15:40:02
         compiled from cazobase.tpl */ ?>
				<?php if (isset ( $this->_tpl_vars['BASESTATUS'] ) && $this->_tpl_vars['BASESTATUS'] <> ""): ?>
<div class="red7div">
ВНИМАНИЕ.
<br>
В основните данни на това дело има непопълнени ЗАДЪЛЖИТЕЛНИ полета.
<br>
		<?php if ($this->_tpl_vars['BASESTATUS'] == ""): ?>
		<?php elseif ($this->_tpl_vars['BASESTATUS'] == '0'): ?>
Поради изчерпване на лимита
НЯМАТЕ ДОСТЪП ЗА КОРЕКЦИЯ НА ДАННИТЕ ПО ДЕЛОТО.
		<?php elseif ($this->_tpl_vars['BASESTATUS'] == '1'): ?>
Това отваряне е ПОСЛЕДНАТА ВЪЗМОЖНОСТ да попълните тези данни
преди достъпа Ви до делото да бъде ПРЕКРАТЕН.
		<?php else: ?>
Имате право да отваряте това дело още <font size=+1> <?php echo $this->_tpl_vars['BASESTATUS']; ?>
 </font> пъти.
<br>
Ако след това задължителните полета все още са непопълнени,
достъпа Ви до делото ще бъде ПРЕКРАТЕН.
		<?php endif; ?>
</div>
				<?php else: ?>
				<?php endif; ?>

<?php if ($this->_tpl_vars['EPEP_LINK']): ?>
	<div style="color: white; background-color: #2b02a6; padding: 5px 10px; font-size: 14px; font-weight: bold; margin: 5px 0;">
		Делото е свързано с ел. партида!
	</div>
<?php endif; ?>