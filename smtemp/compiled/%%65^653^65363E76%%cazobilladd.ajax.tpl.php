<?php /* Smarty version 2.6.9, created on 2026-01-03 20:47:27
         compiled from cazobilladd.ajax.tpl */ ?>
			<?php $this->assign('calc', $this->_tpl_vars['ARDEFI']['calc']); ?>
<b> метод : 
			<?php if (0): ?>
			<?php elseif ($this->_tpl_vars['calc'] == 'inpu'): ?>
директно въвеждане
			<?php elseif ($this->_tpl_vars['calc'] == 'fixi'): ?>
фиксирана сума <?php echo $this->_tpl_vars['ARDEFI']['perc']; ?>
 И
			<?php elseif ($this->_tpl_vars['calc'] == 'proc'):  echo $this->_tpl_vars['ARDEFI']['perc']; ?>
 % от мат.интерес 
	<?php if (empty ( $this->_tpl_vars['ARDEFI']['mini'] )): ?>
	<?php else: ?>
минимум= <?php echo $this->_tpl_vars['ARDEFI']['mini']; ?>
 И
	<?php endif; ?>
	<?php if (empty ( $this->_tpl_vars['ARDEFI']['maxi'] )): ?>
	<?php else: ?>
максимум= <?php echo $this->_tpl_vars['ARDEFI']['maxi']; ?>
 И
	<?php endif; ?>
			<?php else: ?>
???????????
			<?php endif; ?>
</b>


					<table>
					<tr>
<td valign=top> 
действие &nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazobiller.tpl", 'smarty_include_vars' => array('CODE' => 'action')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<br>
<textarea name="action" id="action" rows=4 cols=65 size=255 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'notes','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
<td valign=top>
основание &nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazobiller.tpl", 'smarty_include_vars' => array('CODE' => 'ground')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<br>
<input type="text" name="ground" id="ground" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'ground','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
					<tr>
<td>
			<?php if ($this->_tpl_vars['calc'] == 'proc'): ?>
мат.интерес &nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazobiller.tpl", 'smarty_include_vars' => array('CODE' => 'interest')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<input type="text" name="interest" id="interest" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'interest','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			<?php else: ?>
сума &nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazobiller.tpl", 'smarty_include_vars' => array('CODE' => 'amount')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<input type="text" name="amount" id="amount" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'amount','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
			<?php endif; ?>
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'добави реда','NAME' => 'subm2','ID' => 'subm2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</table>
