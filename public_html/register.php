<?php

require '../bootloader.php';

$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout'],
    ]
];

$form = [
    'attr' => [
        //'action' => '', Nebūtina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                ]
            ],
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty',
                    'validate_email'
                //validate float
                ]
            ],
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
        'password_second' => [
            'label' => 'Confirm password',
            'type' => 'text',
            'extra' => [
                'validators' => [
                    'validate_not_empty'
                ]
            ],
        ],
    ],
    'buttons' => [
        'submit' => [
            'title' => 'Register',
            'extra' => [
                'attr' => [
                    'class' => 'red-btn'
                ]
            ]
        ],
        'delete' => [
            'title' => 'Unregister',
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
    ],
    'validators' => [
        'validate_match' => [
            'password',
            'password_second'
        ]
    ]
];

//var_dump(\App\App::$db->getData());

$filtered_input = get_form_input($form);

function form_success($filtered_input, &$form) {
    $newUser = new App\Users\User($filtered_input);
    $modelUsers = new App\Users\Model();
    $modelUsers->insert($newUser);

    $form['fields']['password_second']['error'] = 'Registration successfull!';
}

function form_fail() {
    print 'fail';
}

$modelUsers = new App\Users\Model();


switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
    case 'delete':
        foreach ($modelUsers->get() as $user) {
            $modelUsers->deleteAll();
        }
}

function validate_email($field_input, &$field) {
    $modelUser = new App\Users\Model();
    $users = $modelUser->get(['email' => $field_input]);
    if ($users) {
        $field['error'] = 'This email already exists';
        return false;
    }
    return true;
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OOP</title>
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