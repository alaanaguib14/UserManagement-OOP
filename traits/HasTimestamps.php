<?php
trait HasTimestamps {
    public string $created_at;
    public string $updated_at;

    public function setTimestamps(){
        $now = date('Y-m-d H:i:s');
        $this->created_at = $now;
        $this->updated_at = $now;
    }
}
