<?php /* Smarty version 2.6.9, created on 2020-11-16 17:06:00
         compiled from rep2calc.ajax.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'rep2calc.ajax.tpl', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_base.header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.c3he {font: bold 7pt verdana; background-color:skyblue; padding: 1px 4px;}
.c3li {font: bold 7pt verdana; background-color:wheat; padding: 1px 4px; cursor:pointer;}
.c3lino {font: bold 7pt verdana; background-color:#dddddd; padding: 1px 4px; cursor:pointer;}
.c3licu {font: bold 7pt verdana; background-color:tomato; padding: 1px 4px; cursor:pointer;}
.c3liov {font: bold 7pt verdana; background-color:aqua; padding: 1px 4px; cursor:pointer;}
.c3la {font: bold 7pt verdana; background-color:#dddddd; border: 1px solid black; padding: 1px 4px; cursor:pointer;}
</style>

					<table align=center>
					<?php $_from = $this->_tpl_vars['LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuyear'] => $this->_tpl_vars['culist']):
?>
					<tr>
<td class="c3he" colspan=20> <?php echo $this->_tpl_vars['cuyear']; ?>

					<tr>
								<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

						<?php $_from = $this->_tpl_vars['culist']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cuseri'] => $this->_tpl_vars['cuidcase']):
?>
									<?php if (isset ( $this->_tpl_vars['CALCLIST'][$this->_tpl_vars['cuidcase']] )): ?>
										<?php $this->assign('xclas', 'c3li'); ?>
									<?php else: ?>
										<?php $this->assign('xclas', 'c3lino'); ?>
									<?php endif; ?>
<td id="t<?php echo $this->_tpl_vars['cuidcase']; ?>
" class="<?php echo $this->_tpl_vars['xclas']; ?>
" align=right 
onmouseover="window.oldc=this.className;this.className='c3liov';" onmouseout="this.className=window.oldc;"
onclick="window.oldc='c3li';start('<?php echo $this->_tpl_vars['cuidcase']; ?>
');"
oncontextmenu="window.oldc='c3li';proc2('<?php echo $this->_tpl_vars['cuidcase']; ?>
');return false;"
> <?php echo $this->_tpl_vars['cuseri']; ?>

								<?php echo smarty_function_counter(array('assign' => 'coun'), $this);?>

								<?php if ($this->_tpl_vars['coun'] > 20): ?>
					<tr>
									<?php echo smarty_function_counter(array('start' => 1,'assign' => 'coun'), $this);?>

								<?php else: ?>
								<?php endif; ?>
						<?php endforeach; endif; unset($_from); ?>
					<?php endforeach; endif; unset($_from); ?>
					</table>

<script>
var stopped= true;
function start(p1){
	if (stopped){
		stopped= false;
		process(p1);
	}else{
	}
}
function process(p1){
//alert(stopped);
	if (stopped){
	}else{
		jQuery.ajax({
			url: "rep2calc2.ajax.php?p=<?php echo $this->_tpl_vars['PERIOD']; ?>
&c="+p1
			,success: fusucc
			});
	}
}
function fusucc(data){
//alert("data="+data);
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){
	}else{
stopped= true;
alert("ERROR"+String.fromCharCode(10)+data);
	}
	var c1= arre[1];
	var c2= arre[2];
	document.getElementById("t"+c1).className= 'c3li';
//window.oldc='c3li';
	if (c2==""){
		stopped= true;
	}else{
var ot= document.getElementById("t"+c2).offsetTop;
var oh= (document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop;
	if (ot-200<oh){
	}else{
window.scrollTo(0,ot-200);
	}
		document.getElementById("t"+c2).className= (stopped) ? 'c3la' : 'c3licu';
		process(c2);
	}
}
function stopon(){
	stopped= true;
}
function startbeg(){
	start('<?php echo $this->_tpl_vars['IDBEGI']; ?>
');
}

function proc2(p1){
//alert(stopped);
//	if (stopped){
//	}else{
		jQuery.ajax({
			url: "rep2calc2.ajax.php?p=<?php echo $this->_tpl_vars['PERIOD']; ?>
&c="+p1
			,success: succ2
			});
//	}
}
function succ2(data){
	var arre= data.split("^");
	var ok= arre[0];
	if (ok=="ok"){
	}else{
//stopped= true;
alert("ERROR"+String.fromCharCode(10)+data);
	}
	var c1= arre[1];
//	var c2= arre[2];
	document.getElementById("t"+c1).className= 'c3li';
}
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_ajax.footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>