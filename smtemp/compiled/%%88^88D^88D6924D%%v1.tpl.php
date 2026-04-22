<?php /* Smarty version 2.6.9, created on 2020-03-10 13:32:46
         compiled from v1.tpl */ ?>
							<?php if (isset ( $_SESSION['v1post'] )): ?>
<script>
$(document).ready(function(){
	fuprin('v1prin.php');
});
</script>
							<?php else: ?>
							<?php endif; ?>
		
		<table class="d_table" cellspacing='0' cellpadding='0' align=center>
		<thead>
		<tr>
<td class='d_table_title' colspan='200'>
<?php if ($this->_tpl_vars['FLAGALL'] == 0): ?>списък на активните наблюдатели<?php else: ?>списък на всички наблюдатели<?php endif;  if (empty ( $this->_tpl_vars['FILTNAME'] )):  else: ?> съдържащи "<?php echo $this->_tpl_vars['FILTNAME']; ?>
"<?php endif; ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $this->_tpl_vars['LINKALTE']; ?>
" style="font: bold 7pt verdana; color: black; border-bottom: 1px solid black; cursor: pointer;">
<?php if ($this->_tpl_vars['FLAGALL'] == 0): ?>покажи и неактивните<?php else: ?>покажи само активните<?php endif; ?></a>
		</tr>
		<tr>
<td class='d_table_button' colspan='200' align=right>
			<form name="mynameform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
търси 
<input type="text" class="inp7bold" name="filtname" id="filtname" size=16 onkeyup="autonamesubm(event,'filtname');" value="<?php echo $this->_tpl_vars['FILTNAME']; ?>
">
+enter
			</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => "добави")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</td>
		</tr>
		</thead>
		<tr class='header'>
<td> име </td>
			<td class='sep'>&nbsp;</td>
<td align=center> активен </td>
			<td class='sep'>&nbsp;</td>
<td align=center>&nbsp;</td>
			<td class='sep'>&nbsp;</td>
<td align=center>дела</td>
		</tr>
		<tbody>
		<?php $_from = $this->_tpl_vars['USERLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr>
<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
 </td>
			<td class='sep'>&nbsp;</td>
<td align=center> 
					<?php if ($this->_tpl_vars['elem']['inactive'] == 0): ?>
<a href="<?php echo $this->_tpl_vars['elem']['inac']; ?>
"><img src='css/checkbox_checked.gif' alt='' /></a>
					<?php else: ?>
<a href="<?php echo $this->_tpl_vars['elem']['acti']; ?>
"><img src='css/checkbox.gif' alt='' /></a>
					<?php endif; ?>
</td>
			<td class='sep'>&nbsp;</td>
<td class="none" align=center> 
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
</td>
			<td class='sep'>&nbsp;</td>
<td align=right bgcolor="#aaccff" onclick="document.location.href='<?php echo $this->_tpl_vars['elem']['viewer']; ?>
';" style="cursor:pointer" title="списъка с дела"> 
					<?php if ($this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']] == 0): ?>
няма
					<?php else:  echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']]; ?>
 
					<?php endif; ?>
&nbsp;
		</tr>

		<?php endforeach; endif; unset($_from); ?>
		</tbody>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>

<script type="text/javascript">
	$('#filtname').autocomplete("v1autocoun.ajax.php",{matchContains:false, cacheLength:4, selectFirst:false});
function autonamesubm(event,foid){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
document.forms['mynameform'].submit();
	}else{
return true;
	}
}
</script>