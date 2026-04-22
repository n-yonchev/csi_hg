<?php /* Smarty version 2.6.9, created on 2020-02-27 13:17:28
         compiled from _tabslist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', '_tabslist.tpl', 38, false),)), $this); ?>
						<?php if ($_SESSION['VIEWFLAG_NOTABS']): ?>
						<?php else: ?>

<div style="clear:left; width:98%;">
<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0'>
<tr>
										<?php if ($this->_tpl_vars['ONLYTABS']): ?>
											<?php $this->assign('CURREDIT', $this->_tpl_vars['EDIT']); ?>
											<?php $this->assign('EDIT', $this->_tpl_vars['MONT']); ?>
<td> &nbsp;&nbsp;
										<?php else: ?>
<td valign="top" width=70>
<div class="atabs_cont">
	<?php if (isset ( $this->_tpl_vars['EDIT'] )): ?>
<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_left'>&nbsp;</div>
<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_middle'
	oncontextmenu="goout('?outall'); return false;"
	rel="tabs.ajax.php" title="<span class='contcase'>десен клик - <b>затвори ВСИЧКИ дела</b></span>"
> Всички </div>
<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['PAGEBACKLINK'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_right'>&nbsp;</div>
	<?php else: ?>
<div class='atabs_left_selected'>&nbsp;</div>
<div class='atabs_middle_selected' id="allsele"
	oncontextmenu="goout('?outall'); return false;"
	rel="tabs.ajax.php" title="<span class='contcase'>десен клик - <b>затвори ВСИЧКИ дела</b></span>"
> Всички </div>
<div class='atabs_right_selected'>&nbsp;</div>
	<?php endif; ?>
</div>
</td>
										<?php endif; ?>

<td>
												<?php echo smarty_function_counter(array('start' => 1,'assign' => 'mycoun'), $this);?>

	<?php $_from = $this->_tpl_vars['TABSLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['taid'] => $this->_tpl_vars['taitem']):
?>
								<?php if ($this->_tpl_vars['taitem']['mark']): ?>
									<?php $this->assign('foco', 'red'); ?>
								<?php else: ?>
									<?php $this->assign('foco', ""); ?>
								<?php endif; ?>
<div class="atabs_cont">
			<?php if ($this->_tpl_vars['taid'] == $this->_tpl_vars['EDIT']): ?>
	 			<div class='atabs_left_selected'>&nbsp;</div>
				<div class='atabs_middle_selected'>
<?php echo $this->_tpl_vars['taitem']['text']; ?>

										<?php if ($this->_tpl_vars['ONLYTABS']): ?>
										<?php else: ?>
<img style="cursor:pointer" src="images/tabs_close_selected_normal.gif" onclick="gooutlist('<?php echo $this->_tpl_vars['taitem']['goout']; ?>
');">
										<?php endif; ?>
				</div>
				<div class='atabs_right_selected'>&nbsp;</div>
			<?php else: ?>
				<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['taitem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_left'>&nbsp;</div>	
										<?php if ($this->_tpl_vars['ONLYTABS']): ?>
				<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['taitem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_middle'>
				<?php echo $this->_tpl_vars['taitem']['text']; ?>

				</div>
										<?php else: ?>
				<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['taitem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_middle'
oncontextmenu="goout('<?php echo $this->_tpl_vars['taitem']['goout']; ?>
'); return false;"
rel="tabs.ajax.php<?php echo $this->_tpl_vars['taitem']['link']; ?>
" title="<span class='contcase'>изп.дело <b><?php echo $this->_tpl_vars['taitem']['text']; ?>
</b><br/>десен клик - <b>затвори делото</b></span>">
<font color="<?php echo $this->_tpl_vars['foco']; ?>
"> <?php echo $this->_tpl_vars['taitem']['text']; ?>
 </font>
				</div>
										<?php endif; ?>
				<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['taitem']['link'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> class='atabs_right'>&nbsp;</div>
			<?php endif; ?>
</div>
												<?php echo smarty_function_counter(array('assign' => 'mycoun'), $this);?>

												<?php if ($this->_tpl_vars['mycoun'] <= count ( $this->_tpl_vars['TABSLIST'] )): ?>
<div class="atabs_sepa">&nbsp;</div>
												<?php else: ?>
												<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
				<?php if (isset ( $this->_tpl_vars['EDIT'] )): ?>
<div style="float:left;cursor:pointer;padding-left:10px;" 
onclick="chplan();" title="смени общия план">
<img src="images/hist.gif">
</div>
<span id="mapa"></span>
				<?php else: ?>
				<?php endif; ?>

</td>
	</tr>
</table>
</div>
										<?php if ($this->_tpl_vars['ONLYTABS']): ?>
											<?php $this->assign('EDIT', $this->_tpl_vars['CURREDIT']); ?>
										<?php else: ?>
										<?php endif; ?>

<link rel="stylesheet" href="cluetip/jquery.cluetip.css" type="text/css" />
<script type="text/javascript">
$(document).ready(function() {
$('.atabs_middle').cluetip({
	cluetipClass: 'jtip', 
	positionBy: 'bottomTop',
//	positionBy: 'fixed',
	topOffset: 30,
//	leftOffset: 10,
//	showTitle: false,
//	arrows: true, 
	width: 240
	});
$('#allsele').cluetip({
	cluetipClass: 'jtip', 
	positionBy: 'bottomTop',
	topOffset: 30,
	width: 240
	});
});

function chplan(){
	jQuery.ajax({
		url: "casemainplan.ajax.php?para=<?php echo $this->_tpl_vars['EDIT']; ?>
&plan=<?php echo $this->_tpl_vars['MAINPLAN']; ?>
",
		success: function(data){
//alert(data);
document.location.href= "<?php echo $this->_tpl_vars['RELURL']; ?>
";
		}
	});
}

function goout(p1){
//alert('goout');
	jQuery.ajax({
		url: "casegoout.ajax.php"+p1,
		success: function(data){
//alert(data);
	if (data=="0"){
document.location.href= "<?php echo $this->_tpl_vars['PAGEBACKLINK']; ?>
";
	}else{
document.location.reload();
	}
		}
	});
}
function gooutlist(p1){
//alert('goout');
	jQuery.ajax({
		url: "casegoout.ajax.php"+p1,
		success: function(data){
//alert(data);
document.location.href= "<?php echo $this->_tpl_vars['PAGEBACKLINK']; ?>
";
		}
	});
}
</script>

						<?php endif; ?>