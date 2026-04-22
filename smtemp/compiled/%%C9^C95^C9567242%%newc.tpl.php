<?php /* Smarty version 2.6.9, created on 2020-02-27 12:56:52
         compiled from newc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'newc.tpl', 121, false),array('modifier', 'replace', 'newc.tpl', 163, false),)), $this); ?>
<form name="myform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
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


<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
<thead>
	<tr>
		<td class='d_table_title' colspan='18'>
<div style="float:left;">
списък на свободните дела
</div>
<div style="float:right;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
		</td>
	</tr>
	<tr>
		<td class='d_table_button_center' colspan='18'>
въведи за търсене
&nbsp;&nbsp;&nbsp;&nbsp;
текст +enter
<input type="text" class="inp7bold" name="textfilt" id="textfilt" size=16 onkeyup="autosubm(event,'textfilt');">
&nbsp;&nbsp;&nbsp;&nbsp;
номер дело от-до +enter
<input type="text" class="inp7bold" name="freeserifilt" id="freeserifilt" size=16 onkeyup="autosubm(event,'freeserifilt');">
		</td>
	</tr>

</thead>
	<tr class='header'>
<td colspan=9 align=center><span> <b>дело</b> </span></td>
		<td class='sep'>&nbsp;</td>	
<td colspan=9 align=center><span> <b>документи по делото</b> </span></td>
	<tr class='header'>
<td><span> &nbsp; </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> номер </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> образувано </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> вземи</span></td>
		<td class='sep'>&nbsp;</td>	
<td style="cursor:pointer">
<img src="images/change.gif" title="вземи всички маркирани дела" onclick="document.forms['myform'].submit();">
</td>
		<td class='sep'>&nbsp;</td>	
<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>	
<td><span> описание</span></td>	
		<td class='sep'>&nbsp;</td>
<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
<td><span> бележки</span></td>
	</tr>
<tbody>

<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<?php $_from = $this->_tpl_vars['elem']['listdocu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dkey'] => $this->_tpl_vars['elemdocu']):
?>
				<?php if ($this->_tpl_vars['dkey'] == 0): ?>
<tr><td colspan=40 class="hr"> <hr>
				<?php else: ?>
				<?php endif; ?>
<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>
				<?php if ($this->_tpl_vars['dkey'] == 0): ?>
<td align=center>
<a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right>
<?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
 </td>
		<td class='sep'>&nbsp;</td>
<td>
<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 </td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	<?php if (isset ( $this->_tpl_vars['elem']['newcase'] )): ?>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['newcase']; ?>
" class="nyroModal" target="_blank">
<img src="images/change.gif" title="Вземи Делото"></a></td>
	<?php else: ?>
<a href="#" onclick='document.location.href="<?php echo $this->_tpl_vars['elem']['getcase']; ?>
"'>
<img src="images/change.gif" title="вземи делото"></a></td>
	<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=center>
<input type=checkbox name="<?php echo $this->_tpl_vars['PREFMULT'];  echo $this->_tpl_vars['elem']['id']; ?>
">
		<td class='sep'>&nbsp;</td>
				<?php else: ?>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
<td>
		<td class='sep'>&nbsp;</td>
				<?php endif; ?>
<td> 
	<?php if (empty ( $this->_tpl_vars['elemdocu']['serial'] ) && empty ( $this->_tpl_vars['elemdocu']['year'] )): ?>
<font color=red> няма </font>
	<?php else:  echo $this->_tpl_vars['elemdocu']['serial']; ?>
/<?php echo $this->_tpl_vars['elemdocu']['year']; ?>

	<?php endif; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elemdocu']['text']; ?>
 </td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elemdocu']['from']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	<?php if (empty ( $this->_tpl_vars['elemdocu']['notes'] )): ?>
&nbsp;
	<?php else: ?>
<img src="images/view.png" title='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elemdocu']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
'>
	<?php endif; ?>
</td>
			<?php endforeach; endif; unset($_from); ?>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</form>

</tbody>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</table>

<script>
function autosubm(event,foid){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
obfi.value= foid+obfi.value;
document.forms['myform'].submit();
	}else{
return true;
	}
}
</script>