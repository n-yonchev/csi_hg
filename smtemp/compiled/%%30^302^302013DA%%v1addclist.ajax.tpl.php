<?php /* Smarty version 2.6.9, created on 2020-03-10 14:25:52
         compiled from v1addclist.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'v1addclist.ajax.tpl', 2, false),array('modifier', 'date_format', 'v1addclist.ajax.tpl', 69, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.header.tpl', 'smarty_include_vars' => array('TITLE' => ((is_array($_tmp="намерени дела с ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['FILTTEXT']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['FILTTEXT'])))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form name="myseleform" method=post style="margin:0px;padding:0px;width:auto;" enctype="multipart/form-data">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><b><?php echo $this->_tpl_vars['ARCOUN'][9]+0; ?>
</b></font> бр.дела намерени общо
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><b><?php echo $this->_tpl_vars['ARCOUN'][1]+0; ?>
</b></font> бр.дела от тях вече са включени в списъка
<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<font color=red><b><?php echo $this->_tpl_vars['ARCOUN'][0]+0; ?>
</b></font> бр.дела от тях не са включени в списъка
			<?php if ($this->_tpl_vars['ARCOUN'][0]+0 == 0): ?>
			<?php else: ?>
<br>
<a style="font: normal 8pt verdana; border-bottom: 1px solid black; cursor: pointer" 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_href.tpl", 'smarty_include_vars' => array('LINK' => $this->_tpl_vars['LINKINCALL'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>> включи наведнъж всичките <?php echo $this->_tpl_vars['ARCOUN'][0]+0; ?>
 бр.дела в списъка на наблюдателя <?php echo $this->_tpl_vars['ROVIEW']['name']; ?>
 </a>
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
$this->_smarty_include(array('smarty_include_tpl_file' => '_but2.tpl', 'smarty_include_vars' => array('TYPE' => 'submit','TITLE' => 'включи','NAME' => 'submit','ID' => 'submit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
маркираните дела в списъка на наблюдателя <?php echo $this->_tpl_vars['ROVIEW']['name']; ?>
 

<br>
		<table class="d_table" align=center cellspacing='0' cellpadding='0'>
		<tr class="header">
<td class="he2"> номер
<td class="he2"> деловодител
<td class="he2"> идва от
<td class="he2"> създадено
<td class="he2"> представител
<td class="he2"> взискатели
<td class="he2"> статус
<td class="he2"> включи
	<?php $_from = $this->_tpl_vars['LISTCASE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elem']):
?>
		<tr>
<td class="ro2"> <?php echo $this->_tpl_vars['elem']['serial']; ?>
/<?php echo $this->_tpl_vars['elem']['year']; ?>

<td class="ro2"> <?php echo $this->_tpl_vars['elem']['username']; ?>

<td class="ro2"> <?php echo $this->_tpl_vars['ARFROM'][$this->_tpl_vars['elem']['idcofrom']]; ?>

<td class="ro2"> <?php echo ((is_array($_tmp=$this->_tpl_vars['elem']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>

<td class="ro2"> <?php echo $this->_tpl_vars['elem']['agenname']; ?>
 &nbsp;
<td class="ro2"> 
		<?php $_from = $this->_tpl_vars['LISTCLAI'][$this->_tpl_vars['elem']['id']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['claielem']):
?>
<nobr>
<?php echo $this->_tpl_vars['claielem']; ?>
 &nbsp;
</nobr>
<br>
		<?php endforeach; endif; unset($_from); ?>
<td class="ro2"> <?php echo $this->_tpl_vars['ARSTAT'][$this->_tpl_vars['elem']['idstat']]; ?>
 &nbsp;
<td class="ro2"> 
&nbsp;
					<?php if ($this->_tpl_vars['elem']['isinlist'] == 0): ?>
<input type="checkbox" name="marklist[]" value="<?php echo $this->_tpl_vars['elem']['id']; ?>
" rela="mycblist">
					<?php else: ?>
					<?php endif; ?>
		</tr>
	<?php endforeach; endif; unset($_from);  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_pagina.tr.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</table>
</form>

<script>
$(document).ready(function(){
	$("div.wclose_normal").bind("click",function(){
//parent.$('#linkrelo').click();
		var lire= parent.$('#linkrelo').attr("href");
//alert(lire);
parent.location.href= "index.php"+lire;
	});
});
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => '_window.footer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>