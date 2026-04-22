<?php /* Smarty version 2.6.9, created on 2020-03-04 11:29:35
         compiled from cazoadvamodi.ajax.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array('ONLOAD' => "typechan($('#idpatype'));")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
	<?php $this->assign('_title', 'въведи нова вноска'); ?>
<?php else: ?>
	<?php $this->assign('_title', 'корегирай вноска'); ?>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

					<table>
					<tr>
<td>
сума
<br>
<input type="text" name="amount" id="amount" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'amount','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
дата
<br>
<input type="text" name="date" id="date" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
взискател
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARCLAINAME'],'ID' => 'idclaimer','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</table>
описание
<br>
<textarea name="descrip" id="descrip" rows=5 cols=50 size=255 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'descrip','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
<br>
<br>
тип на плащане
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARPATYPENAME'],'ID' => 'idpatype','C1' => 'input','C2' => 'inputer','ONCH' => "typechan(this);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="t1" class="inputcont" style="display: none; padding: 6px">
				<table align=center>
				<tr>
				<td align=left colspan=6>
	за приходния касов ордер
				<tr>
				<td align=right>
изх.номер/<?php echo $this->_tpl_vars['CURRYEAR']; ?>
г.
				<td width=10>
				<td>
<input type="text" name="cashseri" id="cashseri" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'cashseri','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
дата
				<td width=10>
				<td>
<input type="text" name="cashdate" id="cashdate" class="input" size=12 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'cashdate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				<tr>
				<td align=right>
вносител
				<td width=10>
				<td>
<input type="text" name="cashname" id="cashname" class="input" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'cashname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
				</table>
</div>

<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
function typechan(obje){
	var mytype= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
//alert(mycode);
	if (mytype==1){
		$("#t1").show();
	}else{
		$("#t1").hide();
	}
	resizeNyroModalIframe();
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>