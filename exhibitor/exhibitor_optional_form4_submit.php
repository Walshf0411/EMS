<?php
    if (isset($_POST['selected_items'])) {
        $arr = json_decode($_POST['selected_items']);
        var_dump($arr);
    }
?>