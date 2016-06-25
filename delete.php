<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Copy</title>
</head>
<body>
<?php
    // $from = $_POST["from"];
    $target = $_POST["target"];
    $checks = $_POST["checks"];
    $sukafile = $_POST["sukafile"];
    $from_dir = "/home/r/romanh/wp.romanh.bget.ru/public_html/pubupload/upload";
    $target_dir = "/home/r/romanh/wp.romanh.bget.ru/public_html/images/jingdian";
    // $action_copy = copy($from_dir.'/'.substr($value, 7), substr($target_dir, 1).'/'.$target);
    // $action_delete = unlink($from_dir.'/'.substr($value, 7));
    
    for ($i = 0; $i < count($checks); $i++) {
        $action_copy_from = $from_dir.'/'.substr($checks[$i], 7);
        $action_copy_target = $target_dir.'/'.$target.'/'.substr($sukafile[$i], 7);
        
        echo $action_copy_from;
        unlink("$action_copy_from");
    }
    
?>
<br>
<script>
    document.location.href='http://wp.romanh.bget.ru/pubupload/list.php';
</script>

</body>
</html>