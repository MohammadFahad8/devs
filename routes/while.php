<?php
class Father
{
    public $name;

    public function __construct()
    {
        $this->name = "hesoyam";
    }

    public function house()
    {
        echo $this->name;
    }
}

class Son extends Father
{
    public function son()
    {
        echo "<br> I am son";
    }
}

$father_methods_access = new Son();
$father_methods_access->house();
$father_methods_access->son();
