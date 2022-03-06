<?php

// Documentation: https://github.com/Wixel/GUMP

namespace Core;
use GUMP;

class Validator {

    public static function validate($rules, $input = []) {

        if(empty($input)) {
            $input = array_merge($_GET, $_POST, $_FILES);
        }

        GUMP::set_error_messages([
            'required'    => '{field} is required.',
            'valid_email' => '{field} must be a valid email.'
        ]);

        return GUMP::is_valid($input, $rules);

    }

    
}