<?php
namespace Src\Views;

class ToView
{
private $urlView;

public function __construct($urlView)
{
    $this->urlView = __DIR__ . "/". $urlView;
}

    public function viewStandard(string $template, $data = [])
    {
        require $this->urlView . "/". $template . ".php";
    }


}