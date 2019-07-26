<?php
require '../bootloader.php';

$dataBase = new \Core\FileDB(DB_FILE);

$nav = [
    'left' => [
        ['url' => '/', 'title' => 'Home']
    ]
];

$form = [
    'attr' => [
        //'action' => '', Neb8tina, jeigu action yra ''
        'method' => 'POST',
    ],
    'fields' => [
        'test_select' => [
            'type' => 'select',
            'label' => 'It`s Time To Choose',
            'value' => 1, // Koreliuoja su options pasirinkimo indeksu
            'options' => [
                'alus',
                'vodke',
                'antifryzas',
                'piens'
            ],
            'extra' => [
                'attr' => [
                    'class' => 'my-select-field',
                ],
                'validators' => [
                    'validate_not_empty'
                ]
            ]
        ]
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
        'Isgerti' => [
            'title' => 'NO',
            'extra' => [
                'attr' => [
                    'class' => 'red-btn'
                ]
            ]
        ]
    ],
    'callbacks' => [
        'success' => 'form_success',
        'fail' => 'form_fail'
    ]
];



$modelDrinks = new App\Drinks\Model($dataBase);

//var_dump($modelDrinks->get());
//$drinks = $modelDrinks->get(['abarot' => 45]);


$drink_absentas = new App\Drinks\Drink(
        [
    'name' => 'Absentas',
    'amount_ml' => 100,
    'abarot' => 70,
    'image' => '.jpg'
        ]
);
$drink_zaibo = new App\Drinks\Drink(
        [
    'name' => 'zaibo alus',
    'amount_ml' => 500,
    'abarot' => 10,
    'image' => '.jpg'
        ]
);
$drink_brendis = new App\Drinks\Drink(
        [
    'name' => 'Brendis',
    'amount_ml' => 700,
    'abarot' => 40,
    'image' => '.jpg'
        ]
);
$drink_gira = new App\Drinks\Drink(
        [
    'name' => 'Gira',
    'amount_ml' => 1000,
    'abarot' => 4,
    'image' => '.jpg'
        ]
);

//$modelDrinks->insert($drink_absentas);
//$modelDrinks->insert($drink_zaibo);
//$modelDrinks->insert($drink_brendis);
//$modelDrinks->insert($drink_gira);
//var_dump($modelDrinks->get());

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

        <form>
            <select>

                <?php foreach ($modelDrinks->get() as $drink_id => $drink): ?>     
                <option name="<?php print $drink_id; ?>">
                   
                </option>

                
                <?php endforeach; ?>
            </select>
        </form>
    </body>
</html>
