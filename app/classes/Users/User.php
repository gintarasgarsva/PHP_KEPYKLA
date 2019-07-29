<?php

namespace App\Users;

class User {

    private $data = [];

    public function __construct($data = null) {
        if ($data) {
            $this->setData($data);
        } else {
            $this->data = [
                'name' => null,
                'surname' => null,
                'email' => null,
                'password' => null
            ];
        }
    }

    /**
     * Sets all data from array
     * @param array $array
     */
    public function setData($array) {
        if (isset($array['id'])) {
            $this->setId($array['id']);
        } else {
            $this->data['id'] = null;
        }
        $this->setName($array['name'] ?? null);
        $this->setSurname($array['surname'] ?? null);
        $this->setEmail($array['email'] ?? null);
        $this->setPassword($array['password'] ?? null);
    }

    /**
     * Gets all data as array
     * @return array
     */
    public function getData() {
        return [
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()
        ];
    }

    /**
     * Sets name
     * @param string $name
     */
    public function setName(string $name) {
        $this->data['name'] = $name;
    }

    /**
     * Returns name
     * @return string
     */
    public function getName() {
        return $this->data['name'];
    }

    /**
     * Sets surname data 
     * @param string $surname
     */
    public function setSurname(string $surname) {
        $this->data['surname'] = $surname;
    }

    /**
     * Returns surname
     * @return string
     */
    public function getSurname() {
        return $this->data['surname'];
    }

    /**
     * Sets email data 
     * @param string
     */
    public function setEmail(string $email) {
        $this->data['email'] = $email;
    }

    /**
     * Returns email
     * @return fstring
     */
    public function getEmail() {
        return $this->data['email'];
    }

    public function setPassword(string $password) {
        $this->data['password'] = $password;
    }

    /**
     * Returns email
     * @return fstring
     */
    public function getPassword() {
        return $this->data['password'];
    }

    public function setId(int $id) {
        $this->data['id'] = $id;
    }

    /**
     * Returns Id
     * @return int
     */
    public function getId() {
        return $this->data['id'];
    }

}
