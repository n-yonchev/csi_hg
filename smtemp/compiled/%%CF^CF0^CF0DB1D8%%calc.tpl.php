<?php /* Smarty version 2.6.9, created on 2020-03-02 17:10:54
         compiled from calc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tomoney', 'calc.tpl', 52, false),)), $this); ?>
<style>
.resu {font: bold 14px verdana; background-color: #dfe8f6; padding: 4px;}
</style>
<form name="myform" method=post style="margin:0px" enctype="multipart/form-data">
<br/>
		<table class='d_table' cellspacing=0 cellpadding=0 align=center border=0>
		<thead>
		<tr>
<td class='d_table_title' colspan=100> Лихвен калкулатор
		</thead>
		<tbody>
		<tr>
		<td style='border:0px' width=10>
		<td style='border:0px' width=180>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

сума
<br/>
<input type="text" name="amou" id="amou" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'amou','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<br/>
начална дата (д.м.г)
<br/>
<input type="text" name="dat1" id="dat1" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'dat1','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<br/>
крайна дата (д.м.г)
<br/>
<input type="text" name="dat2" id="dat2" size=20 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'dat2','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> 

<br/>
<br/>
<div <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_erelem.tpl", 'smarty_include_vars' => array('ID' => 'type','C1' => 'input','C2' => 'inputer')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>>
<input type="radio" name="type" id="type" value="0"> ОЛП лв
<br/>
<input type="radio" name="type" id="type" value="1"> 3-мес.LIBOR USD
<br/>
<input type="radio" name="type" id="type" value="2"> 3-мес.LIBOR евро
<br/>
<input type="radio" name="type" id="type" value="3"> 3-мес.EURIBOR
</div>

<br/>
<br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'изчисли','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br/> &nbsp;
		<td style='border:0px' valign=top>

			<?php if (isset ( $this->_tpl_vars['INTELIST'] )): ?>
<br/>
	<span class="resu">
	<?php echo ((is_array($_tmp=$this->_tpl_vars['INTETOTA'])) ? $this->_run_mod_handler('tomoney', true, $_tmp) : smarty_modifier_tomoney($_tmp)); ?>

	</span>
&nbsp;
<br/>
обща лихва за периода
<br/>
<br/>
	<span class="resu">
	<?php echo ((is_array($_tmp=$this->_tpl_vars['AMOUTOTA'])) ? $this->_run_mod_handler('tomoney', true, $_tmp) : smarty_modifier_tomoney($_tmp)); ?>

	</span>
&nbsp;
<br/>
общo дължима сума
<br/>
<br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_button.tpl', 'smarty_include_vars' => array('ONCLICK' => 'vilist();','TITLE' => 'подробно')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php else: ?>
				<?php if (isset ( $this->_tpl_vars['ERRORTEXT'] )): ?>
<div style="font:bold 10pt verdana; color:red;"> <?php echo $this->_tpl_vars['ERRORTEXT']; ?>
 </div>
				<?php else: ?>
				<?php endif; ?>
			<?php endif; ?>
<br/> &nbsp;

		</table>
</form>

			<?php if (isset ( $this->_tpl_vars['INTELIST'] )): ?>
<span id="folist" style="display: none;">
<br/>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_calcperc.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br/> &nbsp;
</span>
			<?php else: ?>
			<?php endif; ?>


<script>
function vilist(){
	var o1= document.getElementById("folist");
	var newdis= (o1.style.display=="none") ? "" : "none";
	o1.style.display= newdis;
}
</script>