<?php
namespace CustomTheme\Model;

class Department {
    public $id;
    public $name;
    public $countJobs;

    public function __construct($department) {
        $this->id = $department->id;
        $this->name = $department->name;
        $this->countJobs = $department->countJobs;
    }
}
