<?php /* Smarty version 2.6.9, created on 2020-03-10 14:25:45
         compiled from v1list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'v1list.tpl', 107, false),)), $this); ?>
<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
						<table align=center>
				<?php if (isset ( $this->_tpl_vars['PAGEBACKLINK'] )): ?>
<tr><td align=left>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> <?php echo $this->_tpl_vars['PAGEBACKTEXT']; ?>
 </a>
				<?php else: ?>
				<?php endif; ?>
<tr><td align=left>
<br>
			<table class="d_table" width='' cellspacing='0' cellpadding='0' align=center>
			<thead>	
			<tr>
<td class='d_table_title' colspan='40'> списък с дела на наблюдател <?php echo $this->_tpl_vars['ROVIEW']['name']; ?>

&nbsp;&nbsp;&nbsp;&nbsp;
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => "window.location.href='".($this->_tpl_vars['ADDCAS'])."';",'TITLE' => 'добави')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<tr>
<td colspan='40'>
			<?php if ($this->_tpl_vars['COUNTO']+0 == 0): ?>
			<?php else: ?>
<br>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKDELALL'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> изтрий наведнъж всичките <?php echo $this->_tpl_vars['COUNTO']+0; ?>
 бр.дела от списъка </a>
&nbsp;&nbsp;&nbsp;&nbsp;
			<?php endif; ?>
<br>
<br>
маркирай само за тази страница
&nbsp;&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer"
href="#" onclick="checkon();return false;"> <nobr>всички да</nobr> </a>
&nbsp;&nbsp;
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
href="#" onclick="checkoff();return false;"> <nobr>всички не</nobr> </a>
<script type="text/javascript" src="js/jq.checkbox.js"></script>
<script>
function checkon(){
	$("input[@rela='mycblist']").check("on");
}
function checkoff(){
	$("input[@rela='mycblist']").check("off");
}
</script>
<br>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'изтрий','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
маркираните дела от списъка на наблюдателя <?php echo $this->_tpl_vars['ROVIEW']['name']; ?>
 
<br>
			</thead>
			<tr class='header'>
<td> номер </td>
			<td class='sep'>&nbsp;</td>
<td> деловодител </td>
			<td class='sep'>&nbsp;</td>
<td> описание </td>
			<td class='sep'>&nbsp;</td>
<td> идва от </td>
			<td class='sep'>&nbsp;</td>
<td> създадено </td>
			<td class='sep'>&nbsp;</td>
<td> посл.промяна </td>
			<td class='sep'>&nbsp;</td>
<td> представител </td>
			<td class='sep'>&nbsp;</td>
<td> взискатели </td>
			<td class='sep'>&nbsp;</td>
<td> статус </td>
			<td class='sep'>&nbsp;</td>
<td> изтрий </td>

<?php $_from = $this->_tpl_vars['CASELIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
			<tr 
onmouseover='this.style.backgroundColor="#dddddd";' 
onmouseout='this.style.backgroundColor="";'
>
<td> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>
</td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['username']; ?>
</td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['text']; ?>

				<?php $this->assign('arindx', $this->_tpl_vars['elem']['idcofrom']); ?> </td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['elem']['idcofrom']]; ?>
</td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
			<td class='sep'>&nbsp;</td>
<td> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['lastdocu'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y %H:%M") : smarty_modifier_date_format($_tmp, "%d.%m.%Y %H:%M")); ?>
</td>
				<?php $this->assign('myid', $this->_tpl_vars['elem']['id']); ?>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['elem']['agenname']; ?>
</td>
			<td class='sep'>&nbsp;</td>
<td>
		<?php $_from = $this->_tpl_vars['LISTCLAI'][$this->_tpl_vars['elem']['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claielem']):
?>
<nobr>
<?php echo $this->_tpl_vars['claielem']; ?>
 &nbsp;
</nobr>
<br>
		<?php endforeach; endif; unset($_from); ?>
			<td class='sep'>&nbsp;</td>
<td> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['elem']['idstat']]; ?>
 &nbsp;
			<td class='sep'>&nbsp;</td>
<td>
<input type="checkbox" name="marklist[]" value="<?php echo $this->_tpl_vars['elem']['id']; ?>
" rela="mycblist">
<?php endforeach; endif; unset($_from); ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</table>
						</table>
</form>