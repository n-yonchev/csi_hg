<?php /* Smarty version 2.6.9, created on 2020-02-27 15:11:50
         compiled from cazobillmodi.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'cazobillmodi.ajax.tpl', 9, false),array('modifier', 'tomo3', 'cazobillmodi.ajax.tpl', 196, false),array('function', 'counter', 'cazobillmodi.ajax.tpl', 246, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $this->assign('menu', '&nbsp;&nbsp;&nbsp;&nbsp;</span><span id="s1" onclick="togg(1);"> осн.данни 
</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="s2" onclick="togg(2);"> редове </span><span>'); ?>
<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
	<?php $this->assign('_title', ((is_array($_tmp='въведи нова сметка и/или нова фактура ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['menu']))); ?>
<?php else: ?>
	<?php $this->assign('_title', ((is_array($_tmp='корегирай фактура/сметка ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['menu']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['menu']))); ?>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['_title'],'WIDTH' => 600)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
input, textarea, select {border: 1px solid silver}
.link {border-bottom: 1px solid black;cursor:pointer;padding:0px 4px;}
.curr {border-bottom: 1px solid black;cursor:pointer;padding:0px 4px;background-color:moccasin;}
.zone {float:left;border:1px solid black;padding:6px;cursor:pointer}
.zonecurr {background-color:moccasin;}
</style>




											<div id="d1" style="display:none">
			<table>
														<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
											<input type="hidden" name="vari" id="vari"> 
								<?php if (isset ( $this->_tpl_vars['LISTER']['vari'] )): ?>
			<tr>
			<td valign=top colspan=3 class="former">
<?php echo $this->_tpl_vars['LISTER']['vari']; ?>

								<?php else: ?>
								<?php endif; ?>
			<tr>
			<td valign=top colspan=3 id="isprof">
избери вариант 
<?php $_from = $this->_tpl_vars['ARCREA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['increa'] => $this->_tpl_vars['txcrea']):
?>
&nbsp;&nbsp;
<input type="radio" name="typecrea" value='<?php echo $this->_tpl_vars['increa']; ?>
' label="<?php echo $this->_tpl_vars['txcrea']; ?>
">
<?php endforeach; endif; unset($_from); ?>
			<?php if (isset ( $this->_tpl_vars['LISTER']['typecrea'] )): ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><?php echo $this->_tpl_vars['LISTER']['typecrea']; ?>
</font>
			<?php else: ?>
			<?php endif; ?>
			</td>
														<?php else: ?>
														<?php endif; ?>
			<tr>
			<td valign=top>
избери задължено лице 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARNAME'],'ID' => 'codename','C1' => 'input','C2' => 'inputer','ONCH' => "chosen(this);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
или попълни данните за друго задължено лице
<br> име
<br> 
<input type="text" name="name" id="name" size=80 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'name','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br> 
ЕГН
<input type="text" name="egn" id="egn" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'egn','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
&nbsp;&nbsp;&nbsp;&nbsp;
ЕИК
<input type="text" name="eik" id="eik" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'eik','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<span id="addrcoun" style="color:red;"></span>
адрес
<br>
<textarea name="address" id="address" rows=3 cols=70></textarea>
<br>
МОЛ за фактурата
<br>
<input type="text" name="toperson" id="toperson" size=60 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'toperson','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

			<td valign=top width=60> &nbsp;
			<td valign=top>
<input type="checkbox" name="isvat" id="isvat" label="ДДС">
<br>
дата 
<br>
<input type="text" name="date" id="date" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'date','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
тип фактура 
<br>
									<?php if ($this->_tpl_vars['MODIBILL'] == 0): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARINVOTYPESELE'],'ID' => 'idinvotype','C1' => 'input','C2' => 'inputer','ONCH' => "fuprof(this);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php else: ?>
										<?php if ($_POST['idinvotype'] == 1): ?>
<b>проформа</b>
<input type="hidden" name="idinvotype" id="idinvotype"> 
										<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARINVO2SELE'],'ID' => 'idinvotype','C1' => 'input','C2' => 'inputer','ONCH' => "fuprof(this);")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										<?php endif; ?>
									<?php endif; ?>
		<span id="profno" style="display:none">
				<?php if ($this->_tpl_vars['SERIPROFEXIS']): ?>
съществуващ номер
				<?php else: ?>
нов номер
				<?php endif; ?>
<br>
<input type="text" name="seriprof" id="seriprof" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'seriprof','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		</span>
									<?php if (count ( $this->_tpl_vars['LISTELEM'] ) == 0): ?>
<br>
избери шаблон
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTEMP'],'ID' => 'idtemp','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php else: ?>
									<?php endif; ?>
<br>
<br>
<input type="checkbox" name="isdebtor" id="isdebtor" label="във фактурата да се извежда длъжника" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'isdebtor','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<br>
IBAN на ЧСИ като съставител на фактура/сметка
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSELENAME'],'ID' => 'iban','C1' => 'iban','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
основните данни
			</table>
											</div>

											<div id="d2" style="display:none">
											<?php if (count ( $this->_tpl_vars['LISTELEM'] ) == 0): ?>
											<?php else: ?>

				<table align=center>
				<tr>
<td> общо 
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['stot'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b>
<td width=30>
<td> платена сума &nbsp;&nbsp; 
<td> <input type="text" name="paid" id="paid" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'paid','C1' => 'input7','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<td>
<td> <font color=red><?php echo $this->_tpl_vars['PAIDER']; ?>
</font>
				<tr>
<td> ддс
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['svat'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b>
<td width=30>
<td> метод на плащане
<td> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARMETHNAME'],'ID' => 'paidmethod','C1' => 'input7','C2' => 'inputer','ONCH' => "chuscash();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td width=30>
<td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'subm4','ID' => 'subm4')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<tr>
<td> всичко 
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</b>
<td width=30>
<td rela="uscash"> платено на
<td rela="uscash"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['USERLISTNAME'],'ID' => 'cashiduser','C1' => 'input7','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td>
<td> <font color=red><?php echo $this->_tpl_vars['CASHER']; ?>
</font>
				</table>

		<table class="d_table" cellspacing='0' cellpadding='0'>
		<tr class='header'>
<td> № </td>
		<td class='sep'>&nbsp;</td>
<td> действие </td>
		<td class='sep'>&nbsp;</td>
<td> осн. </td>
		<td class='sep'>&nbsp;</td>
<td> мат.<br>инт </td>
		<td class='sep'>&nbsp;</td>
<td> проп.<br>такса </td>
		<td class='sep'>&nbsp;</td>
<td> обик.<br>такса </td>
		<td class='sep'>&nbsp;</td>
<td> доп.<br>разнос </td>
		<td class='sep'>&nbsp;</td>
<td>&nbsp;</td>
		<td class='sep'>&nbsp;</td>
<td>вземи</td>
		<td class='sep'>&nbsp;</td>
<td>спусни<br>преди</td>
		</tr>
		<tbody>
						
						<?php echo smarty_function_counter(array('start' => 0,'print' => false), $this);?>

	<?php $_from = $this->_tpl_vars['LISTELEM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>		
		<tr onmouseover='this.style.backgroundColor="silver";' onmouseout='this.style.backgroundColor="";'>	
<td align=right> <?php echo smarty_function_counter(array(), $this);?>
 </td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['action']; ?>
</td>
		<td class='sep'>&nbsp;</td>			
<td> <?php echo $this->_tpl_vars['elem']['ground']; ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['interest'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['taxprop'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['taxregu'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</td>
		<td class='sep'>&nbsp;</td>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['taxaddi'])) ? $this->_run_mod_handler('tomo3', true, $_tmp) : smarty_modifier_tomo3($_tmp)); ?>
</td>
		<td class='sep'>&nbsp;</td>
<td> 
<nobr>
<a href="#" onclick="dele('<?php echo $this->_tpl_vars['elem']['deleelem']; ?>
'); return false;"><img src="images/free.gif" title="изтрий"></a>
</nobr>
</td>
		<td class='sep'>&nbsp;</td>
<td align=center>
<input type="radio" name="getme" value="<?php echo $this->_tpl_vars['elem']['id']; ?>
"> 		<td class='sep'>&nbsp;</td>
<td align=center>
<input type="radio" name="putme" value="<?php echo $this->_tpl_vars['elem']['id']; ?>
" onclick="$('#submmove').click();"> 		</tr>
	<?php endforeach; endif; unset($_from); ?>
</tbody>
		</table>
<input style="display:none;" type="submit" name="submmove" id="submmove">
											<?php endif; ?>
<br>
добави ред от тип
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARTYPENAME'],'ID' => 'codetype','C1' => 'input','C2' => 'inputer','ONCH' => "rowadd(this.value,'no');")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<div id="typeform"></div>
											</div>

<script>
var ardata= new Array();
			<?php $_from = $this->_tpl_vars['ARNAMEDATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['code'] => $this->_tpl_vars['elem']):
?>
ardata["<?php echo $this->_tpl_vars['code']; ?>
"]= "<?php echo $this->_tpl_vars['elem']; ?>
";
			<?php endforeach; endif; unset($_from); ?>
function chosen(obje){
	var mycode= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	var mydata= ardata[mycode];
//alert(mydata);
	var myar= mydata.split("^");
	$("#egn").attr("value",myar[0]);
	$("#eik").attr("value",myar[1]);
	$("#name").attr("value",myar[2]);
	$("#address").attr("value",myar[3]);
			lipara= {para:mycode};
			jQuery.ajax({
				url: "cazobilladdr.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			})
}
function fusucc(data){
//alert("data="+data);
	var arresu= data.split("^");
	var code= arresu[0];
	var retu= arresu[1];
	if (code=="0"){
//		$("#addr").html(retu);
		if (retu==""){
$("#addrcoun").html("");
		}else{
$("#addrcoun").html("има "+retu+" адреса. нужен е само един.<br>");
		}
	}else{
alert(retu);
	}
	resizeNyroModalIframe();
}
function dele(link){
	if(confirm('потвърди изтриването на реда')) window.location.href=link;
}
function rowadd(pval,post){
	$("#typeform").html("<img src='ajaxload.gif'>");
	$("#typeform").load(encodeURI("cazobilladd.ajax.php?code="+pval+"&post="+post),{},function() {
		resizeNyroModalIframe();
	});
}
				<?php if ($this->_tpl_vars['FLAGER']): ?>
rowadd($("#codetype").attr("value"),"yes");
				<?php else: ?>
				<?php endif; ?>

function togg(pid){
//alert(pid);
	if (pid==1){
			$("#s1").addClass("curr").removeClass("link");
			$("#s2").addClass("link").removeClass("curr");
		$("#d1").show();
		$("#d2").hide();
		$(".wclose_normal").bind("click",function(){
			nyremo();
		});
	}else{
			$("#s1").addClass("link").removeClass("curr");
			$("#s2").addClass("curr").removeClass("link");
		$("#d1").hide();
		$("#d2").show();
		$(".wclose_normal").bind("click",function(){
			$("#subm4").click();
		});
	}
resizeNyroModalIframe();
}

function togzon(pid){
//alert(pid);
	if (pid==1){
			$("#zone1").addClass("zonecurr");
			$("#zone2").removeClass("zonecurr");
		$("#date").attr("value",'<?php echo $this->_tpl_vars['DATE1']; ?>
');
		$("#vari").attr("value",1);
	}else{
			$("#zone2").addClass("zonecurr");
			$("#zone1").removeClass("zonecurr");
		$("#date").attr("value",'<?php echo $this->_tpl_vars['DATE2']; ?>
');
		$("#vari").attr("value",2);
	}
}

function fuprof(obje){
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	if (valu==1){
//alert(valu);
		$("#profno").show();
		$("#isprof").hide();
	}else{
		$("#profno").hide();
		$("#isprof").show();
	}
}

$(document).ready(function() {
				<?php if (isset ( $this->_tpl_vars['TOGGPARA'] )): ?>
	togg(<?php echo $this->_tpl_vars['TOGGPARA']; ?>
);
				<?php else: ?>
	togg(1);
				<?php endif; ?>
											<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
	togzon(1);
											<?php else: ?>
											<?php endif; ?>
	fuprof($("#idinvotype"));
})

chuscash();
function chuscash(){
	var obje= $("#paidmethod");
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
//alert(valu);
	if (valu=="c"){
		$("[@rela=uscash]").show();
	}else{
		$("[@rela=uscash]").hide();
	}
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