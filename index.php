<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/sprintfilebrowser/css/reset.css">
    <link rel="stylesheet" href="/sprintfilebrowser/css/style.css">
    <title>File browser</title>
</head>
<body>
<?php

$path = '.';
if (isset($_GET['a'])){
    $path = $_GET['a'];
    echo'<input type="button" value="Back" onclick="window.history.back()">';
}

echo readFolderFiles($path);

function readFolderFiles($path) {
    $scandirResult = scandir($path);
    
    $out ='<table><tr><th>Type</th><th id="name">Name</th><th>Option</th></tr>';

    foreach ($scandirResult as $name) {
        if (substr($name, 0, 1) != '.') {
    
            if (is_dir($path.'/'.$name)) {
                
                $folder = $name;
                $link = str_replace('./','', '?a='.$path.'/'.$folder);
                //'?a=./css
                //'?a=css/pavyzdys          
                $out .= '<tr>';
                $out .= '<td>Directory</td>';
                $out .= '<td><a href ="'.$link.'">'.$folder.'</a></td>';
                $out .= '<td></td>';
                $out .= '</tr>';
            } else {
                $files = $name;
                $out .= '<tr><td>'.'File'.'</td>'.'<td>'.$files.'</td>'.'<td></td></tr>';
            }
        }
    }
    $out .= '</table>';
    return $out;
}

?>
    
</body>
</html>