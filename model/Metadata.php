<?php
namespace CustomTheme\Model;


/**
 * Class Metadata
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $value_type
 */
class Metadata {
    public $id;
    public $name;
    public $value;
    public $value_type;
    public function __construct($metadata) {
        $this->id = $metadata->id;
        $this->name = $metadata->name;
        $this->value = $metadata->value;
        $this->value_type = $metadata->value_type;
    }
}
