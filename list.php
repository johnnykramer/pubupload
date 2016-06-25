<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Moderation uploaded images</title>
    <link rel="stylesheet" href="/templates/protostar/uikit/css/uikit.min.css">
    <link rel="stylesheet" href="/templates/protostar/uikit/css/components/lightbox.css">
    <style type="text/css">
        h1 {
            text-align: center;
        }
        
        body {
            width: 600px;
            margin: 0 auto;
        }
        
        .block {
            margin-bottom: 15px;
            background: #f1f2f3;
            border: 1px solid #dedede;
            position: relative;
        }
    
        .block a {
            display: block;
        }
        
        .block a h2 {
            padding: 0;
            margin: 0;
            text-align: center;
        }
        
        .checks {
            position: absolute;
            left: 0;
            top: 0;
            width: 50px;
            height: 50px;
            z-index: 10;
        }
    </style>
</head>
<body>
    <h1>Moderation uploaded images</h1>
    <?php 
    
    $directory = "upload";
    $target_dir = "/home/r/romanh/wp.romanh.bget.ru/public_html/images/jingdian";
    function Read_Dir ($directory) { 
        if ( is_readable ($directory)) { 
            $handle = opendir ($directory); 
            while ( $files = readdir ($handle)) { 
                if ($files!="." and $files!="..") { 
                    if ( is_dir ($directory."/". $files)) { 
                        $ARR_dir[] = $directory."/". $files; 
                        if (Read_Dir ($directory."/". $files)) {
                            $ARR_dir[] = Read_Dir ($directory."/". $files); 
                        } 
                    } 
                } 
            } 
            clearstatcache (); 
            closedir ($handle); 
            return $ARR_dir;
        } 
        return false; 
    }
    
    function Read_Target_Dir ($target_dir) { 
        if ( is_readable ($target_dir)) { 
            $handle = opendir ($target_dir); 
            while ( $files = readdir ($handle)) { 
                if ($files!="." and $files!="..") { 
                    if ( is_dir ($target_dir."/". $files)) { 
                        $ARR_target_dir[] = $target_dir."/". $files; 
                        if (Read_Target_Dir ($target_dir."/". $files)) {
                            $ARR_target_dir[] = Read_Target_Dir ($target_dir."/". $files); 
                        } 
                    } 
                } 
            } 
            clearstatcache (); 
            closedir ($handle); 
            return $ARR_target_dir;
        } 
        return false; 
    } 
    $ARR_target_dir = Read_Target_Dir ($target_dir);
    $ARR_dir = Read_Dir ($directory);
    
    echo '<form id="actions" name="actions" class="uk-form" method="post">';
        echo '<fieldset>';
            echo '<div class="uk-form-row">';
                echo '<select name="target" class="uk-width-6-10 uk-form-large">';
                    foreach ($ARR_target_dir as $value) {
                      echo '<option>'.substr($value, 61).'</option>';
                    }
                echo '</select>';
                
                echo '<input type="button" class="uk-width-1-10 uk-form-large" onClick="document.actions.action=\'copy.php\';" value="+">';
                echo '<input type="button" class="uk-width-1-10 uk-form-large" onClick="document.actions.action=\'delete.php\';" value="-">';
                
                echo '<input type="submit" class="uk-width-2-10 uk-form-large" value="Action!">';
            echo '</div>';
        
            foreach ($ARR_dir as $value) {
                $this_dir = $value;
                 // Папка с изображениями
                $allowed_types=array("jpg", "png", "gif");  //разрешеные типы изображений
                $file_parts = array();
                  $ext="";
                  $title="";
                  $i=0;
                //пробуем открыть папку
                  $dir_handle = @opendir($this_dir) or die("Ошибка при открытии папки !!!");
                while ($file = readdir($dir_handle))    //поиск по файлам
                  {
                  if($file=="." || $file == "..") continue;  //пропустить ссылки на другие папки
                  $file_parts = explode(".",$file);          //разделить имя файла и поместить его в массив
                  $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
            
            
                    if(in_array($ext,$allowed_types)) {
                        
                    echo '<div class="block">';
                        echo '<a href="'.$this_dir.'/'.$file.'" data-uk-lightbox="{group:\'group\'}" title="'.substr($this_dir, 7).'">';
                            echo '<img src="'.$this_dir.'/'.$file.'" title="'.substr($this_dir, 7).'" />';
                            echo '<h2>'.substr($this_dir, 7).'</h2>';
                        echo '</a>';
                        echo '<input type="checkbox" class="checks" name="checks[]" value="'.$this_dir.'/'.$file.'">';
                        echo '<input type="hidden" name="sukafile[]" value="'.$file.'">';
                    echo '</div>';
                    
                    $i++;
                    }
            
                  }
                closedir($dir_handle);  //закрыть папку
            }
        echo '<fieldset>';
    echo '</form>';
    
    ?>
    <script src="/media/jui/js/jquery.min.js"></script>
	<script src="/templates/protostar/uikit/js/uikit.min.js"></script>
	<script src="/templates/protostar/uikit/js/components/lightbox.js"></script>
</body>
</html>