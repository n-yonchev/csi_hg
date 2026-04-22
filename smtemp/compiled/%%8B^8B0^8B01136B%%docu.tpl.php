<?php /* Smarty version 2.6.9, created on 2020-11-23 11:24:46
         compiled from docu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'docu.tpl', 62, false),array('modifier', 'date_format', 'docu.tpl', 67, false),array('modifier', 'escape', 'docu.tpl', 76, false),)), $this); ?>
<table class="d_table" width=';' cellspacing='0' cellpadding='0' align=center>
	<thead>
		<tr>
			<td class='d_table_title' colspan='200'>списък на входящите документи</td>
		</tr>
		<tr>
			<td class='d_table_button_center' colspan='200'>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => ($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</td>
		</tr>
	</thead>
	<tr class='header'>
		<td><span> вх.номер </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> описание</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> подател</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> бележки</span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> въвел </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> кога </span></td>
		<td class='sep'>&nbsp;</td>
		<td><span> към дело</span></td>
		<td class='sep'>&nbsp;</td>
		<td> <span>деловодител</span></td>
		<td class='sep'>&nbsp;</td>
<td> външ
		<td class='sep'>&nbsp;</td>
<td>&nbsp;
		<td class='sep'>&nbsp;</td>
<td>образ
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] )): ?>
							<?php else: ?>
		<td class='sep'>&nbsp;</td>
<td id="scanwaitcoun" align=center style="background:gold;cursor:pointer;font:bold 8pt verdana;" onclick="scanclic(1);">&nbsp;
							<?php endif; ?>
	</tr>
	<tbody>
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
	<tr onmouseover='this.className="trdocu";' onmouseout='if(this!==trcurr)this.className="";' onclick="trclic(this);">
		<td align=right> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
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
		<td> <?php echo $this->_tpl_vars['elem']['u2name']; ?>
 </td>
		<td class='sep'>&nbsp;</td>
		<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_docucase.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<td class='sep'>&nbsp;</td>
				<?php if ($this->_tpl_vars['elem']['idpost'] == 0): ?>
<td align=center> &nbsp;
				<?php else: ?>
<td align=center style="cursor:help;" 
title="източник <?php echo $this->_tpl_vars['elem']['exname']; ?>
&#xA;метод <?php echo $this->_tpl_vars['ARPOSTTYPE_2'][$this->_tpl_vars['elem']['idposttype']]; ?>
&#xA;адресат <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['adresat'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
&#xA;адрес <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['address'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"> 
<font color=red>виж</font>
				<?php endif; ?>
		<td class='sep'>&nbsp;</td>
		<td  align=center><a href="<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a></td>
		<td class='sep'>&nbsp;</td>
<td align=left>
<a href="<?php echo $this->_tpl_vars['elem']['scanuplo']; ?>
" class="nyroModal" target="_blank"><img src="images/include.gif" title="качи изображение"></a>
					<?php $this->assign('iddocu', $this->_tpl_vars['elem']['id']); ?>
					<?php $this->assign('scancoun', $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]); ?>
		<?php if ($this->_tpl_vars['scancoun'] == 0): ?>
&nbsp;
		<?php else: ?>
<img src="images/tranclos.gif" style="cursor:pointer" title="виж изображение" onclick="w2=window.open('<?php echo $this->_tpl_vars['elem']['scanview']; ?>
','win2');w2.focus();">
			<?php if ($this->_tpl_vars['scancoun'] == 1): ?>
			<?php else: ?>
<sup><?php echo $this->_tpl_vars['ARSCANCOUN'][$this->_tpl_vars['iddocu']]; ?>
</sup>
			<?php endif; ?>
		<?php endif; ?>
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] )): ?>
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

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		
	</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('.caselist').cluetip({ width: 240, local:true, cursor:'pointer' });
																								<?php if (isset ( $this->_tpl_vars['LINKDOCUUPLO'] )): ?>
							$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['LINKDOCUUPLO']; ?>
'});
												<?php else: ?>
												<?php endif; ?>
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] )): ?>
							<?php else: ?>
						scanclic(0);
							<?php endif; ?>
});
							<?php if (empty ( $this->_tpl_vars['USERPRIN'] )): ?>
							<?php else: ?>
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
				$.nyroModalManual({forceType:'iframe', url:'<?php echo $this->_tpl_vars['SCANMASSLINK']; ?>
'});
			}else{
			}
		}
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
							<?php endif; ?>
var trcurr;
function trclic(obje){
	if (trcurr){
		trcurr.className= "";
	}else{
	}
	obje.className= "trdocu";
	trcurr= obje;
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

