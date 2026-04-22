<?php /* Smarty version 2.6.9, created on 2020-03-09 12:23:29
         compiled from abet.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'abet.tpl', 26, false),)), $this); ?>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<div class='tabs_line' >
	<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
	<tr>
	<?php $_from = $this->_tpl_vars['YEARLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<td class='tabs_sep'>&nbsp;</td> 
		<?php if ($this->_tpl_vars['YEAR'] == $this->_tpl_vars['ekey']): ?>
			<td class='tabs_left_selected'></td>
			<td class='tabs_middle_selected'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td class='tabs_right_selected'></td>
		<?php else: ?>	
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_left'></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_middle'><span><?php echo $this->_tpl_vars['ekey']; ?>
</span></td>
			<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']; ?>
"' class='tabs_right'></td>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
	</table>
</div>
						<?php endif; ?>

<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
							<?php $this->assign('txpage', ((is_array($_tmp="стр.")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['PAGENO']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['PAGENO']))); ?>
						<?php else: ?>
	<thead>
		<tr>
			<td class="d_table_title" colspan=100>
									<?php if (empty ( $this->_tpl_vars['LETTLIST'] )): ?>
<span style="padding:40px;"> няма имена </span>
									<?php else: ?>
			<?php $_from = $this->_tpl_vars['LETTLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
				<?php if ($this->_tpl_vars['elem']['letter'] < "А"): ?>
					<?php $this->assign('ex1', "style='background-color:wheat;padding-left:4px;'"); ?>
					<?php $this->assign('et1', "title='лат.буква, цифра или служ.символ'"); ?>
				<?php else: ?>
					<?php $this->assign('ex1', ""); ?>
					<?php $this->assign('et1', ""); ?>
				<?php endif; ?>
<a class="pagilink" <?php echo $this->_tpl_vars['ex1']; ?>
 href="<?php echo $this->_tpl_vars['elem']['link']; ?>
" <?php echo $this->_tpl_vars['et1']; ?>
> <?php echo $this->_tpl_vars['elem']['letter']; ?>
 </a>&nbsp;
			<?php endforeach; endif; unset($_from); ?>
									<?php endif; ?>
						<?php endif; ?>

									<?php if (empty ( $this->_tpl_vars['LETTLIST'] )): ?>
	</thead>
									<?php else: ?>
			<tr>
			<td class="d_table_title" colspan=100>имена с буква "<?php echo $this->_tpl_vars['CULETT']; ?>
" <?php echo $this->_tpl_vars['txpage']; ?>

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<tr>
	<td class='d_table_button' colspan='100'>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "fuprin('".($this->_tpl_vars['CURINT'])."');",'TITLE' => 'отпечати буквата')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "fuprin('".($this->_tpl_vars['CURINTALL'])."');",'TITLE' => 'отпечати азбучника')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>
	</thead>
		<tr class='header'>
			<td> име
			<td class='sep'>&nbsp;</td>
			<td> тип
			<td class='sep'>&nbsp;</td>
			<td> ЕГН/ЕИК
			<td class='sep'>&nbsp;</td>
			<td> адрес
			<td class='sep'>&nbsp;</td>
			<td> роля
		</tr>


		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr>
			<td valign=top> <?php echo $this->_tpl_vars['elem']['text']; ?>

					<?php if ($this->_tpl_vars['elem']['type'] == 1): ?>
						<?php $this->assign('txtype', "юл"); ?>
					<?php elseif ($this->_tpl_vars['elem']['type'] == 2): ?>
						<?php $this->assign('txtype', "фл"); ?>
					<?php else: ?>
						<?php $this->assign('txtype', "друго"); ?>
					<?php endif; ?>
			<td class='sep'>&nbsp;</td>
			<td valign=top> <?php echo $this->_tpl_vars['txtype']; ?>

			<td class='sep'>&nbsp;</td>
			<td valign=top> <?php echo $this->_tpl_vars['elem']['iden']; ?>

			<td class='sep'>&nbsp;</td>

			<td valign=top> 
					<?php if (count ( $this->_tpl_vars['elem']['addr'] ) == 0): ?>
			&nbsp;
					<?php else: ?>
				<?php $_from = $this->_tpl_vars['elem']['addr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elemaddr']):
?>
			<?php echo $this->_tpl_vars['elemaddr']; ?>

			<br>
				<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>

			<td class='sep'>&nbsp;</td>
			<td valign=top>
					<?php if (count ( $this->_tpl_vars['elem']['suit'] ) == 0): ?>
			&nbsp;
					<?php else: ?>
				<?php $_from = $this->_tpl_vars['elem']['suit']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elemsuit']):
?>
			<?php if ($this->_tpl_vars['elemsuit']['role'] == 1): ?>взиск.<?php else: ?>длъжник<?php endif; ?> <?php echo $this->_tpl_vars['elemsuit']['seri']; ?>
/<?php echo $this->_tpl_vars['elemsuit']['year']; ?>

			<br>
				<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php endif; ?>
			</table>

