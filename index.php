<?php
session_start();
require_once "Validator.php";

$validator = new Validator();
//$validator->storeToSession(true);
$validator->make([
    "username"                  => "ad1ffff",
    "password"                  => "password1234",
    "number"                    => "pd",
    "array"                     => "ma1le"
], [
    "username"                  => [
        "rules"                 => "required|min:5|max:6",
        "messages"              => [
            "required"          => "Username harus diisi",
            "min"               => "Panjang karakter username minimal 5",
            "max"               => "Panjang karakter username maksimal 6",
        ]
    ],
    "password"                  => [
        "rules"                 => "required|min:9|max:19",
    ],
    "number"                    => [
        "rules"                 => "required|min:3",
    ],
    "array"                     => [
        "rules"                 => "required|in:male,female",
    ]
]);

if (!$validator->success()) {
    echo "<pre>";
    var_dump($validator->messages());
    echo "</pre>";
} else {
    echo "nothing wrong";
}