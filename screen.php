 <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Test</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="javascript/jquery.cookie.js"></script>
        <script type=text/javascript>
            function setScreenHWCookie() {
                $.cookie('sw',screen.width);
                $.cookie('sh',screen.height);
                return true;
            }
            setScreenHWCookie();
        </script>
    </head>
    <body>
        <h1>Using jquery.cookie.js to store screen height and width</h1>
    <?php
         if(isset($_COOKIE['sw'])) { echo "Screen width: ".$_COOKIE['sw']."<br/>";}
         if(isset($_COOKIE['sh'])) { echo "Screen height: ".$_COOKIE['sh']."<br/>";}
    ?>
    </body>
    </html>