<?php /* Smarty version 2.6.9, created on 2022-06-21 15:55:39
         compiled from abetprnt.tpl */ ?>

	<table align="center">

	<tr>
<td colspan="5"><font size=+1><b>
АЗБУЧНИК ЗА <?php echo $this->_tpl_vars['YEAR']; ?>
 ГОД.
</font></b>
</td>
								<?php $this->assign('firstletter', ""); ?>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
								<?php if ($this->_tpl_vars['elem']['lett'] == $this->_tpl_vars['firstletter']): ?>
								<?php else: ?>
	<tr>
<td bgcolor="silver" colspan="5"><font size=+1><b>
имена с буква "<?php echo $this->_tpl_vars['elem']['lett']; ?>
"
</font></b>
</td>
	</tr>
	<tr>	
<td bgcolor="silver"> име </td>
<td bgcolor="silver"> тип </td>
<td bgcolor="silver"> ЕГН/булстат </td>
<td bgcolor="silver"> адрес </td>
<td bgcolor="silver"> роля </td>
	</tr>
									<?php $this->assign('firstletter', $this->_tpl_vars['elem']['lett']); ?>
								<?php endif; ?>
	<tr>	
<td valign=top> <?php echo $this->_tpl_vars['elem']['text']; ?>

					<?php if ($this->_tpl_vars['elem']['type'] == 1): ?>
						<?php $this->assign('txtype', "юл"); ?>
					<?php elseif ($this->_tpl_vars['elem']['type'] == 2): ?>
						<?php $this->assign('txtype', "фл"); ?>
					<?php else: ?>
						<?php $this->assign('txtype', "друго"); ?>
					<?php endif; ?>
<td valign=top> <?php echo $this->_tpl_vars['txtype']; ?>

<td valign=top> <?php echo $this->_tpl_vars['elem']['iden']; ?>
 &nbsp;
<td valign=top> 
					<?php if (count ( $this->_tpl_vars['elem']['addr'] ) == 0): ?>
&nbsp;
					<?php else: ?>
		<?php $_from = $this->_tpl_vars['elem']['addr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elemaddr']):
 echo $this->_tpl_vars['elemaddr']; ?>

<br>
		<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
<td valign=top>
					<?php if (count ( $this->_tpl_vars['elem']['suit'] ) == 0): ?>
&nbsp;
					<?php else: ?>
		<?php $_from = $this->_tpl_vars['elem']['suit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elemsuit']):
 if ($this->_tpl_vars['elemsuit']['role'] == 1): ?>взиск.<?php else: ?>длъжник<?php endif; ?> <?php echo $this->_tpl_vars['elemsuit']['seri']; ?>
/<?php echo $this->_tpl_vars['elemsuit']['year']; ?>

<br>
		<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
	</tr>
		<?php endforeach; endif; unset($_from); ?>

	</table>