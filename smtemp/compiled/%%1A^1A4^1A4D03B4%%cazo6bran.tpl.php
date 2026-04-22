<?php /* Smarty version 2.6.9, created on 2020-02-27 13:01:15
         compiled from cazo6bran.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'cazo6bran.tpl', 69, false),)), $this); ?>

<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
href="#" onclick="checkon();return false;"> <nobr>всички да</nobr> </a>
&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
href="#" onclick="checkoff();return false;"> <nobr>всички не</nobr> </a>
<br>
<script type="text/javascript" src="js/jq.checkbox.js"></script>
<script>
function checkon(){
//	$("input[@type='checkbox']").check("on");
	$("input[@rela='mycblist']").check("on");
				putsuma();
}
function checkoff(){
//	$("input[@type='checkbox']").check("off");
	$("input[@rela='mycblist']").check("off");
				putsuma();
}
$(document.forms[0]).bind("submit",function(){
			couyes= getchecked();
	if (couyes==0){
alert("няма избран елемент от списъка");
return false;
	}else{
return true;
	}
});
function getchecked(){
				var couyes= 0;
	$("input[@rela='mycblist']").each(function(){
		if (this.checked){
				couyes ++;
		}else{
		}
	});
//alert(couyes);
return couyes;
}
function putsuma(){
				<?php if ($this->_tpl_vars['ISREGITAX']): ?>
	couyes= getchecked();
//alert('putsuma='+couyes);
		var re= new RegExp(tempmark,"g")
		var myco= retext.replace(re,couyes);
	$("#regitext").attr("value",myco);
		var mytax= couyes*retax;
		mytax= mytax.toFixed(2);
	$("#regitax").attr("value",mytax);
				<?php else: ?>
				<?php endif; ?>
}
</script>
					<table>
					<tr>
						<?php echo smarty_function_counter(array('start' => $this->_tpl_vars['COUNTPERCOL'],'assign' => 'mycoun'), $this);?>

	<?php $_from = $this->_tpl_vars['ARBRAN']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['branid'] => $this->_tpl_vars['branname']):
?>
						<?php echo smarty_function_counter(array('assign' => 'mycoun'), $this);?>

						<?php if ($this->_tpl_vars['mycoun'] <= $this->_tpl_vars['COUNTPERCOL']): ?>
						<?php else: ?>
							<?php echo smarty_function_counter(array('start' => 1,'assign' => 'mycoun'), $this);?>

					<td valign=top>
						<?php endif; ?>
<nobr>
<input type="checkbox" class="input" name="branlist[]" value="<?php echo $this->_tpl_vars['branid']; ?>
" label="<?php echo $this->_tpl_vars['branname']; ?>
" rela="mycblist" onclick="putsuma();">
</nobr>
<br/>
	<?php endforeach; endif; unset($_from); ?>
					</table>