<?php

namespace Core;

class Session {

    public function get($key) {
        if(empty($key)) return (object)$_SESSION;
        return $_SESSION[$key];
    }

    public function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    // Removes variables without losing session_id
    public function clear(): bool {
        return session_unset();
    }

    // Removes session and session_id
    public function destroy(): bool {
        return session_destroy();
    }

}