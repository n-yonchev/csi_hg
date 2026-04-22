<?php /* Smarty version 2.6.9, created on 2020-02-28 08:12:29
         compiled from reg4messall.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.caselink {font: normal 8pt verdana; background-color:wheat; padding: 2px 8px; cursor:pointer;}
</style>
		<table class="tab2" cellspacing='0' cellpadding='2' align=center>
		<tr class='head1'>
<td colspan='200'> брой дела с грешки от ЦРД-2014 по деловодители
		<tr class='head2'>
<td> деловодител
<td> общо<br>дела
<td> грешни<br>дела
<td> &nbsp;
<?php $_from = $this->_tpl_vars['USERLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['iduser'] => $this->_tpl_vars['username']):
?>
						<?php if ($this->_tpl_vars['ARCASE'][$this->_tpl_vars['iduser']] == 0 && $this->_tpl_vars['ARMESS'][$this->_tpl_vars['iduser']] == 0): ?>
						<?php else: ?>
				<tr>
<td title="<?php echo $this->_tpl_vars['iduser']; ?>
"> 
		<?php if (empty ( $this->_tpl_vars['username'] )): ?>
			<?php if ($this->_tpl_vars['iduser'] == 0): ?>
<font color=red>без деловодител</font>
			<?php else: ?>
<font color=red>липсва деловодител [<?php echo $this->_tpl_vars['iduser']; ?>
]</font>
			<?php endif; ?>
		<?php else: ?>
<?php echo $this->_tpl_vars['username']; ?>

		<?php endif; ?>
<td align=right> <?php echo $this->_tpl_vars['ARCASE'][$this->_tpl_vars['iduser']]; ?>

							<?php if ($this->_tpl_vars['ARMESS'][$this->_tpl_vars['iduser']] == 0): ?>
<td> &nbsp;
							<?php else: ?>
<td align=right class="caselink" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['ARLINK'][$this->_tpl_vars['iduser']]['view'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['ARMESS'][$this->_tpl_vars['iduser']]; ?>

							<?php endif; ?>
<td align=center> 
&nbsp;
<a href="#" onclick="tose('u_<?php echo $this->_tpl_vars['iduser']; ?>
'); return false;">
<img src="images/admin.gif" title="предай ВСИЧКИ <?php echo $this->_tpl_vars['ARCASE'][$this->_tpl_vars['iduser']]; ?>
 дела към ЦРД-2014"></a>
&nbsp;
						<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script>
function tose(p1){
		jQuery.ajax({
			url: "cazo1tose.ajax.php?e="+p1
			,success: cazo1succ
			});
}
function cazo1succ(data){
///////////////////////////alert(data);
	var arre= data.split("^");
	if (arre[0]=="ok"){
	}else{
alert("ERROR"+String.fromCharCode(10)+data);
	}
}
</script>