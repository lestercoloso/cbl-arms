<?php

class A
{

    public function getName()
    {
        return 'test';
    }
}

class B
{
    public function __construct(A $a)
    {
        $this->a = $a;
    }

    function getNameOfA()
    {
        return $this->a->getName();
    }
}

$a = new A();
$b = new B($a);

echo $b->getNameOfA();
?>