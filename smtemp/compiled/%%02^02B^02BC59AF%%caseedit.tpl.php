<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:44
         compiled from caseedit.tpl */ ?>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE']):  $this->assign('scname', "caseeditzoneno.php"); ?>
				<?php if ($this->_tpl_vars['FLAGYESSTAT']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tabslist.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['GOOUT'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php else: ?>
				<?php endif; ?>
			<?php else:  $this->assign('scname', "caseeditzone.php"); ?>
				<?php if ($this->_tpl_vars['FLAGNOTABS']): ?>
				<?php else:  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tabslist.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['GOOUT'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			<?php endif; ?>

				<span id="region1" style="display: none">
<a class="ajaxify" id="tbaselink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['base']; ?>
" target="#tbase"> notfull </a>
<a class="ajaxify" id="t1link" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][1]; ?>
" target="#t1"> var.1 </a>
<a class="ajaxify" id="t2link" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][2]; ?>
" target="#t2"> var.2 </a>
<a class="ajaxify" id="t3link" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][3]; ?>
" target="#t3"> var.3 </a>
<a class="ajaxify" id="t4link" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][4]; ?>
" target="#t4"> var.4 </a>
<a class="ajaxify" id="tpaymlink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['paym']; ?>
" target="#tpaym"> payments </a>
										<a class="ajaxify" id="tactulink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['actu']; ?>
" target="#tactu"> actu.debt </a>
<a class="ajaxify" id="t5link" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][5]; ?>
" target="#t5"> var.5 </a>
<a class="ajaxify" id="t6link" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][6]; ?>
" target="#t6"> var.6 </a>
<a class="ajaxify" id="tjourlink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['jour']; ?>
" target="#tjour"> journal </a>
<a class="ajaxify" id="tbilllink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['bill']; ?>
" target="#tbill"> сметки </a>
<a class="ajaxify" id="tnotelink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['note']; ?>
" target="#tnote"> бележки </a>
<a class="ajaxify" id="tevenlink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['even']; ?>
" target="#teven"> събития </a>
<a class="ajaxify" id="tadvalink" href="<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS']['adva']; ?>
" target="#tadva"> аванс.вноски </a>
</span>

<table align=center>

				<?php if ($this->_tpl_vars['FLAGBACK']): ?>
<tr><td colspan=10 align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> назад към списъка </a>
				<?php else: ?>
				<?php endif; ?>

				<?php if (isset ( $this->_tpl_vars['PAGEBACKLINK'] )): ?>
<tr><td colspan=10 align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['PAGEBACKTEXT']; ?>
 </a>
				<?php else: ?>
				<?php endif; ?>
			<?php if ($this->_tpl_vars['FLAGNOCHANGE'] || $this->_tpl_vars['FLAGNOTABS']): ?>
<tr><td colspan=10 align=left>
<div id="caseheader" style="font: normal 8pt verdana;" align=right></div>
			<?php else: ?>
			<?php endif; ?>

																		<?php if ($this->_tpl_vars['MAINPLAN'] == 'var1'): ?>


<tr><td>
								
	<table width=100%>
								<tr>
<td colspan=20 id="tbase" class="tdzone" valign=top align=left> непълни
	<tr>
<td id="t1" class="tdzone" valign=top align=left rowspan=2> основни
<td width=4 rowspan=2>
<td id="t3" class="tdzone" valign=top align=left> взискатели
<td width=4>
<td id="t4" class="tdzone" valign=top align=right> длъжници
<td width=4>
<td id="tadva" class="tdzone" valign=top align=left> аванс.вноски
	<tr>
<td id="tnote" class="tdzone" valign=top align=left> бележки
<td width=4>
<td id="teven" class="tdzone" valign=top align=left> събития
	</table>


<tr><td>
	<table width=100%>
	<tr>
<td id="t2" class="tdzone" valign=top align=right> предмет
<td width=4>
					<td class="tdzone" valign=top align=right> 
<div id="tpaym"> плащания </div>
					<br>
					<div id="tactu">актуален дълг</div>
