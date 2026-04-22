<?php /* Smarty version 2.6.9, created on 2020-12-07 17:36:55
         compiled from cazo5view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'cazo5view.tpl', 43, false),array('modifier', 'replace', 'cazo5view.tpl', 53, false),)), $this); ?>
<script type="text/javascript">
	$($.fn.nyroModal.settings.openSelector).nyroModal();	
</script>

<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<thead>
	<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">входящи документи
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']): ?>
			<?php else: ?>
<div class='d_table_button' style="float:right">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
	</tr>
	
</thead>
	<tr class='header'>
		<td><span> вх.номер</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> дата </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бел</span></td>
		<td class='sep'>&nbsp;</td>
<td>образ
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] ) || $this->_tpl_vars['FLAGNOCHANGE']): ?>
							<?php else: ?>
		<td class='sep'>&nbsp;</td>
<td id="scanwaitcoun" align=center style="background:gold;cursor:pointer;font:bold 8pt verdana;" onclick="scanclic(1);">&nbsp;
							<?php endif; ?>
	</tr>
<tbody>
	<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>		
	<tr  onmouseover='this.className="tr_hover";' onmouseout='this.className="";'>	
		<td> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
</td>			
			<td class='sep'>&nbsp;</td>	
			<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
		<td class='sep'>&nbsp;</td>			
		<td> <?php echo $this->_tpl_vars['elem']['text']; ?>
</td>
		<td class='sep'>&nbsp;</td>
		<td> <?php echo $this->_tpl_vars['elem']['from']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
	<?php if (empty ( $this->_tpl_vars['elem']['notes'] )): ?>
&nbsp;
	<?php else: ?>
<img src="images/view.png" title='<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['elem']['notes'])) ? $this->_run_mod_handler('replace', true, $_tmp, ";", "; ") : smarty_modifier_replace($_tmp, ";", "; ")))) ? $this->_run_mod_handler('replace', true, $_tmp, ",", ", ") : smarty_modifier_replace($_tmp, ",", ", ")); ?>
'>
	<?php endif; ?>
		<td class='sep'>&nbsp;</td>
<td align=left>
<nobr>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['scanuplo']; ?>
" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
					<?php $this->assign('iddocu', $this->_tpl_vars['elem']['id']); ?>
					<?php $this->assign('scancoun', $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]); ?>
		<?php if ($this->_tpl_vars['scancoun'] == 0): ?>
&nbsp;
		<?php else: ?>
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('caseeditzone.php<?php echo $this->_tpl_vars['elem']['scanview']; ?>
','win2');w2.focus();">
			<?php if ($this->_tpl_vars['scancoun'] == 1): ?>
			<?php else: ?>
<sup><?php echo $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]; ?>
</sup>
			<?php endif; ?>
		<?php endif; ?>
</nobr>
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] ) || $this->_tpl_vars['FLAGNOCHANGE']): ?>
							<?php else: ?>
		<td class='sep'>&nbsp;</td>
								<?php if ($this->_tpl_vars['elem']['iduser'] == $_SESSION['iduser']): ?>
<td align=center>
<img src="images/print.gif" title="отпечати етикет" style="cursor:pointer" onclick="plabel('<?php echo $this->_tpl_vars['elem']['id']; ?>
');">
								<?php else: ?>
<td>&nbsp;
								<?php endif; ?>
							<?php endif; ?>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>
<script type="text/javascript">
												<?php if (isset ( $this->_tpl_vars['LINKDOCUUPLO'] )): ?>
	setTimeout("$.nyroModalManual({forceType:'iframe', url:'caseeditzone.php<?php echo $this->_tpl_vars['LINKDOCUUPLO']; ?>
'})",1000);
												<?php else: ?>
												<?php endif; ?>
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] ) || $this->_tpl_vars['FLAGNOCHANGE']): ?>
							<?php else: ?>
						scanclic(0);
function scanclic(isfull){
window.fullacti= isfull;
window.countext= $("#scanwaitcoun").text();
	$("#scanwaitcoun").html("<img src='ajaxload.gif'>");
	jQuery.ajax({
		url: "scan.inc.php?u=<?php echo $_SESSION['iduser']; ?>
"
		,success: scansu
		});
}
function scansu(data){
	var arre= data.split("^");
	if (arre[0]=="ok"){
		var coun= arre[1];
		if (coun=="0"){
			$("#scanwaitcoun").text("").attr("title","провери за сканирани документи");
		}else{
			$("#scanwaitcoun").text(coun).attr("title","виж списъка със сканираните документи");
			if (window.fullacti==1 && window.countext!=""){
				$.nyroModalManual({forceType:'iframe', url:'caseeditzone.php<?php echo $this->_tpl_vars['SCANMASSLINK']; ?>
'});
			}else{
			}
		}
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
							<?php endif; ?>
</script>

<script>
function s4call(p1){
		jQuery.ajax({
			url: "cazo5scanview.ajax.php?"+p1
			,success: s4succ
			});
}
function s4succ(data){
///////////////////////////alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){
$('#t5link').click();
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}

function plabel(iddo){
	jQuery.ajax({
		url: "scan.inc.php?d="+iddo
		,success: plabsu
		});
}
function plabsu(data){
	var arre= data.split("^");
	if (arre[0]=="ok"){
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}

</script>