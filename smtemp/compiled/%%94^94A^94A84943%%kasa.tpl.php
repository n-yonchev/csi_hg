<?php /* Smarty version 2.6.9, created on 2020-03-25 15:37:59
         compiled from kasa.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoex', 'kasa.tpl', 60, false),array('modifier', 'tomoney2', 'kasa.tpl', 62, false),array('modifier', 'date_format', 'kasa.tpl', 71, false),)), $this); ?>
						<?php if ($this->_tpl_vars['FLPRIN']): ?>
<style>
td {font:normal 8pt verdana; border-bottom: 1px solid silver; padding-left:4px; border-right: 1px solid silver;}
tr.head1 td {font:bold 10pt verdana; background-color: #dddddd;}
tr.head2 td {font:bold 10pt verdana; background-color: #dddddd;}
</style>
						<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
body {margin:0px 10px;}
.dateinvo {font:normal 7pt verdana;border:0px solid black; color:black;}
</style>
						<?php endif; ?>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> списък на касови приходи и разходи <?php echo $this->_tpl_vars['TEXTHEAD']; ?>

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#" onclick="fuprin('<?php echo $this->_tpl_vars['CURINT']; ?>
');"><img src="images/excel.gif" title="изход Excel" border=0></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="dateinvo">
	въведи дата или период от-до
	<input type=text name="dateinvo" id="dateinvo" size=26  class="dateinvo" onkeyup="autosubminvo(event,this);"> +enter
	<span id="error" style="color:red"></span>
</span>
						<?php endif; ?>
		<tr class='head2'>
<td align=right> приход
<td align=right> разход
<td> дата
<td> документ
<td> номер
<td> тип
<td> вносител/получател
<td> основание
<td> дело
<td> деловодител
<td> касиер
<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
				<tr>
					<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php $this->assign('mysuma', ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp))); ?>
					<?php else: ?>
						<?php $this->assign('mysuma', ((is_array($_tmp=$this->_tpl_vars['elem']['suma'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['elem']['typesuma'] == 9): ?>
<td> &nbsp;
<td align=right> <?php echo $this->_tpl_vars['mysuma']; ?>

					<?php else: ?>
<td align=right> <?php echo $this->_tpl_vars['mysuma']; ?>

<td> &nbsp;
					<?php endif; ?>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['cashdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 &nbsp;
<td> <?php echo $this->_tpl_vars['ARC2DOCU'][$this->_tpl_vars['elem']['typesuma']]; ?>

<td> <?php echo $this->_tpl_vars['elem']['cashserial']; ?>
/<?php echo $this->_tpl_vars['elem']['cashyear']; ?>
 &nbsp;
<td> <?php echo $this->_tpl_vars['ARC2TYPE'][$this->_tpl_vars['elem']['typesuma']]; ?>

<td> <?php echo $this->_tpl_vars['elem']['cashname']; ?>

<td> <?php echo $this->_tpl_vars['elem']['descrip']; ?>

<td>
			<?php if (empty ( $this->_tpl_vars['elem']['idcase'] )): ?>
&nbsp;
			<?php else: ?>
<?php echo $this->_tpl_vars['elem']['caseseri']; ?>
/<?php echo $this->_tpl_vars['elem']['caseyear']; ?>
 &nbsp;
			<?php endif; ?>
<td> <?php echo $this->_tpl_vars['elem']['username']; ?>

<td> <?php echo $this->_tpl_vars['elem']['cashuser']; ?>

<?php endforeach; endif; unset($_from); ?>
		<tr class='head2'>
					<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php $this->assign('mysuma1', ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma1'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp))); ?>
						<?php $this->assign('mysuma2', ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma2'])) ? $this->_run_mod_handler('tomoex', true, $_tmp) : smarty_modifier_tomoex($_tmp))); ?>
					<?php else: ?>
						<?php $this->assign('mysuma1', ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma1'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
						<?php $this->assign('mysuma2', ((is_array($_tmp=$this->_tpl_vars['ARSUMA']['suma2'])) ? $this->_run_mod_handler('tomoney2', true, $_tmp) : smarty_modifier_tomoney2($_tmp))); ?>
					<?php endif; ?>
<td align=right> <?php echo $this->_tpl_vars['mysuma1']; ?>

<td align=right> <?php echo $this->_tpl_vars['mysuma2']; ?>

<td colspan=20> общо за периода

						<?php if ($this->_tpl_vars['FLPRIN']): ?>
						<?php else: ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>

<script>
function autosubminvo(event,obinpu){
//alert(obinpu.value);
	var event= (event) ? event : window.event;
	var code= (event.charCode) ? event.charCode : event.keyCode;
	if (code==13){
		if (obinpu.value==""){
		}else{
			lipara= {date:obinpu.value,modeel:"<?php echo $this->_tpl_vars['MODEEL']; ?>
"};
			jQuery.ajax({
				url: "finainvodate.ajax.php"
				,data: lipara
				,type: "post"
				,success: fusucc
			})
		}
return false;
	}else{
return true;
	}
}
function fusucc(data){
//alert("data="+data);
	var arresu= data.split("/");
	var code= arresu[0];
	if (code=="0"){
		$("#error").text("");
document.location.href= arresu[1];
	}else{
		$("#error").text(arresu[1]);
	}
}
</script>