<tr><td>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "caseeditpoff.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr><td colspan=8>
<span align=left id="t7" class="tdzone" valign=top align=left style="display: none;"> погасяване </span>
	</table>
<tr><td>
	<table width=100%>
	<tr>
<td id="t5" class="tdzone" valign=top align=left> входящи
<td width=4>
<td id="t6" class="tdzone" valign=top align=right> изходящи
	</table>

<tr><td>
	<table width=100%>
	<tr>
<td id="tjour" class="tdzone" valign=top align=left> изв.дейст.
<td width=4>
<td id="tbill" class="tdzone" valign=top align=left> сметки
	</table>
									
									<?php else: ?>

<tr><td align=left> 

						<table>
						<tr>
						<td align=left valign=top>
<div id="tbase">непълни</div>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
			<table cellspacing=0 cellpadding=0>
			<tr>
			<td align=left valign=top rowspan=3>
<div id="t1">основни</div>
			<td align=left valign=top rowspan=3>
&nbsp;
			<td align=left valign=top>
<div id="t3">взискатели</div>
			<tr>
			<td align=left valign=top>
<div id="t4">длъжници</div>
			<tr>
			<td align=left valign=top>
<div id="tadva">аванс.вноски</div>
			</table>
			<table cellspacing=0 cellpadding=0>
			<tr>
			<td align=left valign=top bgcolor="#dddddd">
<div id="tnote" alte="ALTE">бележки</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 'tnotealte','P2' => 'tnote','P3' => "бележки")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<td width=4>
			<td align=left valign=top bgcolor="#dddddd">
<div id="teven" alte="ALTE">събития</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 'tevenalte','P2' => 'teven','P3' => "събития")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t2" alte="ALTE">предмет</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 't2alte','P2' => 't2','P3' => "предмет на изпълнение")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tpaym" alte="ALTE">постъпления</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 'tpaymalte','P2' => 'tpaym','P3' => "постъпления")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tactu" alte="ALTE">акт.дълг</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 'tactualte','P2' => 'tactu','P3' => "актуален дълг")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "caseeditpoff.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t7" style="display: none;">погасяване</div>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t5" alte="ALTE">входящи</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 't5alte','P2' => 't5','P3' => "входящи документи")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="t6" alte="ALTE">изходящи</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 't6alte','P2' => 't6','P3' => "изходящи документи")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tjour" alte="ALTE">действия</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 'tjouralte','P2' => 'tjour','P3' => "извършени действия")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<tr>
						<td align=left valign=top bgcolor="#dddddd">
<div id="tbill" alte="ALTE">сметки</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_cazoalte.tpl", 'smarty_include_vars' => array('P1' => 'tbillalte','P2' => 'tbill','P3' => "сметки")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</table>

																		<?php endif; ?>

</table>

<script type="text/javascript">
var t7url= "<?php echo $this->_tpl_vars['scname'];  echo $this->_tpl_vars['URLLIS'][7]; ?>
";
</script>








<script type="text/javascript">
function toggle(paobje,paeven){
var event= (paeven) ? paeven : window.event;
event.cancelBubble= true;
	var node, text= "";
	var pare;
	var obje= paobje;
	while (true){
//		pare= obje.offsetParent;
//		pare= obje.parentElement;
//		pare= obje.parent;
		pare= obje.parentNode;
		if (pare){
			obje= pare;
//alert("id="+obje.id);
			if ($(obje).attr("alte")){
//alert("alte="+obje.alte);
//alert("alte="+$(obje).attr("alte"));
text= $(obje).attr("alte");
node= obje;
				break;
			}else{
			}
		}else{
			break;
		}
	}
	if (text==""){
	}else{
//node.innerHTML= text;
//$(node).html("<a href='#'>"+text+"</a>").bind("click",function(){alert('AWECF');});
//alert(node.id);
$(node).hide();
$("#"+$(node).attr("id")+"alte").show();
	}
}
function turnon(paobje,paid){
	$(paobje).hide();
	$("#"+paid).show();
}
</script>