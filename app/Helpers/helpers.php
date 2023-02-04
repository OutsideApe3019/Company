<?php

class Helpers {
    public function date($date){
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');    
    }

    public static function class() {
        return new Helpers();
    }
}

?>