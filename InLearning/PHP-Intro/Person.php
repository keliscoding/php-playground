<?php

class Person
{
    var $name;
    var $age;
    var $birthday = false;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age): void
    {
        $this->age = $age;
    }

    public function setBirthday($date): void
    {
        $this->birthday = $date;
        $this->update_age();
    }

    private function update_age()
    {
        $this->age = ($this->birthday) ? ++$this->age : $this->age;
    }

}


$joe = new Person('Joe', 35);

echo $joe->getName();