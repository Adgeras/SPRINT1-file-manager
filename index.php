<div>
 <?php
      
//********** Logic to login ************************

session_start();
 $msg = 'Wrong username or password';
 if (isset($_POST['login']) 
     && !empty($_POST['username']) 
     && !empty($_POST['password'])
 ) {	
    if ($_POST['username'] == 'Edgaras' && 
       $_POST['password'] == 'password'
     ) {
       $_SESSION['logged_in'] = true;
       $_SESSION['timeout'] = time();
       $_SESSION['username'] = 'Edgaras';
    } else {
       $msg;
    }
 }
// **************  Logout logic ***********************

     if(isset($_GET['action']) and $_GET['action'] == 'logout'){
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['logged_in']);
        print('Logged out!');
    }
 ?>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>File browser</title>
</head>
<body>
<?php

if(!$_SESSION['logged_in'] == true){

    // Login form

    print('<div class = "form"><span> Please enter username and password</span><form action = "index.php?path=" method = "post">');
    print('<h4>' . $msg . '</h4>');
    print('<input type = "text" class = "username" name = "username"  required autofocus></br>');
    print('<input type = "password" class = "password" name = "password" required>');
    print('<button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "login">Login</button>');
    print('</form></div>');
    die();

}


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
<div class="logout">
 <a href = "index.php?action=logout"> Logout </a>
</div>  
</body>
</html>