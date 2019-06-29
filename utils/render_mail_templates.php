<?php 
function renderToString($context, $fileName) {
    extract($context);
    ob_start();
    include $fileName;
    $mailContent = ob_get_clean();
    return $mailContent;
}

/*
=====render html to string=====
context accepts at the most 5 params
below three + context2 & context3 which are optional
$context = array(
    "content1" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam perferendis ad magni soluta doloremque nulla voluptatem saepe, facere ratione natus repellendus optio corrupti quisquam, dolor velit cumque suscipit libero possimus in delectus asperiores porro at eius tempore. Magnam fugiat explicabo, reprehenderit error rem libero enim sapiente nobis repellendus, cumque atque!",
    "user" => "Walsh Tony Fernandes", 
    "mainHeader" => "REGISTRATION SUCCESSFULL."
);
echo renderToString($context, '../mail_templates/base.php');
 */
?>