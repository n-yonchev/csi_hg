{*----
	копие на cazo6prnt.ajax.tpl
----*}
{include file="_ajax.header.tpl"}
{include file='_window.header.tpl' TITLE="отпечатване"}
{include file="_erform.tpl"}

почакай...
след появата на документа натисни бутона Print за отпечатване
<iframe id="interdiv" style="width:980px;height:800px">
</iframe>

<script type="text/javascript">
$(document).ready(function() {ldelim}
	parent.$.nyroModalSettings({ldelim}width:1000, height:800{rdelim});
var newurl=
//'html2ps/demo/html2ps.php?process_mode=single&URL=http%3A%2F%2Flocalhost%2F{$URLPAR}&pixels=800&scalepoints=1&renderimages=1&renderlinks=1&media=A4&cssmedia=Screen&leftmargin=30&rightmargin=15&topmargin=15&bottommargin=15&encoding=&headerhtml=&footerhtml={$FOOTER}&watermarkhtml=&toc-location=before&smartpagebreak=1&pslevel=3&method=fpdf&pdfversion=1.3&output=0&convert=Convert+File';
'html2ps/demo/html2ps.php?process_mode=single&URL=http%3A%2F%2Flocalhost%2F{$URLPAR}&pixels=900&landscape=1&scalepoints=1&renderimages=1&renderlinks=1&media=A4&cssmedia=Screen&leftmargin=15&rightmargin=15&topmargin=30&bottommargin=15&encoding=&headerhtml=&footerhtml={$FOOTER}&watermarkhtml=&toc-location=before&smartpagebreak=1&pslevel=3&method=fpdf&pdfversion=1.3&output=0&convert=Convert+File';
document.getElementById("interdiv").src= newurl;
//window.location.href= newurl;
{rdelim});
</script>

{*----*}
{include file='_window.footer.tpl'}
{*----*}
{include file="_ajax.footer.tpl"}
