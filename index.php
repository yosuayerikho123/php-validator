<?php
require_once "Validator.php";

$validator = new Validator();
$validator->make([
    "username"      => "admin1",
    "password"      => "password1234",
    "number"        => "3",
    "array"         => "male"
], [
    "username"      => [
        "rules"     => "required|min:5|max:6",
    ],
    "password"      => [
        "rules"     => "required|min:9|max:19",
    ],
    "number"        => [
        "rules"     => "required|integer|digits_between:1,5",
    ],
    "array"         => [
        "rules"     => "required|in:male,female",
    ]
]);

if (!$validator->success()) {
    var_dump($validator->messages());
} else {
    echo "nothing wrong";
}