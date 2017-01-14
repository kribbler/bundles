<?php
if ($_GET['randomId'] != "Oiavrf7zZxNcp40uZZKjXB0DqdJg46tTzI_lqPcWcnzaLtI1qcM4DgR5YXfw8FKRL7M6xPoZiiUmoaE4BLl8qWSe4LbfZ3nZpEeDpqx6a5MWt1Ft7yuJrqd3SedhWtszvt1g4vZBrtJO9q8zr4p6LckR2Qjh0xmxJtUD7C0isXee542SnWq0lJsb7gfEJQaRZtzzLlffqwBohoP5uFrQJIL5l9Daxtn7hFlBq8AKCbG4GTnCIGQrIxWpO8zHCFzx") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
