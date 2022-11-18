<?php
class Validate {
    public static function is_empty($data) {
        return $data == '';
    }

    public static function is_email($data) {
        return preg_match("/^\w+@\w+\.\w+$/", $data) == 1 ? true : false;
    }

    public static function min_length($data, $min) {
        return strlen($data) >= $min;
    }

    public static function max_length($data, $max) {
        return strlen($data) <= $max;
    }

    /* 
    * Aquest mètode accepta tots els elements desitjats i retorna si algun d'ells està buit
    */
    public static function is_any_empty(...$data) {
        $empty = false;
        foreach ($data as $key => $element) {
            if (Validate::is_empty($element)) 
                $empty = true;
        }
        return $empty;
    }

    /* 
    * Aquest mètode accepta tots els elements desitjats i els saneja
    * Per cada element, converteix les etiquetes sensibles en el corresponent codi HTML
    * Com que els arguments es passen per referència (&), són modificats automàticament
    */
    public static function sanitize(&...$data) {
        foreach ($data as $key => &$element) 
            $element = htmlspecialchars($element);
         
    }

    /* 
    * Aquest mètode accepta tots els elements desitjats i elimina els espais inicials i finals
    * Com que els arguments es passen per referència (&), són modificats automàticament
    */
    public static function trim(&...$data) {
        foreach ($data as $key => &$element) 
            $element = trim($element);
        
    }

    /* 
    * Aquest mètode accepta tots els elements desitjats i elimina els espais que hi ha
    * Com que els arguments es passen per referència (&), són modificats automàticament
    */
    public static function remove_all_whitespaces(&...$data) {
        foreach ($data as $key => &$element) {
            $element = trim($element);
        }
    }


}
?>