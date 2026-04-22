<?php /* Smarty version 2.6.9, created on 2020-02-28 11:29:04
         compiled from cale.tpl */ ?>
<br>
								<table align=center>
								<tr>
								<td>
											<?php if (count ( $this->_tpl_vars['ARCOUN'] ) == 0): ?>
<b class="bodyjq">няма въведени събития</b>
											<?php else: ?>

		<div style="width:200px; height:400px; overflow-x:auto; overflow-y:auto;">
		<table class="d_table" cellspacing='0' cellpadding='0' align=right>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'> избери месец </td>
		</tr>
		</thead>
		<tbody>
		<tr class='header'>
<td> месец </td>
		<td class='sep'>&nbsp;</td>
<td align=right> брой<br>съб </td>
		<tbody>
<?php $_from = $this->_tpl_vars['ARMO']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mkey'] => $this->_tpl_vars['elem']):
?>
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";' style="cursor:pointer"
		onclick="$('#cont2').load('cale.ajax.php?m=<?php echo $this->_tpl_vars['mkey']; ?>
');">
<td> <?php echo $this->_tpl_vars['elem']; ?>

		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['mkey']]; ?>

<?php endforeach; endif; unset($_from); ?>
		</tbody>
		</table>
		</div>
								<td width=20>
								<td id="cont2" valign=top>
<?php echo $this->_tpl_vars['LISTEVEN']; ?>

											<?php endif; ?>
								</table>
