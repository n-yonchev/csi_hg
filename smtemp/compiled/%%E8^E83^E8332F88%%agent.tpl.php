<?php /* Smarty version 2.6.9, created on 2020-02-28 11:29:53
         compiled from agent.tpl */ ?>
<table class="d_table" cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='200'>списък на представителите
						<?php if (empty ( $this->_tpl_vars['FILT'] )): ?>
						<?php else: ?>
							с "<?php echo $this->_tpl_vars['FILT']; ?>
" в името
						<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class='d_table_button' colspan='200'>
			<form name="myagform" method=post enctype="multipart/form-data"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
търси 
<input type="text" class="inp7bold" name="filtag" id="filtag" size=16 onkeyup="autoagsubm(event,'filtag');" value="<?php echo $this->_tpl_vars['FILT']; ?>
">
+enter
			</form>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
	</tr>
</thead>

		<tr class='header'>
<td> име </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td> дела </td>
		<td class='sep'>&nbsp;</td>
<td> прирав </td>
</tr>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
		<tr onmouseover='this.className="tr_hover";' onmouseout='this.className="";' >
<td> <?php echo $this->_tpl_vars['elem']['name']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
					<?php if ($this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']] == 0): ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['dele']; ?>
" class="nyroModal" target="_blank">
<img src="images/free.gif" title="изтрий представителя">
</a>
					<?php else: ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['listcase']; ?>
" class="nyroModal" target="_blank">
<span class="finahist" title="виж списъка">
<?php echo $this->_tpl_vars['ARCOUN'][$this->_tpl_vars['elem']['id']]; ?>

</span>
</a>
					<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['makeeq']; ?>
" class="nyroModal" target="_blank">
<img src="images/makeeq.gif" title="приравни към друг">
</a>
	</tr>
	<?php endforeach; endif; unset($_from);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>

<script type="text/javascript">
	$('#filtag').autocomplete("agentautocoun.ajax.php",{matchContains:false, cacheLength:4, selectFirst:false});
function autoagsubm(event,foid){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
document.forms['myagform'].submit();
	}else{
return true;
	}
}
</script>

