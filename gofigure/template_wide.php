<!DOCTYPE html>
<html>
<head>
    <title>GoFigure - %TITLE%</title>
    <meta charset="UTF-8"/>
    <script type="text/javascript" src="/js/jquery-1.6.4.js"></script>
    <script type="text/javascript" src="/js/jquery.tools.min.js"></script>
    <script type="text/javascript" src="/js/global.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/gofigure.css"/>
    <link rel="stylesheet" type="text/css" href="/css/primeout.css"/>
    <link rel="stylesheet" type="text/css" href="/css/simplify.css"/>
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="/css/css3-challenged.css"/>
<![endif]-->
    <style type="text/css">
        #nav {
            clear:both;
            position:relative;
            float:right;
        }
        #nav ul {
            margin:0;
            padding:0;
        }
        #nav li {
            display:inline;
            float:left;
            padding-left:10px;
            padding-right:10px;
            font:12px arial;
            color:white;
        }
        #nav li a, #nav li.visited {
            text-decoration:none;
            color:white;
        }
        #nav li a:hover {
            text-decoration:underline;
        }
    </style>
</head>
<body>
<div id="frame">
    <div id="header">
        <h1>GoFigure</h1>
        <h2>%TITLE%</h2>
    <div id="nav">
        <ul>
            <li><a href="simplify.php">Simplify!</a></li>
            <li><a href="primeout.php">PrimeOut</a></li>
        </ul>
    </div>
    </div>
    <div id="content_frame">
%CONTENT%
    </div>
    <br style="clear:both"/>
</div>
</body>
</html>
