<?php
header("Content-type: text/css; charset: UTF-8");
$menu=file_get_contents("../inc/menu.php");
// $css= file_get_contents("./style.css");
$liCount=substr_count($menu,'<li class="tag">');
$menu_Height = "15%";

include_once("./style.css");
include_once("./globalTag.css");
include_once("./single.css");
include_once("./WnH.css");

for ($i=0; $i <=100 ; $i++) {
    print("
    .wm_fz-$i{
      font-size:".$i."px ;
    }");
}

for ($i=0; $i <10 ; $i++) {
  print("
  .border_$i{
    border: ".$i."px solid #333;
  }

  .border_top$i{
    border-top: ".$i."px solid #333;
  }

  .border_bottom$i{
    border-bottom: ".$i."px solid #333;
  }

  .border_L$i{
    border-left: ".$i."px solid #333;
  }

  .border_R$i{
    border-right: ".$i."px solid #333;
  }

  ");
}
