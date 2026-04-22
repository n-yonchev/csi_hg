<?php /* Smarty version 2.6.9, created on 2020-02-27 12:55:44
         compiled from _button.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['HREF'] )): ?>
	<a href='<?php echo $this->_tpl_vars['HREF']; ?>
' target='<?php echo $this->_tpl_vars['TARGET']; ?>
' class='<?php echo $this->_tpl_vars['CLASS']; ?>
'>
	<table class='button' cellspacing='0' cellpadding='0' border='0' >
	<tr onmouseover='eff_button(this)' onmouseout='eff_button(this)'>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['TYPE'] )): ?>
	<button value="<?php echo $this->_tpl_vars['TITLE']; ?>
" class="submit" style='width:auto;' type="<?php echo $this->_tpl_vars['TYPE']; ?>
" name="<?php echo $this->_tpl_vars['NAME']; ?>
" id="<?php echo $this->_tpl_vars['ID']; ?>
" tabindex="0" onmouseover='eff_button(this)' onmouseout='eff_button(this)'>
	<table class='button' cellspacing='0' cellpadding='0' border='0'>
	<tr>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['ONCLICK'] )): ?>
	<table class='button' cellspacing='0' cellpadding='0' border='0' >
	<tr onclick="<?php echo $this->_tpl_vars['ONCLICK']; ?>
" onmouseover='eff_button(this)' onmouseout='eff_button(this)'>
<?php endif; ?>

<td class='left' >&nbsp;</td>
<td class='middle' ><nobr><?php echo $this->_tpl_vars['TITLE']; ?>
</nobr></td>
<td class='right' >&nbsp;</td>

</tr>
</table>

<?php if (isset ( $this->_tpl_vars['TYPE'] )): ?>
</button>
<?php endif; ?>

<?php if (isset ( $this->_tpl_vars['HREF'] )): ?>
	</a>
<?php endif; ?>