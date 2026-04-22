<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:45
         compiled from cazo2x2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomo4', 'cazo2x2.tpl', 21, false),array('modifier', 'tomoney', 'cazo2x2.tpl', 71, false),)), $this); ?>
<style>
.x2 td {font:normal 8pt verdana;background-color:beige;}
.h2 {font:normal 8pt verdana;background-color:tan !important;}
.warn {background-color:#ff9999 !important;}
</style>
		<?php if (isset ( $this->_tpl_vars['FORCLINK'] )): ?>
					<table width=100% cellspacing=0 cellpadding=0>
					<tr>
<td class="warn">
предметите не са трансформирани според ДВ-86/17
					</table>
		<?php else: ?>
					<table cellspacing=0 cellpadding=0>
					<tr>
<td valign=top>
							<table class="x2">
					<tr>
<td colspan=10 class="h2"> изчислени параметри
					<tr>
<td> задължение
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARX2PARA']['debt'])) ? $this->_run_mod_handler('tomo4', true, $_tmp) : smarty_modifier_tomo4($_tmp)); ?>
</b>
					<tr>
<td> мин.работна заплата 
<td align=right> <b><?php echo ((is_array($_tmp=$this->_tpl_vars['ARX2PARA']['mins'])) ? $this->_run_mod_handler('tomo4', true, $_tmp) : smarty_modifier_tomo4($_tmp)); ?>
</b>
					<tr>
<td> група
<td align=right> <b><?php echo $this->_tpl_vars['ARX2GRVISU'][$this->_tpl_vars['ARX2PARA']['idgrou']]; ?>
</b>
							</table>

<td> &nbsp;
<td valign=top>
							<table class="x2">
							<tr>
<td class="h2"> параметър
<td class="h2" align=right> ориг<br>сума
<td class="h2" align=right> въвед<br>сума
<td class="h2"> ограничение
<td class="h2" align=right> таван
<td class="h2"> из<br>пъл
							<tr>
<?php $_from = $this->_tpl_vars['ARX2VISU']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['codepara'] => $this->_tpl_vars['ar2']):
?>
	<?php $_from = $this->_tpl_vars['ar2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
							<tr>
<td> <?php echo $this->_tpl_vars['elem']['text']; ?>

<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['orig'])) ? $this->_run_mod_handler('tomo4', true, $_tmp) : smarty_modifier_tomo4($_tmp)); ?>

<td align=right
			<?php if (isset ( $this->_tpl_vars['elem']['linkinpu'] )): ?>
id="<?php echo $this->_tpl_vars['elem']['code']; ?>
"
style="background-color:silver;cursor:pointer;" title="корегирай" onclick="fuinpu('<?php echo $this->_tpl_vars['elem']['linkinpu']; ?>
','<?php echo $this->_tpl_vars['elem']['code']; ?>
');"
			<?php else: ?>
			<?php endif; ?>
> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['inpu'])) ? $this->_run_mod_handler('tomo4', true, $_tmp) : smarty_modifier_tomo4($_tmp)); ?>

					<?php if ($this->_tpl_vars['codepara'] == 't26'): ?>
<td colspan=6> резерв за т.26 <span class="<?php if ($this->_tpl_vars['elem']['rese2'] < 0): ?>sut9<?php else: ?>sut6<?php endif; ?>">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['rese2'])) ? $this->_run_mod_handler('tomoney', true, $_tmp) : smarty_modifier_tomoney($_tmp)); ?>
&nbsp;</span>
						<?php if ($this->_tpl_vars['elem']['rese2']+0 == 0): ?>
						<?php else: ?>
							<?php if ($this->_tpl_vars['elem']['setto']+0 < 0): ?>
							<?php else: ?>
&nbsp;
<img src="images/toedit.gif" title="трансформирай т.26=<?php echo $this->_tpl_vars['elem']['setto']; ?>
" style="cursor:pointer;" 
onclick="tran26('<?php echo $this->_tpl_vars['T26SETTO']; ?>
');">
							<?php endif; ?>
						<?php endif; ?>
					<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['limitext'];  if (isset ( $this->_tpl_vars['elem']['formargu'] )): ?>=<?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['formargu'])) ? $this->_run_mod_handler('tomo4', true, $_tmp) : smarty_modifier_tomo4($_tmp));  if ($this->_tpl_vars['elem']['isvatt']):  echo $this->_tpl_vars['X2VATTEXT'];  else:  endif;  else:  endif; ?>
<td align=right> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['limi'])) ? $this->_run_mod_handler('tomo4', true, $_tmp) : smarty_modifier_tomo4($_tmp)); ?>

			<?php if (! isset ( $this->_tpl_vars['elem']['okflag'] )): ?>
<td> &nbsp;
			<?php elseif ($this->_tpl_vars['elem']['okflag']): ?>
<td class="sut6" title="ограничението е изпълнено"> &nbsp;
			<?php else: ?>
<td class="sut9" title="ограничението НЕ Е ИЗПЪЛНЕНО"> &nbsp;
			<?php endif; ?>
					<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
							</table>

<iframe id="framinpu" width=140 height=80 frameborder=0 style="position:absolute;display:none;"></iframe>
<a id="fihide" style="display:none;" href="#" onclick="$('#framinpu').hide();"></a>
<script>
function fuinpu(p1,pcod){
	var obfram= document.getElementById("framinpu");
	obfram.src= "cazo2c.php"+p1;
	obfram.focus();
	moveobje(pcod,80,"framinpu");
	$(obfram).show();
}
</script>

<script>
function moveobje(idfiel,offset,idobje){
				var o1= document.getElementById(idfiel);
				var o1sum= getOffsetSum(o1);
					var obje= top.document.getElementById(idobje);
					obje.style.top= o1sum.top+"px";
					obje.style.left= Math.round(o1sum.left+offset)+"px";
//alert(obje.style.top+'/'+obje.style.left);
}
function getOffsetSum(elem){
    var top=0, left=0
    while(elem){
        top = top + parseFloat(elem.offsetTop)
        left = left + parseFloat(elem.offsetLeft)
        elem = elem.offsetParent        
    }
return {top: Math.round(top), left: Math.round(left)}
}

function tran26(p1){
		jQuery.ajax({
			url: "cazo2tran26.php?p1="+p1
			,success: function(data){
					if (data=="ok"){
refr4();
					}else{
alert("ERROR"+String.fromCharCode(10)+data);
					}
			}
		});
}
function refr4(){
	$("#t2link").click();
	$("#tactulink").click();
	$("#tadvalink").click();
	$("#t1link").click();
}
</script>

					</table>
		
				<?php endif; ?>
