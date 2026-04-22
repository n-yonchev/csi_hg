<?php /* Smarty version 2.6.9, created on 2020-10-05 16:14:04
         compiled from main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'main.tpl', 55, false),array('function', 'counter', 'main.tpl', 110, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_base.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table align=center width=100%  cellspacing=0 cellpadding=0 border=0 >
<tr class="mainhead" >
	<td align=left style='padding-left:10px;' style='height:33px' >
		<?php echo $this->_tpl_vars['HEADTEXT']; ?>

&nbsp;&nbsp;
&nbsp;&nbsp;
посл.входящ <b><?php echo $this->_tpl_vars['LASTDOCU']['serial']; ?>
/<?php echo $this->_tpl_vars['LASTDOCU']['year']; ?>
</b>
&nbsp;
посл.дело <b><?php echo $this->_tpl_vars['LASTCASE']['serial']; ?>
/<?php echo $this->_tpl_vars['LASTCASE']['year']; ?>
</b>
			<?php if ($this->_tpl_vars['EVENCOUN'] <= 0): ?>
			<?php else: ?>
&nbsp;
<a href='<?php echo $this->_tpl_vars['EVENLINK']; ?>
' target='_blank' class='nyroModal' 
style="font: bold 8pt verdana; padding: 2px 6px 2px 6px; background-color: gold; color:black; border-bottom: 0px solid black;">
<?php echo $this->_tpl_vars['EVENCOUN']; ?>
 </a> &nbsp; <?php if ($this->_tpl_vars['EVENCOUN'] == 1): ?>предстоящо събитие<?php else: ?>предстоящи събития<?php endif; ?>
			<?php endif; ?>
						<?php if ($this->_tpl_vars['REG4USERCOUN1'] > 0 || $this->_tpl_vars['REG4COUNALL'] > 0): ?>
&nbsp;&nbsp;
<img src="images/admin.gif"> 
			<?php else: ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['REG4USERCOUN1'] <= 0): ?>
			<?php else: ?>
&nbsp;
<a href='<?php echo $this->_tpl_vars['REG4USERLINK1']; ?>
' style="border-bottom: 0px solid black;" title="<?php echo $this->_tpl_vars['REG4USERCOUN1']; ?>
 дела на <?php echo $this->_tpl_vars['USNAME']; ?>
 с грешки от ЦРД-2014">
<sup>
<span style="font: bold 8pt verdana; padding: 2px 6px 2px 6px; background-color: red; color:white;">
<?php echo $this->_tpl_vars['REG4USERCOUN1']; ?>
 
</sup></span></a> 
			<?php endif; ?>
			<?php if ($this->_tpl_vars['REG4COUNALL'] <= 0): ?>
			<?php else: ?>
&nbsp;
<a href='<?php echo $this->_tpl_vars['REG4LINKALL']; ?>
' style="border-bottom: 0px solid black;" title="<?php echo $this->_tpl_vars['REG4COUNALL']; ?>
 всички дела с грешки от ЦРД-2014">
<sup>
<span style="font: bold 8pt verdana; padding: 2px 6px 2px 6px; background-color: red; color:white;">
<?php echo $this->_tpl_vars['REG4COUNALL']; ?>
 
</sup></span></a> 
			<?php endif; ?>
												<?php if (isset ( $this->_tpl_vars['ARREG4'] )): ?>
&nbsp;
<img src="images/dire.gif" id="reg4er" rel="#reg4ermess" title="последни грешки при предаване към ЦРД-2014">
<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<span id="reg4ermess" style="display: none">
		<table>
<?php $_from = $this->_tpl_vars['ARREG4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['r4el']):
?>
		<tr>
<td> [<?php echo $this->_tpl_vars['r4el']['id']; ?>
]
<td> <?php echo $this->_tpl_vars['r4el']['time']; ?>

<td> <?php echo $this->_tpl_vars['r4el']['idcase']; ?>

<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['r4el']['texter'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, "...", true) : smarty_modifier_truncate($_tmp, 60, "...", true)); ?>

<?php endforeach; endif; unset($_from); ?>
		</table>
</span>
<script type="text/javascript">
	$('#reg4er').cluetip({ width: 600, local:true, cursor:'help' });
</script>
						<?php else: ?>
						<?php endif; ?>

&nbsp;&nbsp;&nbsp;<i class="fas fa-file-import"></i> <a href="<?php echo $this->_tpl_vars['DOCUDEADLINES_LINK']; ?>
" title="входящи документа очакващи отговор"><?php echo $this->_tpl_vars['DOCUDEADLINES_COUNT']; ?>
</a>
				</td>
		<?php if (isset ( $this->_tpl_vars['USNAME'] )): ?>
<td align=right  style='padding-right:10px;' width=300px height=33px >
				<?php if ($this->_tpl_vars['ISMAINPLAN']): ?>
<a href='userprof.ajax.php' target='_blank' class='nyroModal'>
потребител <?php echo $this->_tpl_vars['USNAME']; ?>
 
</a>
				<?php else: ?>
потребител <?php echo $this->_tpl_vars['USNAME']; ?>
 
				<?php endif; ?>
[ <a href='<?php echo $this->_tpl_vars['MAINMENU']['exit']['link']; ?>
'><?php echo $this->_tpl_vars['MAINMENU']['exit']['text']; ?>
</a> ]
</td>
		<?php else: ?>
		<?php endif; ?>
</tr>
</table>
<?php $_from = $this->_tpl_vars['MAINGROUP']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mkey'] => $this->_tpl_vars['mitem']):
?>
		<?php if (is_array ( $this->_tpl_vars['mitem'] )): ?>
			<div class='tabs_submenu' onmouseover='show_submenu("sub_<?php echo $this->_tpl_vars['mkey']; ?>
")' onmouseout='hide_submenu("sub_<?php echo $this->_tpl_vars['mkey']; ?>
")' style='display:none;' id='sub_<?php echo $this->_tpl_vars['mkey']; ?>
' >
			<?php $_from = $this->_tpl_vars['mitem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subkey'] => $this->_tpl_vars['subitem']):
?>
				<?php if (is_int ( $this->_tpl_vars['subkey'] )): ?>
																<?php if (empty ( $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['subitem']]['text'] )): ?>
								<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['subitem']]['link']; ?>
"><?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['subitem']]['text']; ?>
</a>
								<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</div>
		<?php else: ?>
		<?php endif;  endforeach; endif; unset($_from); ?>

<div style="font: normal 10pt arial; background-color: #dfe8f6; padding: 6px; margin: 0px 0px 4px 0px; height:16px;">
									<?php echo smarty_function_counter(array('start' => 1,'assign' => 'mycoun'), $this);?>

	<?php $_from = $this->_tpl_vars['MAINGROUP']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mkey'] => $this->_tpl_vars['mitem']):
?>
		<?php if (is_array ( $this->_tpl_vars['mitem'] )): ?>
			<div id='tab_<?php echo $this->_tpl_vars['mkey']; ?>
_l' class='atabs_left'>&nbsp;</div>
			<div id='tab_<?php echo $this->_tpl_vars['mkey']; ?>
_m' class='atabs_middle' 
onmouseover="show_submenu('sub_<?php echo $this->_tpl_vars['mkey']; ?>
',this);" 
onmouseout="hide_submenu('sub_<?php echo $this->_tpl_vars['mkey']; ?>
');"
			><?php echo $this->_tpl_vars['mitem']['title']; ?>
</div>
			<div id='tab_<?php echo $this->_tpl_vars['mkey']; ?>
_r' class='atabs_right'>&nbsp;</div>
			<?php $_from = $this->_tpl_vars['mitem']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subkey'] => $this->_tpl_vars['subitem']):
?>
				<?php if ($this->_tpl_vars['subkey'] === 'title'): ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['subitem'] == $this->_tpl_vars['MODE']): ?>
						<script>					
							document.getElementById('tab_<?php echo $this->_tpl_vars['mkey']; ?>
_l').className = 'atabs_left_selected';
							document.getElementById('tab_<?php echo $this->_tpl_vars['mkey']; ?>
_m').className = 'atabs_middle_selected';
							document.getElementById('tab_<?php echo $this->_tpl_vars['mkey']; ?>
_r').className = 'atabs_right_selected';
						</script>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['mitem'] == $this->_tpl_vars['MODE']): ?>
				<div class='atabs_left_selected'>&nbsp;</div>
				<div class='atabs_middle_selected' 
onmouseover="this.className='atabs_middle_selected_red';" onmouseout="this.className='atabs_middle_selected';"
onclick='document.location.href="<?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['mitem']]['link']; ?>
"'
				><?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['mitem']]['text']; ?>
</div>
				<div class='atabs_right_selected'>&nbsp;</div>
			<?php else: ?>
				<div class='atabs_left' onclick='document.location.href="<?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['mitem']]['link']; ?>
"'>&nbsp;</div>
				<div class='atabs_middle' onclick='document.location.href="<?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['mitem']]['link']; ?>
"'><?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['mitem']]['text']; ?>
</div>
				<div class='atabs_right' onclick='document.location.href="<?php echo $this->_tpl_vars['MAINMENU'][$this->_tpl_vars['mitem']]['link']; ?>
"'>&nbsp;</div>
			<?php endif; ?>
		<?php endif; ?>
									<?php echo smarty_function_counter(array('assign' => 'mycoun'), $this);?>

									<?php if ($this->_tpl_vars['mycoun'] <= count ( $this->_tpl_vars['MAINGROUP'] )): ?>
<div class="atabs_sepa">&nbsp;</div>
									<?php else: ?>
									<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
			<?php $this->assign('myaction', $this->_tpl_vars['MAINMENU']['fino']['link']); ?>
			<form name="mymainform" method=post enctype="multipart/form-data" action="<?php echo $this->_tpl_vars['myaction']; ?>
"
			style="float:left;margin:0px 0px 0px 6px;padding:0px;width:auto;font: normal 7pt verdana;white-space:nowrap;">
номер дело от-до +enter
<input type="text" class="inp7bold" name="textnome" id="textnome" size=16 onkeyup="automainsubm(event,'textnome');" value="">
			</form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_dire.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<?php echo $this->_tpl_vars['CONTENT']; ?>


<iframe id="idprin" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprin(p1){
	document.getElementById("idprin").focus();
	document.getElementById("idprin").src= p1;
}
</script>

<script>
function automainsubm(event,foid){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
var obfi= document.getElementById(foid);
obfi.style.visibility= "hidden";
//obfi.value= foid+obfi.value;
document.forms['mymainform'].submit();
	}else{
return true;
	}
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_base.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>