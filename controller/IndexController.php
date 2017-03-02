<?php

class IndexController
{
  public function IndexAction() {
    $message = "Hello World !";

    include('view/Index_Index.phtml');
  }
}
