<?php

class Validator {
    private $messages = [];
    private $error = false;
    private $storeToSession = false;

    public function messages()
    {
        return $this->messages;
    }

    public function storeToSession($value = false)
    {
        $this->storeToSession = $value;
    }

    public function success()
    {
        return !$this->error;
    }

    private function createMessage($condition = false, string $key, string $message)
    {
        if ($condition) {
            $this->error = true;
            if (!empty($this->messages[$key])) {
                array_push($this->messages[$key], $message);
            } else {
                $this->messages[$key] = [$message];
            }

            if ($this->storeToSession) {

            }
        }
    }

    public function make(array $data, $validations = [])
    {
        foreach ($validations as $key => $value) {
            $rules = $validations[$key]["rules"];
            $rules = explode('|', $rules);

            foreach ($rules as $rule) {
                $r = explode(":", $rule);
                if ($r[0] === "required" && empty($data[$key])) {
                    $this->createMessage(empty($data[$key]), $key, "$key cannot be empty");
                } else if (!empty($data[$key])) {
                    if ($r[0] === "min") {
                        $this->createMessage(strlen($data[$key]) < $r[1], $key, "$key minimum length is $r[1]");
                    } elseif ($r[0] === "max") {
                        $this->createMessage(strlen($data[$key]) > $r[1], $key, "$key maximum length is $r[1]");
                    } elseif ($r[0] === "integer") {
                        $this->createMessage(!is_numeric($data[$key]), $key, "$key must a number");
                    } elseif ($r[0] === "digits_between") {
                        $exploded = explode(',', $r[1]);
                        $min = $exploded[0];
                        $max = $exploded[1];
                        $this->createMessage(!($data[$key] >= $min && $data[$key] <= $max), $key, "$key must be between $min and $max");
                    } elseif ($r[0] === "in") {
                        $array      = explode(',', $r[1]);
                        $this->createMessage(!in_array($data[$key], $array), $key, "$key must be between $r[1]");
                    }
                }
            }
        }
    }
}