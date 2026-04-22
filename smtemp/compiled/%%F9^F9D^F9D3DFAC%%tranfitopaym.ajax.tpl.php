<?php /* Smarty version 2.6.9, created on 2020-02-28 11:03:48
         compiled from tranfitopaym.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', 'tranfitopaym.ajax.tpl', 34, false),array('modifier', 'cat', 'tranfitopaym.ajax.tpl', 71, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => "прехвърляне към списъка с преводи",'WITDH' => 840)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.trow {font: normal 8pt verdana;border-bottom: 1px solid black;}
.pseu {font: normal 8pt verdana; color:red;}
</style>

																<?php if (count ( $this->_tpl_vars['ARCONS'] ) == 0): ?>
Няма суми за превод по дело <b><?php echo $this->_tpl_vars['ROCASE']['serial']; ?>
/<?php echo $this->_tpl_vars['ROCASE']['year']; ?>
</b>
<br>
Вероятно всички суми вече са прехвърлени в списъка с готови за превод.
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'обнови списъка','NAME' => 'submit2','ID' => 'submit2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
																<?php else: ?>

Ще прехвърлите към списъка за превод следните обобщени суми от избраните постъпления по дело <b><?php echo $this->_tpl_vars['ROCASE']['serial']; ?>
/<?php echo $this->_tpl_vars['ROCASE']['year']; ?>
</b> :
<br>
		<table align=center>
								<tr class="trow" bgcolor=silver>
<td align=center> сума
<td> взискател
<td> iban
<td align=center> ме<br>тод
<td> сумата да се преведе<br>от банка
<td> пълно<br>пога<br>сяване
<td> rings
<?php $_from = $this->_tpl_vars['ARCONS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idclai'] => $this->_tpl_vars['elem']):
?>
								<tr>
<td class="trow" align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>

			<?php if ($this->_tpl_vars['idclai'] <= 0 && $this->_tpl_vars['idclai'] <> -1): ?>
<td class="trow pseu"> <?php echo $this->_tpl_vars['elem']['clainame']; ?>
&nbsp;
			<?php else: ?>
<td class="trow"> <?php echo $this->_tpl_vars['elem']['clainame']; ?>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['idclai'] <= 0 && $this->_tpl_vars['idclai'] <> -1): ?>
<td class="trow pseu"> ОК
			<?php elseif (empty ( $this->_tpl_vars['elem']['iban'] )): ?>
<td class="no"> липсва
			<?php else: ?>
<td class="trow"> <?php echo $this->_tpl_vars['elem']['iban']; ?>
&nbsp;
					<?php if ($this->_tpl_vars['elem']['ibaniser']): ?>
<span class="no">грешен</span>
					<?php else: ?>
					<?php endif; ?>
			<?php endif; ?>
<td class="trow" align=center style="cursor:pointer;" onclick="etog(<?php echo $this->_tpl_vars['idclai']; ?>
)"> 
<span id="s<?php echo $this->_tpl_vars['idclai']; ?>
"><?php echo $this->_tpl_vars['ARMETH'][$this->_tpl_vars['elem']['idmeth']]; ?>
</span>
			<input type="hidden" size=3 name="idmeth_<?php echo $this->_tpl_vars['idclai']; ?>
" id="idmeth_<?php echo $this->_tpl_vars['idclai']; ?>
" value="<?php echo $this->_tpl_vars['elem']['idmeth']; ?>
">
<td> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_select.tpl", 'smarty_include_vars' => array('FROM' => $this->_tpl_vars['ARBANKPAYMNAME'],'ID' => ((is_array($_tmp='idbank_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['idclai']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['idclai'])),'C1' => 'input')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<td align=center> 
<input type="checkbox" name="isfull_<?php echo $this->_tpl_vars['idclai']; ?>
" id="isfull_<?php echo $this->_tpl_vars['idclai']; ?>
">
<td align=center> 
<input type="checkbox" name="isring_<?php echo $this->_tpl_vars['idclai']; ?>
" id="isring_<?php echo $this->_tpl_vars['idclai']; ?>
">
						<?php if ($this->_tpl_vars['elem']['isbudg'] == 1): ?>
								<tr>
<td>
<td class="trow" colspan=4>
<font color=red> за взискател <?php echo $this->_tpl_vars['elem']['clainame']; ?>
 </font>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "finaclos2budg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
						<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
		</table>

<br>
дата на погасяване за всички постъпления
<br>
<input type="text" name="datebala" id="datebala" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'datebala','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
<br>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'прехвърли','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
							<?php if ($this->_tpl_vars['FROMLISTTOPAYM']): ?>
$(document).ready(function(){
	$("div.wclose_normal").bind("click",function(){
		jQuery.ajax({
			url: "tranfiunlocase.ajax.php"
			,success: function(data){
					if (data=="ok"){
parent.$.nyroModalRemove();
parent.location.reload();
					}else{
alert("ERROR"+String.fromCharCode(10)+data);
					}
			}
		});
	});
});
							<?php else: ?>
							<?php endif; ?>
document.forms[0].onsubmit= function(){
	$('#submit').hide();
return true;
	}
var textmeth= new Array();
	<?php $_from = $this->_tpl_vars['ARMETH']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['indx'] => $this->_tpl_vars['text']):
?>
textmeth[<?php echo $this->_tpl_vars['indx']; ?>
]= "<?php echo $this->_tpl_vars['text']; ?>
";
	<?php endforeach; endif; unset($_from); ?>
function etog(suff){
	var idinpu= "idmeth_"+suff;
	var inva= $("#"+idinpu).attr("value");
	var newinva= parseInt(inva);
	newinva += 1;
	if (newinva==<?php echo $this->_tpl_vars['COUNMETH']; ?>
){
		newinva= 0;
	}else{
	}
	$("#"+idinpu).attr("value",newinva);
	var idspan= "s"+suff;
	$("#"+idspan).text(textmeth[newinva]);
	if (newinva==0){
		$("#idbank_"+suff).show();
		$("#isfull_"+suff).show();
		$("#isring_"+suff).show();
	}else{
		$("#idbank_"+suff).hide();
		$("#isfull_"+suff).hide();
		$("#isring_"+suff).hide();
	}
resizeNyroModalIframe();
}
</script>
																																<?php endif; ?>

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