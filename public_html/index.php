<?php

require '../bootloader.php';

$whiskey = new \App\Drinks\StrongDrink();
$whiskey->setAmount(700);
$whiskey->drink();

var_dump($whiskey->getAmount());

$LabasVakaras = new \App\Drinks\LightDrink();
$LabasVakaras->setAmount(1000);
$LabasVakaras->drink();

var_dump($LabasVakaras->getAmount());

die();
///////////////////////////////////////////////////////
abstract class Car {
    
    
    protected $manufacturer;
    protected $model;
    protected $year;
    
    abstract protected function drive();
    
    public function __construct($manufacturer, $model, $year) {
        $this->manufacturer = $manufacturer;
        $this->model = $model;
        $this->year = $year;
    }
    
   
}

abstract class Honda extends Car {
    
    public function __construct($model, $year) {
        parent::__construct('Honda', $model, $year);
    }
    

}

class HondaCivic extends Honda{
    
    public function __construct($year) {
        parent::__construct('Civic', $year);
    }
    
    public function drive() {
        print 'Civicas juda';
    }
}

$civic = new HondaCivic(2001);
$civic->drive();



die();


//////////////////////////////////////////////////////////


$nav = [
    'left' => [
        ['url' => '/index.php', 'title' => 'Home'],
        ['url' => '/register.php', 'title' => 'Register'],
        ['url' => '/login.php', 'title' => 'Login'],
        ['url' => '/logout.php', 'title' => 'Logout'],
    ]
];



//$db = new Core\FileDB(DB_FILE);
//$modelDrinks = new App\Drinks\Model($db);
//$testasApp = \App\App::$db->getData();
//
//$form = [
//    'attr' => [
//        //'action' => '', Nebūtina, jeigu action yra ''
//        'method' => 'POST',
//    ],
//    'fields' => [
//        'name' => [
//            'label' => 'Gerimo pavadinimas',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty',
//                ]
//            ],
//        ],
//        'amount_ml' => [
//            'label' => 'Amount(ml)',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty',
//                //validate float
//                ]
//            ],
//        ],
//        'abarot' => [
//            'label' => 'Abarotai(%)',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty'
//                ]
//            ],
//        ],
//        'image' => [
//            'label' => 'Image link',
//            'type' => 'text',
//            'extra' => [
//                'validators' => [
//                    'validate_not_empty',
//                ]
//            ],
//        ],
//    ],
//    'buttons' => [
//        'submit' => [
//            'title' => 'Prideti gerima',
//            'extra' => [
//                'attr' => [
//                    'class' => 'red-btn'
//                ]
//            ]
//        ],
//        'delete' => [
//            'title' => 'Isgerti viska',
//            'extra' => [
//                'attr' => [
//                    'class' => 'blue-btn'
//                ]
//            ]
//        ],
//    ],
//    'callbacks' => [
//        'success' => 'form_success',
//        'fail' => 'form_fail'
//    ],
//    'validators' => [
//        'validate_login'
//    ]
//];
//$filtered_input = get_form_input($form);
//function form_success($filtered_input, &$form) {
//    $newDrink = new App\Drinks\Drink($filtered_input);
//    $modelDrinks = new App\Drinks\Model();
//    $modelDrinks->insert($newDrink);
//}
//
//function form_fail() {
//    print 'fail';
//}
//
//switch (get_form_action()) {
//    case 'submit':
//        validate_form($filtered_input, $form);
//        break;
//    case 'delete':
//        foreach ($modelDrinks->get() as $drink) {
//            $modelDrinks->delete($drink);
//        }
//}
//
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

        <!--<div>-->
        <!--    --><?php //foreach ($drinks as $key => $drink):        ?>
        <!--        <h1>--><?php //print $drink->getName();        ?><!--</h1>-->
        <!--        <h2>--><?php //print $drink->getAmount();        ?><!--</h2>-->
        <!--        <h3>--><?php //print $drink->getAbarot();        ?><!--</h3>-->
        <!--        <img src="--><?php //print $drink->getImage();        ?><!--" alt="foto">-->
        <!--    --><?php //endforeach;        ?>
        <!--</div>-->
    </body>
</html>