<?php /* Smarty version 2.6.9, created on 2020-03-27 17:57:03
         compiled from delisend.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.mark3 {color:red;}
</style>

					<table align=center>
					<tr>
<td>
<?php $_from = $this->_tpl_vars['ARV3LINK']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['codevari'] => $this->_tpl_vars['culink']):
?>
	<span class="link3<?php if ($this->_tpl_vars['codevari'] == $this->_tpl_vars['V3']): ?> curr3<?php else:  endif; ?>" 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['culink'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 
	<?php echo $this->_tpl_vars['ARV3'][$this->_tpl_vars['codevari']]; ?>

	<?php if ($this->_tpl_vars['ARV3COUN'][$this->_tpl_vars['codevari']] == 0):  else: ?>&nbsp;[<?php echo $this->_tpl_vars['ARV3COUN'][$this->_tpl_vars['codevari']]; ?>
]<?php endif; ?>
	</span>
	&nbsp;&nbsp;&nbsp;&nbsp;
<?php endforeach; endif; unset($_from); ?>
					</table>

				<table class="tab2" cellspacing='0' cellpadding='2' align=center>
				<tr class='head1'>
<td colspan='200'>
Списък на пликове и документи за изпращане по поща
					<tr class="head1">
<td colspan=5> плик
<td colspan=4> включени документи
					<tr class="head2">
<td align=center> #
<td> адресат
<td> адрес
<td> 
<td> 
<td> изх.
<td> адресат
<td> адрес
<td> 
<?php $_from = $this->_tpl_vars['ARENVE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idenve'] => $this->_tpl_vars['elenve']):
?>
	<?php $this->assign('encoun', $this->_tpl_vars['ARCOUNENVE'][$this->_tpl_vars['idenve']]); ?>
				<?php $this->assign('isfirst', true); ?>
	<?php $_from = $this->_tpl_vars['elenve']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idpost'] => $this->_tpl_vars['elem']):
?>
					<tr>
				<?php if ($this->_tpl_vars['isfirst']): ?>
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
 align=center 
					<?php if ($this->_tpl_vars['idpost'] == 0): ?>
					<?php elseif ($this->_tpl_vars['elem']['idstat'] == 0): ?>
class="stat0 toli" title="направи го изпратен" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tostat1'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?>
class="stat1 toli" title="направи го чакащ" <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['tostat0'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
> &nbsp;&nbsp;#<?php echo $this->_tpl_vars['idenve']; ?>
&nbsp;&nbsp;

<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
> <?php echo $this->_tpl_vars['elem']['enveasat']; ?>

<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
> <?php echo $this->_tpl_vars['elem']['enveaddr']; ?>

					<?php if ($this->_tpl_vars['idpost'] == 0): ?>
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
> &nbsp;
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
> &nbsp;
					<?php else: ?>
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
 class="sortcurr toli" title="отпечати плик и известие" onclick="fup4('<?php echo $this->_tpl_vars['elem']['prnt']; ?>
');"> <b>пи</b>
<td rowspan=<?php echo $this->_tpl_vars['encoun']; ?>
 class="sortcurr toli" title="отпечати само плик" onclick="fup4('<?php echo $this->_tpl_vars['elem']['prntenve']; ?>
');"> <b>п</b>
					<?php endif; ?>
				<?php else: ?>
				<?php endif; ?>
		<?php if ($this->_tpl_vars['idpost'] == 0): ?>
<td class="mark3" colspan=4> няма включени документи
		<?php else: ?>
<td> <?php echo $this->_tpl_vars['elem']['d2seri']; ?>
/<?php echo $this->_tpl_vars['elem']['d2year']; ?>

<td> <?php echo $this->_tpl_vars['elem']['postasat']; ?>

<td> <?php echo $this->_tpl_vars['elem']['postaddr']; ?>

			<?php if ($this->_tpl_vars['elem']['idstat'] == 0): ?>
<td class="toli" title="изключи от плик #<?php echo $this->_tpl_vars['idenve']; ?>
"
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['elem']['noenve'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
> <img src="images/ignore.gif">
			<?php else: ?>
<td> &nbsp;
			<?php endif; ?>
		<?php endif; ?>
				<?php $this->assign('isfirst', false); ?>
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_tab2pagi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</table>

<iframe id="idp4" width=1 height=1 frameborder=0 style="display:block"></iframe>
<script>
function fup4(p1){
	document.getElementById("idp4").focus();
	document.getElementById("idp4").src= p1;
}
</script>