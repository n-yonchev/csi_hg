<?php /* Smarty version 2.6.9, created on 2020-02-27 13:27:51
         compiled from _tab2pagi.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney2', '_tab2pagi.tpl', 6, false),array('modifier', 'tointe', '_tab2pagi.tpl', 28, false),)), $this); ?>
					<?php $this->assign('mypref', "css/blue/table/"); ?>
					<?php $this->assign('mystyl', "style='cursor:pointer'"); ?>
<tr class='pagi'>
				<?php if (isset ( $this->_tpl_vars['MAINSUMA'] )): ?>
<td>
<td align=right><font color=red> <?php echo ((is_array($_tmp=$this->_tpl_vars['MAINSUMA'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp)); ?>
 </font>
<td><font color=red> общо </font>
				<?php else: ?>
				<?php endif; ?>
<td class='' colspan='160'>
		<table width=100% cellpadding=0 cellspacing=0>
		<tr>
					<?php if (count ( $this->_tpl_vars['PAGIPARA']['PAGELIST'] ) < 2): ?>
					<?php else: ?>
<td align=left style="border:0px solid green;">
						<?php if ($this->_tpl_vars['PAGIPARA']['PAGENO'] == 1): ?>
						<?php else: ?>
<div style="float:left;">
<img src="<?php echo $this->_tpl_vars['mypref']; ?>
button_first_active.gif" <?php echo $this->_tpl_vars['mystyl']; ?>
 onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONFIRST']; ?>
'; return false;" title="първа">
<img src="<?php echo $this->_tpl_vars['mypref']; ?>
button_prev_active.gif" <?php echo $this->_tpl_vars['mystyl']; ?>
 onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONPREV']; ?>
'; return false;" title="предишна">
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
						<?php endif; ?>
<div style="float:left;margin-top:4px;">
стр. <input type='text' name="pageform" id="pageform" value='<?php echo $this->_tpl_vars['PAGIPARA']['PAGENO']; ?>
' style="width:40px;font:bold 7pt verdana; border:0px solid red"
onkeyup="return myautosubm(event,this.form);" autocomplete=off>
&nbsp;&nbsp;
от <?php echo ((is_array($_tmp=$this->_tpl_vars['PAGIPARA']['TOTPAG'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>
 
&nbsp;&nbsp;&nbsp;&nbsp;
</div>
						<?php if ($this->_tpl_vars['PAGIPARA']['PAGENO'] == $this->_tpl_vars['PAGIPARA']['TOTPAG']): ?>
						<?php else: ?>
<div style="float:left;">
<img src="<?php echo $this->_tpl_vars['mypref']; ?>
button_next_active.gif" <?php echo $this->_tpl_vars['mystyl']; ?>
 onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONNEXT']; ?>
'; return false;" title="следваща">
<img src="<?php echo $this->_tpl_vars['mypref']; ?>
button_last_active.gif" <?php echo $this->_tpl_vars['mystyl']; ?>
 onclick="document.location.href='<?php echo $this->_tpl_vars['PAGIPARA']['ONLAST']; ?>
'; return false;" title="последна">
</div>
						<?php endif; ?>
					<?php endif; ?>
<td align=right style="border:0px solid green;">
общо <?php echo ((is_array($_tmp=$this->_tpl_vars['PAGIPARA']['TOTREC'])) ? $this->_run_mod_handler('tointe', true, $_tmp) : smarty_modifier_tointe($_tmp)); ?>
 реда 
		</table>
<script>
function myautosubm(event,obform){
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
//alert("code="+code);
	if (code==13){
//			lipara= {href:document.location.href,page:$("#pageform").attr("value")};
lipara= {panoname:"<?php echo $this->_tpl_vars['PAGIPARA']['PANONAME']; ?>
",href:document.location.href,page:$("#pageform").attr("value")};
			jQuery.ajax({
				url: "pagi.ajax.php"
				,data: lipara
				,type: "post"
				,success: function(data){
//alert(data);
document.location.href= data;
				}
			});
return false;
	}else{
return true;
	}
}
</script>