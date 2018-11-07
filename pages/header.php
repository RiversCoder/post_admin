
<?php
    $jsonDataFile = dirname(__DIR__).DIRECTORY_SEPARATOR.'db.json';
    $json_data = json_decode(file_get_contents($jsonDataFile))->posts;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>数据页面</title>
    <!---<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="ui/css/layui.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="ui/layui.all.js"></script>
    <script src="./data/1.js"></script>
    <script src="./data/format.js"></script>
    <script src="./data/post.js"></script>
</head>
<body>