<?php

    require('./style/theme/login-elements.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style/tags.css" rel="stylesheet">
    <link href="style/classes.css" rel="stylesheet">
    <link href="style/buttons/UI-Button/button.css" rel="stylesheet">
    <link href="style/ids.css" rel="stylesheet">
    <title>Enter - Log in</title>
</head>
<body>
    <?php echo(Element::getElement('nav')); ?>
    <script type="text/javascript">document.getElementsByClassName('login')[0].remove();</script>
</body>
</html>
