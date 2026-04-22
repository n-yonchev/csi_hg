<?php /* Smarty version 2.6.9, created on 2020-02-27 13:14:25
         compiled from finainvoedit.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'finainvoedit.ajax.tpl', 3, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>	
				<?php $this->assign('myti', ((is_array($_tmp=((is_array($_tmp='въведи за нова фактура (евент.номер ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['MXINVO']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['MXINVO'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ')') : smarty_modifier_cat($_tmp, ')'))); ?>
			<?php else: ?>
				<?php $this->assign('myti', ((is_array($_tmp='корегирай фактура ')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['SERIINVO']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['SERIINVO']))); ?>
			<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.header.tpl", 'smarty_include_vars' => array('TITLE' => $this->_tpl_vars['myti'])));
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
<td colspan=4> 
дата
<input type="text" name="invodate" id="invodate" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invodate','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
тип фактура 
									<?php if ($this->_tpl_vars['EDIT'] == 0): ?>
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
<input type="text" name="seriprof" id="seriprof" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'seriprof','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
		</span>
		<tr>
<td colspan=4>
<input type="checkbox" name="invoisva" id="invoisva" label="ДДС"
	<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>
onclick="calcul();"
	<?php else: ?>
	<?php endif; ?>
>
&nbsp;&nbsp;&nbsp;&nbsp;
обща сума <b><span id="sumatota"><?php echo $this->_tpl_vars['SUMATOTA']; ?>
</span></b>
&nbsp;&nbsp;&nbsp;&nbsp;
платена сума
<input type="text" name="invopaid" id="invopaid" size=14 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invopaid','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
&nbsp;&nbsp;&nbsp;&nbsp;
		<tr>
<td colspan=4>
<nobr>
метод на плащане
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARMETHNAME'],'ID' => 'invometh','C1' => 'input','C2' => 'inputer','ONCH' => "chuscash();")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</nobr>
<nobr>
<span rela="uscash"> платено на
<span rela="uscash"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['USERLISTNAME'],'ID' => 'cashiduser','C1' => 'input7','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</nobr>
		<tr>
<td colspan=4>
IBAN на ЧСИ като съставител на фактура/сметка
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARSELENAME'],'ID' => 'iban','C1' => 'iban','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							<?php if ($this->_tpl_vars['PAIDER']): ?>
		<tr>
<td colspan=4>
<font color=red>платената сума надвишава общата</font>
							<?php else: ?>
							<?php endif; ?>
		<tr>
<td colspan=4 align=center bgcolor=silver> данни за получателя
		<tr>
<td> име
<td> 
<input type="text" name="invoname" id="invoname" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invoname','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td rowspan=4> 
адрес
<br>
<textarea name="invoaddr" id="invoaddr" rows=4 cols=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invoaddr','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>></textarea>
		<tr>
<td> ЕГН
<td> 
<input type="text" name="invoegn" id="invoegn" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invoegn','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
		<tr>
<td> ЕИК
<td> 
<input type="text" name="invoeik" id="invoeik" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invoeik','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
		<tr>
<td> МОЛ
<td> 
<input type="text" name="invopers" id="invopers" size=40 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'invopers','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<td>
		</table>







			<?php if ($this->_tpl_vars['EDIT'] <= 0): ?>	
<script>
function rocopy(obje){
	var obj2= $("#row0").clone().show().appendTo("#tab0");
	obj2.children(":first").children(":first")
		.bind("blur",function(){rocopy(this);});
	obj2.find("[name^=quan]").bind("keyup",function(){calcul();});
	obj2.find("[name^=pric]").bind("keyup",function(){calcul();});
	if (obje){$(obje).unbind("blur");}
resizeNyroModalIframe();
}

function calcul(){
//alert('calcul');
	var vatche= $("#invoisva").attr("checked");
	var isva= (vatche) ? 1:0;
//alert(isva);
	var arra= $(":text[name^=quan]",document.forms[0]);
	var a1= "";
	arra.each(function(i){
		a1 += ","+$(this).attr("value");
	});
	var arra= $(":text[name^=pric]",document.forms[0]);
	var a2= "";
	arra.each(function(i){
		a2 += ","+$(this).attr("value");
	});
//alert(a1+"^"+a2);
//alert(arra);
	jQuery.ajax({
		url: "finainvoeditsuma.ajax.php?p="+isva+"^"+a1+"^"+a2
		,success: succ2
		});
}

function succ2(data){
//alert(data);
	var arre= data.split("^");
	var ok= arre[0];
	var sumaform= arre[1];
	var suma= arre[2];
	if (ok=="ok"){
$("#sumatota").text(sumaform);
$("#invopaid").attr("value",suma);
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>
					<table id="tab0">
					<tr>
<td colspan=4 align=center bgcolor=silver> редове на фактурата
					<tr>
<td> описание
<td> мярка
<td> колич
<td> ед.цена
<?php $_from = $_POST['desc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['x1']):
?>
		<?php if ($this->_tpl_vars['key'] == 0): ?>
					<tr class="tabrow" id="row0" style="display:none">
<td>
<textarea name="desc[]" rows=2 cols=50 value=""></textarea>
<td valign=top> <input type=text name="meas[]" value="" size=10>
<td valign=top> <input type=text name="quan[]" value="" size=10>
<td valign=top> <input type=text name="pric[]" value="" size=10>
					</tr>
		<?php else: ?>
					<tr class="tabrow">
					<?php $this->assign('iddesc', ((is_array($_tmp='desc_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key']))); ?>
					<?php $this->assign('idmeas', ((is_array($_tmp='meas_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key']))); ?>
					<?php $this->assign('idquan', ((is_array($_tmp='quan_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key']))); ?>
					<?php $this->assign('idpric', ((is_array($_tmp='pric_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key']))); ?>
<td>
<textarea name="desc[<?php echo $this->_tpl_vars['key']; ?>
]" id="<?php echo $this->_tpl_vars['iddesc']; ?>
" rows=2 cols=50 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['iddesc'],'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['key'] == count ( $_POST['desc'] ) -1): ?>
onblur="rocopy(this);"
			<?php else: ?>
			<?php endif; ?>
></textarea>
<td valign=top> <input type=text name="meas[<?php echo $this->_tpl_vars['key']; ?>
]" id="<?php echo $this->_tpl_vars['idmeas']; ?>
" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['idmeas'],'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<td valign=top> <input type=text name="quan[<?php echo $this->_tpl_vars['key']; ?>
]" id="<?php echo $this->_tpl_vars['idquan']; ?>
" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['idquan'],'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onkeyup="calcul();"
>
<td valign=top> <input type=text name="pric[<?php echo $this->_tpl_vars['key']; ?>
]" id="<?php echo $this->_tpl_vars['idpric']; ?>
" size=10 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => $this->_tpl_vars['idpric'],'C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
onkeyup="calcul();"
>
					</tr>
		<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
					</table>
			<?php else: ?>
			<?php endif; ?>

<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'запиши','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
function fuprof(obje){
	var valu= $(obje).get(0).options[$(obje).get(0).selectedIndex].value;
	if (valu==1){
//alert(valu);
		$("#profno").show();
	}else{
		$("#profno").hide();
	}
}
$(document).ready(function() {
	fuprof($("#idinvotype"));
})

chuscash();
function chuscash(){
	var obje= $("#invometh");
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
$this->_smarty_include(array('smarty_include_tpl_file' => "_window.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>