<?php

function MostrarCSS()
{
    echo
        '<head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>SGH</title>

            <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
            <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
            <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
            <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">

            <link rel="stylesheet" href="../assets/css/style.css">

            <link rel="shortcut icon" href="../assets/images/favicon.png" />
        </head>';
}

function MostrarJS()
{
    echo
        '
        <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/misc.js"></script>
        <script src="../assets/js/settings.js"></script>
        <script src="../assets/js/todolist.js"></script>
        <script src="../assets/js/jquery.cookie.js"></script>';
}

?>