<?php

namespace Core;

class Cookie extends Abstracts\Cookie {

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        $_COOKIE = [];
    }

    public function exists(): bool {
        if (isset($_COOKIE[$this->name])) {
            return true;
        } else {
            return false;
        }
    }

    public function read($encoded_array): array {
        $decoded_array = json_decode($encoded_array, true);
        if ($decoded_array) {
            return true;
        } else {
            error_reporting(E_WARNING);
            $decoded_array = [];
        }

        if (exists() == false) {
            return $_POST[$this->name] = [];
        }
    }

    public function save($data, $expires_in = 3600): void {
        $encoded_array = json_encode($data);
        return setcookie($this->name, $encoded_array,time() + $expires_in, "/");
    }

}
