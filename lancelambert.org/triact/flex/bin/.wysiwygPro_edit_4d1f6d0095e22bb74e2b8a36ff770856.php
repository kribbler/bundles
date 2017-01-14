<?php ob_start() ?>
<?php
if ($_GET['randomId'] != "Oiavrf7zZxNcp40uZZKjXB0DqdJg46tTzI_lqPcWcnzaLtI1qcM4DgR5YXfw8FKRL7M6xPoZiiUmoaE4BLl8qWSe4LbfZ3nZpEeDpqx6a5MWt1Ft7yuJrqd3SedhWtszvt1g4vZBrtJO9q8zr4p6LckR2Qjh0xmxJtUD7C0isXee542SnWq0lJsb7gfEJQaRZtzzLlffqwBohoP5uFrQJIL5l9Daxtn7hFlBq8AKCbG4GTnCIGQrIxWpO8zHCFzx") {
    echo "Access Denied";
    exit();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Editing main.html</title>
<meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
<style type="text/css">body {background-color:threedface; border: 0px 0px; padding: 0px 0px; margin: 0px 0px}</style>
</head>
<body>
<div align="center">

<div id="saveform" style="display:none;">
<form METHOD="POST" name=mform action="https://www.lancelambert.org:2083/frontend/x3/filemanager/savehtmlfile.html">
    <input type="hidden" name="charset" value="us-ascii">
    <input type="hidden" name="baseurl" value="http://lancelambert.org/triact/flex/bin/">
    <input type="hidden" name="basedir" value="/home/lance/public_html/">
    <input type="hidden" name="udir" value="/home/lance/public_html/triact/flex/bin">
    <input type="hidden" name="ufile" value="main.html">
    <input type="hidden" name="dir" value="%2fhome%2flance%2fpublic_html%2ftriact%2fflex%2fbin">
    <input type="hidden" name="file" value="main.html">
    <input type="hidden" name="doubledecode" value="1">
<textarea name=page rows=1 cols=1></textarea></form>
</div>
<div id="abortform" style="display:none;">
<form METHOD="POST" name="abortform" action="https://www.lancelambert.org:2083/frontend/x3/filemanager/aborthtmlfile.html">
    <input type="hidden" name="charset" value="us-ascii">
    <input type="hidden" name="baseurl" value="http://lancelambert.org/triact/flex/bin/">
    <input type="hidden" name="basedir" value="/home/lance/public_html/">
    <input type="hidden" name="dir" value="%2fhome%2flance%2fpublic_html%2ftriact%2fflex%2fbin">
        <input type="hidden" name="file" value="main.html">
    <input type="hidden" name="udir" value="/home/lance/public_html/triact/flex/bin">
    <input type="hidden" name="ufile" value="main.html">

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

$editor->baseURL = "http://lancelambert.org/triact/flex/bin/";

$editor->loadValueFromFile('/home/lance/public_html/triact/flex/bin/main.html');

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
$editor->plugins['serverPreview']->URL = 'http://lancelambert.org/triact/flex/bin/.wysiwygPro_preview_4d1f6d0095e22bb74e2b8a36ff770856.php?randomId=Oiavrf7zZxNcp40uZZKjXB0DqdJg46tTzI_lqPcWcnzaLtI1qcM4DgR5YXfw8FKRL7M6xPoZiiUmoaE4BLl8qWSe4LbfZ3nZpEeDpqx6a5MWt1Ft7yuJrqd3SedhWtszvt1g4vZBrtJO9q8zr4p6LckR2Qjh0xmxJtUD7C0isXee542SnWq0lJsb7gfEJQaRZtzzLlffqwBohoP5uFrQJIL5l9Daxtn7hFlBq8AKCbG4GTnCIGQrIxWpO8zHCFzx';
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
