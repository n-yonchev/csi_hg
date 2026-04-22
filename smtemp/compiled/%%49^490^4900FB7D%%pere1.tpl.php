<?php /* Smarty version 2.6.9, created on 2020-11-12 11:10:45
         compiled from pere1.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

			<table class="tab2" cellspacing='0' cellpadding='2' align=center>
			<tr class='head2'>
<td colspan='20'> <?php echo $this->_tpl_vars['HEPERE']; ?>

<br> маркирай САМО ТЕЗИ, които са свързани с перемирането
	<?php $_from = $this->_tpl_vars['ARDATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['elem']):
?>
			<tr>
<td id="<?php echo $this->_tpl_vars['id']; ?>
" class="poin" onclick="clic(<?php echo $this->_tpl_vars['id']; ?>
);"> <?php echo $this->_tpl_vars['elem']; ?>

	<?php endforeach; endif; unset($_from); ?>
			</table>

<script>
$(document).ready(function() {
	<?php $_from = $this->_tpl_vars['ARDATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['elem']):
?>
		<?php if (array_search ( $this->_tpl_vars['id'] , $this->_tpl_vars['ARID'] ) === false): ?>
			idoff(<?php echo $this->_tpl_vars['id']; ?>
);
		<?php else: ?>
			idon(<?php echo $this->_tpl_vars['id']; ?>
);
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
});

function acti(paid){
alert(paid);
}

function idon(paid){
	$("#"+paid).addClass("mark").attr("title","ДЕмаркирай");
}
function idoff(paid){
	$("#"+paid).removeClass("mark").attr("title","маркирай");
}

function clic(paid){
	jQuery.ajax({
		url: "pere1.php?v=<?php echo $this->_tpl_vars['VARI']; ?>
&i="+paid
		,success: clicresu
		});
}

function clicresu(data){
	var arre= data.split("^");
	if (arre[0]=="ok"){
		var paid= arre[1];
		var dire= arre[2];
		var coun= arre[3];
		if (dire=="0"){
			idoff(paid);
		}else{
			idon(paid);
		}
		$("#coun<?php echo $this->_tpl_vars['VARI']; ?>
").text(coun);
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>