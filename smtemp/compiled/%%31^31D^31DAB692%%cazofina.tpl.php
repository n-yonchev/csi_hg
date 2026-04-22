<?php /* Smarty version 2.6.9, created on 2024-01-25 11:58:23
         compiled from cazofina.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'cazofina.tpl', 90, false),array('modifier', 'tomoney2', 'cazofina.tpl', 95, false),array('modifier', 'tomoney', 'cazofina.tpl', 266, false),array('modifier', 'date_format', 'cazofina.tpl', 318, false),)), $this); ?>
<style>
.finahistno {font:bold 7pt verdana;background-color:red;color:white;padding:1px 8px 1px 8px;cursor:pointer;}
</style>
<style>
.stat1 {cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:thistle;}
.stat2aaa {cursor:help;font:normal 8pt verdana;padding:1px 6px; background-color:magenta;}
.stat2ok {font:bold 7pt verdana;color:white;}
.he4 {cursor:help;font:bold 7pt verdana;padding:1px 6px; background-color:silver;}
.ro4 {cursor:help;font:normal 7pt verdana;border-bottom: 1px solid silver;}
</style>
<table class="d_table" cellspacing='0' cellpadding='0' <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoplan.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
	<thead>
		<tr>
		<td class='d_table_title' colspan='200' onclick="toggle(this,event);">
<div style="float:left">
постъпления
&nbsp;&nbsp;&nbsp;
<a href="#" onclick="$('#tpaymlink').click();return false;" title="обнови"><img src="images/refresh.gif"></a>
</div>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE'] && ! ( $this->_tpl_vars['FINALOGGED'] || $this->_tpl_vars['FLAGCASHONLY'] )): ?>
			<?php else: ?>
<div class='d_table_button' style="float:right">
<a href="caseeditzone.php<?php echo $this->_tpl_vars['GRDIST']; ?>
" class="nyroModal" target="_blank"><img src="images/grdist.gif" title="групово разпределяне"></a>
&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('HREF' => "caseeditzone.php".($this->_tpl_vars['ADDNEW']),'CLASS' => 'nyroModal','TARGET' => '_blank','TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
			<?php endif; ?>
		</tr>
	</thead>
		<tr class='header'>
<td align=center>
<a href="#" onclick="fuprinfinaall();return false;"><img src="images/print.gif" title="отпечати всички"></a>
	<td class='sep'>&nbsp;</td>
<td> сума </td>
	<td class='sep'>&nbsp;</td>
<td> тип </td>
	<td class='sep'>&nbsp;</td>
<td> длъжник </td>
	<td class='sep'>&nbsp;</td>
<td> още </td>
	<td class='sep'>&nbsp;</td>
<td> исто<br>рия </td>
					<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
	<td class='sep'>&nbsp;</td>
<td> нераз<br>пред </td>
	<td class='sep'>&nbsp;</td>
<td align=center> <img src="images/print.gif" title="отпечати всички"> </td>
	<td class='sep'>&nbsp;</td>
<td> при<br>ключ </td>
	<td class='sep'>&nbsp;</td>
<td align=center> 
<img id="grimg" src="images/clos.gif" title="приключи маркираните" style="display:none;cursor:pointer;" onclick="graction();">
	<td class='sep'>&nbsp;</td>
<td> дата погасяв </td>
	<td class='sep'>&nbsp;</td>
<td colspan=2> разпределение </td>
		</tr>
	<tbody>
		<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
		<tr onmouseover='this.className="trhove";' onmouseout='this.className="";'>
<td align=center>
						<?php if ($this->_tpl_vars['elem']['idtype'] == 1): ?>
							<?php echo smarty_function_math(array('equation' => "a+b",'a' => $this->_tpl_vars['myid'],'b' => 132,'assign' => 'myprnt'), $this);?>

<a href="#" onclick="fuprinfina('finaprnt.php?para='+'<?php echo $this->_tpl_vars['myprnt']; ?>
/');return false;"><img src="images/print.gif" title="отпечати постъплението"></a>
						<?php else: ?>
						<?php endif; ?>
	<td class='sep'>&nbsp;</td>	
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inco'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</td>
	<td class='sep'>&nbsp;</td>	
				<?php $this->assign('arindx', $this->_tpl_vars['elem']['idtype']); ?>
<td> <?php echo $this->_tpl_vars['ARTYPE'][$this->_tpl_vars['arindx']]; ?>
 
				<?php if ($this->_tpl_vars['arindx'] == 1): ?>
/<?php echo $this->_tpl_vars['elem']['idfinabank']; ?>
-<?php echo $this->_tpl_vars['elem']['bankname']; ?>

				<?php else: ?>
				<?php endif; ?>
</td>
	<td class='sep'>&nbsp;</td>	
<td> 
				<?php if (empty ( $this->_tpl_vars['elem']['debtname'] )): ?>
<font color="red">неопределен</font>
				<?php else: ?>
					<?php if (in_array ( $this->_tpl_vars['elem']['iddebtor'] , $this->_tpl_vars['ARDEBT'] )):  echo $this->_tpl_vars['elem']['debtname']; ?>
 
					<?php else: ?>
<span class="no">
<?php echo $this->_tpl_vars['elem']['debtname']; ?>
 
</span>
					<?php endif; ?>
				<?php endif; ?>
																												<?php if ($_SESSION['VIEWFLAG_FINANOEDIT']): ?>
														<?php else: ?>
				<?php if ($this->_tpl_vars['elem']['isclosed'] && $this->_tpl_vars['DEBTCOUN'] > 1): ?>
<span class="dechan" rel="cazofinadebt.ajax.php<?php echo $this->_tpl_vars['elem']['linkdebt']; ?>
" title="смени длъжника" style="cursor:help"> 
<img src="images/filt.gif"> </span>
				<?php else: ?>
				<?php endif; ?>
														<?php endif; ?>
</td>

	<td class='sep'>&nbsp;</td>	
<td align=center><img src="images/view.png" class="ttip" rel="#cont<?php echo $this->_tpl_vars['myid']; ?>
" title="допълнителна информация" style="cursor:help">
<span id="cont<?php echo $this->_tpl_vars['myid']; ?>
" style="display: none">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofinainfo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</span>
</td>

	<td class='sep'>&nbsp;</td>	
			<?php if ($this->_tpl_vars['elem']['histcoun'] == 0): ?>
<td>&nbsp;</td>
			<?php else: ?>
<td align=center>
																												<?php if ($_SESSION['VIEWFLAG_FINANOEDIT']): ?>
														<?php else: ?>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['hist']; ?>
" class="nyroModal" target="_blank">
<span class="finahist" title="виж историята"><?php echo $this->_tpl_vars['elem']['histcoun']; ?>
</span>
</a>
														<?php endif; ?>
</td>
			<?php endif; ?>

								

											<?php $this->assign('fledit', false); ?>
							<?php $this->assign('flprin', false); ?>
							<?php $this->assign('flinfo', false); ?>
																												<?php if ($_SESSION['VIEWFLAG_FINANOEDIT']): ?>
														<?php else: ?>
				<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
												<?php $this->assign('flinfo', true); ?>
				<?php else: ?>
										<?php if ($this->_tpl_vars['elem']['idtype'] == 2): ?>
													<?php $this->assign('fledit', true); ?>
							<?php $this->assign('flprin', true); ?>
					<?php else: ?>
												<?php if ($this->_tpl_vars['FLAGNOCHANGE'] && ! $this->_tpl_vars['FINALOGGED']): ?>
													<?php else: ?>
														<?php $this->assign('fledit', true); ?>
						<?php endif; ?>
					<?php endif; ?>
																				<?php if ($this->_tpl_vars['elem']['istran'] == 2): ?>
							<?php $this->assign('fledit', false); ?>
										<?php else: ?>
										<?php endif; ?>
					
				<?php endif; ?>
														<?php endif; ?>

						<td class='sep'>&nbsp;</td>
<td align=left>
<nobr>
				<?php if ($this->_tpl_vars['fledit']): ?>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['edit']; ?>
" class="nyroModal" target="_blank"><img src="images/edit.png" title="корегирай"></a>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['dele']; ?>
" class="nyroModal" target="_blank"><img src="images/free.gif" title="изтрий"></a>
				<?php else: ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['flprin']): ?>
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['elem']['prin']; ?>
');return false;"><img src="images/print.gif" title="отпечати ПКО"></a>
				<?php else: ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['flinfo']): ?>
<img src="images/info.gif" class="info" rel="caseeditzone.php<?php echo $this->_tpl_vars['elem']['info']; ?>
" title="информация за приключено постъпление" style="cursor:help">
				<?php else: ?>
				<?php endif; ?>
</nobr>
</td>

	<td class='sep'>&nbsp;</td>
<td align=right> 
	<?php if ($this->_tpl_vars['elem']['rest'] == 0): ?>
-
	<?php else:  echo ((is_array($_tmp=$this->_tpl_vars['elem']['rest'])) ? $this->_run_mod_handler('tomoney', true, $_tmp, 2) : smarty_modifier_tomoney($_tmp, 2)); ?>

	<?php endif; ?>
</td>

	<td class='sep'>&nbsp;</td>
<td>
	<?php if ($this->_tpl_vars['elem']['isclosed'] == 1 && $this->_tpl_vars['elem']['istran'] == 1): ?>
		<table>
		<?php $_from = $this->_tpl_vars['EXLIST'][$this->_tpl_vars['myid']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['elclai']):
?>
				<tr>
					<td>
						<?php if ($this->_tpl_vars['elclai']['idstat'] == 0): ?>
							<img src="images/print.gif" title="отпечати" style="cursor:pointer" onclick="fup2('<?php echo $this->_tpl_vars['elclai']['printid']; ?>
/');">
						<?php endif; ?>
					</td>
				</tr>
		<?php endforeach; endif; unset($_from); ?>
		</table>
	<?php endif; ?> 
</td>

	<td class='sep'>&nbsp;</td>
<td align=center>
								<?php $this->assign('isoldway', false);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofinaendd.tpl", 'smarty_include_vars' => array('INCASE' => true,'isoldway' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


	<td class='sep'>&nbsp;</td>
<td align=left>
			<?php if (empty ( $this->_tpl_vars['elem']['datebala'] )): ?>
				<?php $this->assign('daco', "въведи дата"); ?>
				<?php $this->assign('dast', 'finahistno'); ?>
			<?php else: ?>
				<?php $this->assign('daco', ((is_array($_tmp=$this->_tpl_vars['elem']['datebala'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y"))); ?>
				<?php $this->assign('dast', 'finahist'); ?>
			<?php endif; ?>
																												<?php if ($_SESSION['VIEWFLAG_FINANOEDIT']):  echo $this->_tpl_vars['daco']; ?>

														<?php else: ?>
		<?php if ($this->_tpl_vars['elem']['isclosed'] == 1): ?>
<a href="caseeditzone.php<?php echo $this->_tpl_vars['elem']['date']; ?>
" class="nyroModal" target="_blank">
<nobr>
<span class="<?php echo $this->_tpl_vars['dast']; ?>
" title="корегирай датата"> <?php echo $this->_tpl_vars['daco']; ?>

</span>
</nobr>
</a>
		<?php else: ?>
&nbsp;
		<?php endif; ?>
														<?php endif; ?>
</td>

	<td class='sep'>&nbsp;</td>
<td bgcolor=#dddddd style="border-bottom: 1px solid black;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofinadist.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php if ($this->_tpl_vars['elem']['coundate'] > 1): ?>
<td rowspan=<?php echo $this->_tpl_vars['elem']['coundate']; ?>
 bgcolor=#eeeedd style="border-bottom: 1px solid black;border-left: 1px solid black;">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cazofinadate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>
		
		</tr>
		<?php endforeach; endif; unset($_from); ?>	

											<?php $this->assign('first', true); ?>
		<?php $_from = $this->_tpl_vars['ARSUDEBT']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
					<tr>
<td align=right class="recapitulation"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td class='sep'>&nbsp;</td>
<td align=left class="recapitulation" colspan=5> общо от 
				<?php if (empty ( $this->_tpl_vars['elem']['name'] )): ?>
<font color="red">неопределен</font>
				<?php else:  echo $this->_tpl_vars['elem']['name']; ?>

				<?php endif; ?>
<td class='sep'>&nbsp;</td>
											<?php if ($this->_tpl_vars['first']): ?>
												<?php $this->assign('first', false); ?>
<td align=center class="recapitulation" rowspan=<?php echo $this->_tpl_vars['ARSUDEBTLEN']; ?>
 colspan=5> 
<font size=+1><b><?php echo ((is_array($_tmp=$this->_tpl_vars['SUTOTA'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
</b></font>
<br> общо внесени
<td class='sep'>&nbsp;</td>
<td class="recapitulation" rowspan=<?php echo $this->_tpl_vars['ARSUDEBTLEN']; ?>
 colspan=9> 
			<table align=center cellspacing=0 cellpadding=0 style="font:normal 7pt verdana;">
			<?php $_from = $this->_tpl_vars['CLAILIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['clainame']):
?>
			<tr>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUDIRE'][$this->_tpl_vars['idclai']])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td align=left> за <?php echo $this->_tpl_vars['clainame']; ?>

			<?php endforeach; endif; unset($_from); ?>
			<?php $_from = $this->_tpl_vars['ARDIREINDX']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['direindx'] => $this->_tpl_vars['diretx']):
?>
			<tr>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUDIRE'][$this->_tpl_vars['direindx']])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

<td align=left> <?php echo $this->_tpl_vars['diretx']; ?>

			<?php endforeach; endif; unset($_from); ?>
			</table>
											<?php else: ?>
											<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>	

	</tbody>

									<?php if (empty ( $this->_tpl_vars['ARACTI'] )): ?>
									<?php else: ?>
					<tr>
<td colspan=100>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_listtabl.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<table class="list" align=left>
					<tr>
<td class="title" colspan=200> фактури за т.26
					<tr>
<td class="mark"> сума
<td class="mark"> фактура
<td class="mark"> получател
<td class="mark"> 
<td class="mark"> сметка
<td class="mark"> 
<?php $_from = $this->_tpl_vars['ARACTI']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idelem'] => $this->_tpl_vars['elem']):
?>
					<tr>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['txtota'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

												<?php if (empty ( $this->_tpl_vars['elem']['idbillelem'] )): ?>
<td align=center> 
<img src="images/adda.gif" title="формирай фактура/сметка" style="cursor:pointer;" onclick="crinvo('<?php echo $this->_tpl_vars['idelem']; ?>
',1);">
<td> &nbsp;
<td> &nbsp;
<td> &nbsp;
<td> &nbsp;
					<?php else: ?>
<td align=right>
							<?php if ($this->_tpl_vars['elem']['idbillorig'] == 0): ?>
<span style="font:normal 7pt verdana;background-color:gold">изтрита<br>фактура</span>
							<?php else: ?>
						<?php if ($this->_tpl_vars['elem']['seriinvo'] == 0): ?>
проф.<?php echo $this->_tpl_vars['elem']['seriprof']; ?>
/<?php echo $this->_tpl_vars['elem']['invodate']; ?>

						<?php else:  echo $this->_tpl_vars['elem']['seriinvo']; ?>
/<?php echo $this->_tpl_vars['elem']['invodate']; ?>

						<?php endif; ?>
							<?php endif; ?>
<td> <?php echo $this->_tpl_vars['elem']['billname']; ?>

<td> 
<a href="#" onclick="fuprinfina('caseeditzone.php<?php echo $this->_tpl_vars['elem']['prininvo']; ?>
'); return false;"> 
<img src="images/print.gif" title="отпечати фактурата">
</a>
<td align=right> <?php echo $this->_tpl_vars['elem']['seribill']; ?>

<td>
<a href="#" onclick="fuprinfina('caseeditzone.php<?php echo $this->_tpl_vars['elem']['prinbill']; ?>
'); return false;"> 
<img src="images/printmult.gif" title="отпечати сметка <?php echo $this->_tpl_vars['elem']['seribill']; ?>
">
</a>
					<?php endif;  endforeach; endif; unset($_from); ?>
					</table>
									<?php endif; ?>
</table>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
	$('a.nyroModal').nyroModal({width:520, height:400});
	$('.ttip').cluetip({ width: 300, local:true, cursor:'pointer' });
	$('.stat2aaa').cluetip({ width: 600, local:true, cursor:'pointer' });
$('.info').cluetip({ width: 360, cursor:'help' });
$('.dechan').cluetip({
//	cluetipClass: 'rounded', 
	arrows: true, 
	width: 200,
	sticky: true,
	mouseOutClose: true,
	closeText: '<b>x</b>',
	closePosition: 'title'
	});
});
function fup2(p1){
	fuprin("/../tranprnt.php?para="+p1);
}
function graction(){
	var lico= cbcoun();
	if (lico==""){
	}else{
//alert(lico);
		$.nyroModalManual({
			url: 'cazofinaclosgr.ajax.php?para='+lico.substr(1)
			,forceType: 'iframe'
			});	
	}
}
function setgrimg(){
	var lico= cbcoun();
	if (lico==""){
		$("#grimg").hide();
	}else{
		$("#grimg").show();
	}
}
function cbcoun(){
	var list= $("input[@rela='cbfina']");
	var lico= "";
//	var lico= 0;
	for (var i=0; i<list.length; i++){
		if (list[i].checked){
			lico += "/"+list[i].id.substr(6);
//			lico += 1;
		}else{
		}
	}
//alert(lico);
return lico;
}

function proc4(p1){
		jQuery.ajax({
			url: "cazofinaigno.ajax.php?f="+p1
			,success: succ2
			});
}
function succ2(data){
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){
$('#tpaymlink').click();
$('#tactulink').click();
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}

function crinvo(pref,flag){
		jQuery.ajax({
			url: "txelinvo.ajax.php?p1="+pref+"&p2="+flag
			,success: function(data){
//alert(data);
					if (data=="ok"){
$.nyroModalManual({forceType:'iframe', url:'caseeditzone.php<?php echo $this->_tpl_vars['CREAINVOLINK']; ?>
'});
					}else{
alert("ERROR"+String.fromCharCode(10)+data);
					}
			}
		});
}
</script>

<iframe id="idprinfina" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fuprinfina(p1){
	document.getElementById("idprinfina").focus();
	document.getElementById("idprinfina").src= p1;
}
function fuprinfinaall(){
		jQuery.ajax({
			url: "cazofinapall.ajax.php?c=<?php echo $this->_tpl_vars['IDCASE']; ?>
"
			,success: function(data){fuprinfina("finaprnt.php?para="+data);}
		});
}
</script>