<?php /* Smarty version 2.6.9, created on 2020-10-05 16:14:04
         compiled from _base.header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title> Частен СИ </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META HTTP-EQUIV="Expires" CONTENT="Fri, Jan 01 1900 00:00:00 GMT">
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">  
<link href="<?php echo $this->_tpl_vars['CSSPATH'];  echo $this->_tpl_vars['VISUNAME']; ?>
" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo $this->_tpl_vars['CSSPATH']; ?>
/menu_style.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="nyromodal/styles/nyroModal.css" type="text/css" media="screen" />
<link href="fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
<script type="text/javascript" src="js/tools.js"></script>
<script type="text/javascript" src="js/eff.js"></script>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="nyromodal/jquery.nyroModal-1.3.1.js"></script> 
<script type="text/javascript" src="js/cluetip.hoverIntent.js"></script>
<script type="text/javascript" src="js/jquery.dimensions.js"></script>
<script type="text/javascript" src="js/jquery.cluetip.js"></script>
<script type="text/javascript" src="help.js"></script>
<style>

</style>
		<?php if (isset ( $this->_tpl_vars['HEADJS'] )): ?>
			<?php $_from = $this->_tpl_vars['HEADJS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['jselem']):
?>
<script type="text/javascript" src="js/<?php echo $this->_tpl_vars['jselem']; ?>
"></script>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		<?php endif; ?>
	<?php if (isset ( $this->_tpl_vars['HEADLIST'] )):  echo $this->_tpl_vars['HEADLIST']; ?>

	<?php else: ?>
	<?php endif; ?>

<script language="JavaScript">$(function(){$.nyroModalSettings({bgColor: '#ffffff'});});</script>
</head>
<body>