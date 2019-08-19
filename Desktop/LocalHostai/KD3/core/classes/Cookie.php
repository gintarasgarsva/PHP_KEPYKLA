<?php

namespace Core;

class Cookie extends Abstracts\Cookie {

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        setcookie($_COOKIE[$this->name], null, -1, "/");
        unset($_COOKIE[$this->name]);
    }

    public function exists(): bool {
        if (isset($_COOKIE[$this->name])) {
            return true;
        } else {
            return false;
        }
    }

    public function read($encoded_array): array {
        if ($this->exists()) {
            $decoded_array = json_decode($encoded_array, true);
            if ($decoded_array) {

                return $decoded_array;
            }

            trigger_error("Cannot divide by zero", E_USER_WARNING);
        }

        return [];
    }

    public function save($data, $expires_in = 3600): void {
        $encoded_array = json_encode($data);
        setcookie($_COOKIE[$this->name], $encoded_array, time() + $expires_in, "/");
    }

}
