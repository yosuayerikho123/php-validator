# PHP Simple Validator
This is just simple validator created with php and inspired by laravel

### Examples
You can add data you want

```php
require_once "Validator.php";

$validator = new Validator();
$validator->storeToSession(true);
// make validation rules
$validator->make([
    "username"      => "admin1",
    "password"      => "password1234",
    "number"        => "3",
    "gender"        => "male"
], [
    "username"      => [
        "rules"     => "required|min:5|max:6",
        // you can create custom messages into each rule like this
        "messages"  => [
            "required"   => "Username harus diisi",
            "min"        => "Panjang karakter username minimal 5" 
        ]          
    ],
    "password"      => [
        "rules"     => "required|min:9|max:19",
    ],
    "number"        => [
        "rules"     => "required|integer|digits_between:1,5",
    ],
    "gender"        => [
        "rules"     => "required|in:male,female",
    ]
]);
```

Then check if validation success
```php
if (!$validator->success()) {
    var_dump($validator->messages());
} else {
    echo "nothing wrong";
}
```

### Full Code
```php
require_once "Validator.php";

$validator = new Validator();
// set store to session to TRUE if you want to store the message
// into session
$validator->storeToSession(true);
// make validation rules
$validator->make([
    "username"      => "admin1",
    "password"      => "password1234",
    "number"        => "3",
    "gender"        => "male"
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
    "gender"        => [
        "rules"     => "required|in:male,female",
    ]
]);

if (!$validator->success()) {
    var_dump($validator->messages());

    // if store to session set to TRUE, the message will store to session
    // and the key name started with "error-*"
    // example, if username and password error, you can get it with
    var_dump($_SESSION["error-username"]);
    var_dump($_SESSION["error-password"]);
    
} else {
    echo "nothing wrong";
}
```

### List Rule

| Rule              |
| ----------------- | 
| `required`        | 
| `min`             | 
| `max`             | 
| `integer`         | 
| `digits_between`  | 
| `in`              |
