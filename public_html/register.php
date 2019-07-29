<?php
require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home'],
        ['url' => 'register.php', 'title' => 'Register']
    ]
];

$form = [
    'attr' => [
        //'action' => '', Neb8tina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'type' => 'text',
            'label' => 'Vardas',
            'placeholder' => 'Vardas',
            'extra' => [
                'attr' => [
                    'class' => 'name',
                    'placeholder' => 'Name'
                ],
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'surname' => [
            'type' => 'text',
            'label' => 'Pavarde',
            'extra' => [
                'attr' => [
                    'class' => 'surname',
                    'placeholder' => 'Surname'
                ],
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'email' => [
            'type' => 'email',
            'label' => 'Email',
            'filter' => FILTER_SANITIZE_EMAIL,
            'extra' => [
                'attr' => [
                    'class' => 'email',
                    'placeholder' => 'Email Adress'
                ],
                'validators' => [
                    'validate_not_empty',
                    'validate_email'
                ]
            ],
        ],
        'password' => [
            'label' => 'Enter Your Password:',
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'class' => 'password',
                    'placeholder' => 'Password'
                ],
                'validators' => [
                    'validate_not_empty',
                    'validate_password'
                ]
            ],
        ],
        'password_repeat' => [
            'label' => 'Re-enter Your Password:',
            'type' => 'password',
            'extra' => [
                'attr' => [
                    'class' => 'password',
                    'placeholder' => 'Re-enter password'
                ],
                'validators' => [
                    'validate_not_empty',
                    'validate_password'
                ]
            ],
        ],
    ],
    'buttons' => [
        'Pasirinkti' => [
            'title' => 'OK',
            'extra' => [
                'attr' => [
                    'class' => 'blue-btn'
                ]
            ]
        ],
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ]
];

//if (isset($_POST['action'])){
//    $naudotojas = new App\Users\User();
//}

function validate_email($filtered_input, &$field) {
    $modelUsers = new App\Users\Model();
    $users = $modelUsers->get(['email' => $filtered_input]);

    if ($users) {
        $field['error'] = 'Toks email jau yra';
        return false;
    }
    return true;
}

function validate_password() {
    if ($_POST['password'] === $_POST['password_repeat']) {
        return true;
    }
    return false;
}

function form_fail($filtered_input, &$form) {
    var_dump('Form failed!');
}

function form_success($filtered_input, &$form) {
    var_dump('Form succeeded!');
    $naudotojas = new App\Users\User($filtered_input);
    $modelUsers = new App\Users\Model();
    $modelUsers->insert($naudotojas);
}

// Get all data from $_POST
$input = get_form_input($form);

// If any data was entered, validate the input
if (!empty($input)) {
    $success = validate_form($input, $form);
    $message = $success ? 'Cool!' : 'Ooops! Kazkas netaip.';
}


?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="media/css/normalize.css">
        <link rel="stylesheet" href="media/css/style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">        
        <script defer src="media/js/app.js"></script>
    </head>
    <body>
<?php require ROOT . '/app/templates/navigation.tpl.php'; ?>

        <div class="content">
<?php require ROOT . '/core/templates/form/form.tpl.php'; ?>
        </div>

    </body>
</html>

