<?php /* Smarty version 2.6.9, created on 2026-03-10 15:40:36
         compiled from _window.header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', '_window.header.tpl', 4, false),)), $this); ?>
<?php if (isset ( $this->_tpl_vars['WIDTH'] )): ?>
	<?php $this->assign('tmp', "style='width:".($this->_tpl_vars['WIDTH']));  endif; ?>
<table class='window_table' <?php if (isset ( $this->_tpl_vars['WIDTH'] )):  echo ((is_array($_tmp=$this->_tpl_vars['tmp'])) ? $this->_run_mod_handler('cat', true, $_tmp, "px';") : smarty_modifier_cat($_tmp, "px';"));  endif; ?> style='' id='nyroWindow' cellspacing='0' cellpadding='0'>
<tr>
	<td class='window_top_left'></td>
	<td class='window_top_middle'></td>
	<td class='window_top_right'></td>
</tr>
<tr>
	<td class='window_title_left'></td>
	<td class='window_title'><span><?php echo $this->_tpl_vars['TITLE']; ?>
 &nbsp;</span>
	<div class='wclose_normal' onMouseOver="eff_window_close_button(this);" onMouseOut="eff_window_close_button(this);" 
onclick="nyremo();" >
	</div>
	</td>
	<td class='window_title_right'></td>
</tr>
<tr>
	<td class='window_middle_left'></td>
	<td class='window_middle_middle'>
	<?php if (isset ( $this->_tpl_vars['TABS'] )): ?>
		<div class='tabs_line'>
			<table class='tabs' style='' cellspacing='0'  cellpadding='0' border='0' >
				<tr>
					<?php $_from = $this->_tpl_vars['TABS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['elem']):
?>
						<td class='tabs_sep'>&nbsp;</td> 
						<?php if ($this->_tpl_vars['elem']['selected']): ?>
							<td class='tabs_left_selected'></td>
							<td class='tabs_middle_selected'><span><?php echo $this->_tpl_vars['elem']['name']; ?>
</span></td>
							<td class='tabs_right_selected'></td>
						<?php else: ?>
							<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']['url']; ?>
"' class='tabs_left'></td>
							<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']['url']; ?>
"' class='tabs_middle'><span><?php echo $this->_tpl_vars['elem']['name']; ?>
</span></td>
							<td onclick='document.location.href="<?php echo $this->_tpl_vars['elem']['url']; ?>
"' class='tabs_right'></td>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</tr>
			</table>
		</div>
	<?php endif; ?>
	<div style='border: 1px solid #a3bae9;margin: 2px;'>
	<div class='window_border' id='divscroll'>
	<div id='divnotscroll'>
<script>
var inte= 0;
function nyremo(){
	<?php if (isset ( $this->_tpl_vars['NYREMO'] )): ?>
$("#"+"<?php echo $this->_tpl_vars['NYREMO']['idzone']; ?>
").load(encodeURI('finaunlock.ajax.php?idfina='+'<?php echo $this->_tpl_vars['NYREMO']['idfina']; ?>
'));
inte= setInterval("interemo()",200);
	<?php else: ?>
parent.$.nyroModalRemove();
	<?php endif; ?>
}
	<?php if (isset ( $this->_tpl_vars['NYREMO'] )): ?>
function interemo(){
	if ($("#"+"<?php echo $this->_tpl_vars['NYREMO']['idzone']; ?>
").text()=="OK"){
clearInterval(inte);
parent.$.nyroModalRemove();
	}else{
	}
}
	<?php else: ?>
	<?php endif; ?>
</script>