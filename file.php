<?php
$data = array();
parse_str($_REQUEST['data'], $data);
echo save_file($data);
function save_file($data){
    $my_file = 'run.html';
    $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
    fwrite($handle, $data['html']);
    $my_file1 = 'js/run.js';
    $handle1 = fopen($my_file1, 'w') or die('Cannot open file:  '.$my_file1);
    fwrite($handle1, $data['js']);
    $my_file2 = 'css/run.css';
    $handle2 = fopen($my_file2, 'w') or die('Cannot open file:  '.$my_file2);
    fwrite($handle2, $data['css']);
    return true;
}
?>
