<?php /* Smarty version 2.6.9, created on 2020-09-17 12:33:04
         compiled from _passprin.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style='height:100%'>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<body style="background-color:moccasin;font:normal 10pt verdana;"
<?php if (isset ( $this->_tpl_vars['LINK'] )): ?>onload="document.location.href='<?php echo $this->_tpl_vars['LINK']; ?>
';"<?php else:  endif; ?>>
			<?php if (isset ( $this->_tpl_vars['TEXT'] )):  echo $this->_tpl_vars['TEXT']; ?>

			<?php else: ?>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['FINI']): ?>
<script>
parent.fuprin("$LINK");
parent.prinfini();
</script>
			<?php else: ?>
			<?php endif; ?>

</body>
</html>