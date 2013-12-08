<?php

header("X-Frame-Options", "GOFORIT");

echo "
<script type='text/javascript'>
    window.onmessage = function(e){
        if (e.data == 'hello') {
            alert('It works!');
        }
    };
    window.onload = function () {
        window.parent.postMessage('ready', '*')
        document.write('Ready')
    };
</script>
PLOP"
?>
