<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Uploading!</title>
</head>
<body>
<?php
    $itemname = $_POST["itemname"];
    $uploadpath = "/home/r/romanh/wp.romanh.bget.ru/public_html/pubupload/upload/";
    if ($_FILES) {
        if (file_exists("/home/r/romanh/wp.romanh.bget.ru/public_html/pubupload/upload".$itemname)) {
        } else {
            mkdir("/home/r/romanh/wp.romanh.bget.ru/public_html/pubupload/upload/".$itemname, 0700, true);
            $uploadpath = "/home/r/romanh/wp.romanh.bget.ru/public_html/pubupload/upload/".$itemname;
        }
        
        foreach ($_FILES["filename"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $filename = $_FILES["filename"]["name"][$key];
                $tmp_name = $_FILES["filename"]["tmp_name"][$key];
                move_uploaded_file($tmp_name, $uploadpath."/".$filename);
            }
        }
    }
?>
<h2>Thank you for photos!</h2>
<h3>You'll be redirected after 3 seconds...</h3>
<script>
    var delay = 3000;
    setTimeout("document.location.href='http://wp.romanh.bget.ru/pubupload/upload.html'", delay);
</script>
</body>
</html>