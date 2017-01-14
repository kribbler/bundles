<?php ob_start() ?>
<?php
if ($_GET['randomId'] != "7Hqo58bBjehF3dlz_sDFMV9axyD1juMi_QAP7QUKJdnuF4RHE1AuyPSXn817RKCDPJIJ3X0vmvIxURjNDR8_MhUsAVTAhyYuwA8DmCuEv6mjgo9w5N2KdNiy13Tz5z3DXX3CZhnMgH0mXnwaI2acnHEPhuNDKfmxB5vrNEeedMv1f3rw5wKyUpqCPcfdWxxycHyKbLpv_JO7HTwvLT0Jewk8G662E8qIZBpsWOz9A5psFs9zICVPzbkltT3_R9OE") {
    echo "Access Denied";
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editing audio010101-test.html</title>
<meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
<style type="text/css">body {background-color:threedface; border: 0px 0px; padding: 0px 0px; margin: 0px 0px}</style>
</head>
<body>
<div align="center">

<div id="saveform" style="display:none;">
<form METHOD="POST" name=mform action="https://lancelambert.org:2083/frontend/x3/filemanager/savehtmlfile.html">
    <input type="hidden" name="charset" value="us-ascii">
    <input type="hidden" name="baseurl" value="http://lancelambert.org/">
    <input type="hidden" name="basedir" value="/home/lance/public_html/">
    <input type="hidden" name="udir" value="/home/lance/public_html">
    <input type="hidden" name="ufile" value="audio010101-test.html">
    <input type="hidden" name="dir" value="%2fhome%2flance%2fpublic_html">
    <input type="hidden" name="file" value="audio010101-test.html">
    <input type="hidden" name="doubledecode" value="1">
<textarea name=page rows=1 cols=1></textarea></form>
</div>
<div id="abortform" style="display:none;">
<form METHOD="POST" name="abortform" action="https://lancelambert.org:2083/frontend/x3/filemanager/aborthtmlfile.html">
    <input type="hidden" name="charset" value="us-ascii">
    <input type="hidden" name="baseurl" value="http://lancelambert.org/">
    <input type="hidden" name="basedir" value="/home/lance/public_html/">
    <input type="hidden" name="dir" value="%2fhome%2flance%2fpublic_html">
        <input type="hidden" name="file" value="audio010101-test.html">
    <input type="hidden" name="udir" value="/home/lance/public_html">
    <input type="hidden" name="ufile" value="audio010101-test.html">

        </form>
</div>
<script language="javascript">
<!--//

function setHtmlFilters(editor) {
// Design view filter
editor.addHTMLFilter('design', function (editor, html) {
        return html.replace(/\<meta\s+http\-equiv\="Content\-Type"[^\>]+\>/gi, '<meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />');
});

// Source view filter
editor.addHTMLFilter('source', function (editor, html) {
        return html.replace(/\<meta\s+http\-equiv\="Content\-Type"[^\>]+\>/gi, '<meta http-equiv="Content-Type" content="text/html; charset=us-ascii" />');
});
}

// this function updates the code in the textarea and then closes this window
function do_save() {
    document.mform.page.value = WPro.editors[0].getValue();
	document.mform.submit();
}
function do_abort() {
	document.abortform.submit();
}
//-->
</script>
<?php
// make sure these includes point correctly:
include_once ('/usr/local/cpanel/base/3rdparty/wysiwygPro/wysiwygPro.class.php');

// create a new instance of the wysiwygPro class:
$editor = new wysiwygPro();

$editor->registerButton('save', 'Save',
        'do_save();', '##buttonURL##save.gif', 22, 22,
        'savehandler'); 
$editor->addRegisteredButton('save', 'before:print' );
$editor->addJSButtonStateHandler ('savehandler', 'function (EDITOR,srcElement,cid,inTable,inA,range){ 
        return "wproReady"; 
        }'); 


$editor->registerButton('cancel', 'Cancel',
        'do_abort();', '##buttonURL##close.gif', 22, 22,
        'cancelhandler'); 
$editor->addRegisteredButton('cancel', 'before:print' );
$editor->addJSButtonStateHandler ('cancelhandler', 'function (EDITOR,srcElement,cid,inTable,inA,range){ 
        return "wproReady"; 
        }'); 
$editor->theme = 'blue'; 
$editor->addJSEditorEvent('load', 'function(editor){editor.fullWindow();setHtmlFilters(editor);}');

$editor->baseURL = "http://lancelambert.org/";

$editor->loadValueFromFile('/home/lance/public_html/audio010101-test.html');

$editor->registerSeparator('savecan');

// add a spacer:
$editor->addRegisteredButton('savecan', 'after:cancel');

//$editor->set_charset('iso-8859-1');
$editor->mediaDir = '/home/lance/public_html/';
$editor->mediaURL = 'http://lancelambert.org/';
$editor->imageDir = '/home/lance/public_html/';
$editor->imageURL = 'http://lancelambert.org/';
$editor->documentDir = '/home/lance/public_html/';
$editor->documentURL = 'http://lancelambert.org/';
$editor->emoticonDir = '/home/lance/public_html/.smileys/';
$editor->emoticonURL = 'http://lancelambert.org/.smileys/';
$editor->loadPlugin('serverPreview'); 
$editor->plugins['serverPreview']->URL = 'http://lancelambert.org/.wysiwygPro_preview_60592dd6a1726f7a35c581de4bd58126.php?randomId=7Hqo58bBjehF3dlz_sDFMV9axyD1juMi_QAP7QUKJdnuF4RHE1AuyPSXn817RKCDPJIJ3X0vmvIxURjNDR8_MhUsAVTAhyYuwA8DmCuEv6mjgo9w5N2KdNiy13Tz5z3DXX3CZhnMgH0mXnwaI2acnHEPhuNDKfmxB5vrNEeedMv1f3rw5wKyUpqCPcfdWxxycHyKbLpv_JO7HTwvLT0Jewk8G662E8qIZBpsWOz9A5psFs9zICVPzbkltT3_R9OE';
// print the editor to the browser:
$editor->htmlCharset = 'us-ascii';
$editor->urlFormat = 'relative';
$editor->display('100%','450');

?>
</div>
<script>

</script>

</body>
</html>
<?php ob_end_flush() ?>
