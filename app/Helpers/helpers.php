<?php

class Helpers {
    public function text($text) {
        return 'Text: "' . $text . '". It works!';
    }

    public function date($date){
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');    
    }

    public function redirect($route) {
        return redirect()->route($route);
    }

    public static function class() {
        return new Helpers();
    }
}

?>