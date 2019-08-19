<?php ?>

<html>
    <body>
        <script>
            'use strict';
            fetch("./test.php", {
                method: "POST",
                body: {
                    action: "submit"
                }
            })
                    .then(response => {
                        response.text().then(text => {
                            console.log(text);
                        });
                    });
        </script>
    </body>
</html>