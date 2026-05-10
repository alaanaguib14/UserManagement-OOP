<?php
require_once '../traits/HasTimestamps.php';
abstract class BaseModel {
    use HasTimestamps;

    public $id;
}
