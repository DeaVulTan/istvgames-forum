<?php

/**
 * @author Meon
 * @copyright 2013
 */

?>
<html>
<head>
<link rel="stylesheet" href="serverbar.css" type="text/css" media="screen, print" />
<script type='text/javascript' src='serverbar.js'></script>
<script type="text/javascript">
/* Запускаем анимацию изображения */

window.onload = function () { ProgressBarManager(\'progressbar_meter\',true).Live() }

</script>
</head>
<body>
<?php 
include_once('info.php');
echo ShowServer("ISTVGames Minecraft", "31.135.208.98", 25565);
?>
</body>
</html>