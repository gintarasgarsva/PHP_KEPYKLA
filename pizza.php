<?php

function parseSelection($selection)
{
    $ingridientai = [
        'druska' => [
            'name' => 'druska',
            'kaina' => '1',
            'img' => 'http://zaliapieva.lt/330-thickbox/epsom-druska.jpg'
        ],
        'baklazanas' => [
            'name' => 'baklazanas',
            'kaina' => '2',
            'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fb/Aubergine.jpg/220px-Aubergine.jpg'
        ],
        'miltai' => [
            'name' => 'miltai',
            'kaina' => '0.5',
            'img' => 'https://www.barbora.lt/api/Images/GetInventoryImage?id=78365e71-b131-4ded-92b9-aabce9385a78'
        ],
        'vanduo' => [
            'name' => 'vanduo',
            'kaina' => '0.2',
            'img' => 'https://cms.qz.com/wp-content/uploads/2018/12/water-filter-buying-guide-e1544721509833.jpg?quality=75&strip=all&w=410&h=231'
        ],
        'kiausiniai' => [
            'name' => 'kiausiniai',
            'kaina' => '1',
            'img' => 'https://i.kinja-img.com/gawker-media/image/upload/s--m6hjGHRf--/c_scale,f_auto,fl_progressive,q_80,w_800/aapfqrjiromx7x1m6rgy.jpg'
        ],
        'grybai' => [
            'name' => 'grybai',
            'kaina' => '3',
            'img' => 'https://image.shutterstock.com/image-photo/mashrooms-isolated-on-white-background-260nw-1197155047.jpg'
        ],
        'desra' => [
            'name' => 'desra',
            'kaina' => '5',
            'img' => 'https://www.gastroiberico.com/45-large_default/cured-iberian-acorn-bellota-sausage.jpg'
        ],
        'padazas' => [
            'name' => 'padazas',
            'kaina' => '0.5',
            'img' => 'data:image/jpeg;base64,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'
        ],
        'suris' => [
            'name' => 'suris',
            'kaina' => '0.5',
            'img' => 'https://static.pricer.lt/dynamic/foreign.png?image=https%3A%2F%2Fstatic.pricer.lt%2Forigin%2Fproducts%2F2863123%2F30147.jpeg'
        ],

    ];

    $list = [];
    $price = 0;

    foreach ($selection as $ingridient_id) {
        $list[] = $ingridientai[$ingridient_id];
        $price += $ingridientai[$ingridient_id]['kaina'];
    }

    return [
        'ingridientai' => $list,
        'kaina' => $price,
    ];
}

$klausimai = [
    'klausimas1' => [
        'text' => 'Ar traukia prie gamtos',
        'variantai' => [
            [
                'label' => 'ne',
                'value' => 'desra'
            ],
            [
                'label' => 'labai',
                'value' => 'druska'
            ],
            [
                'label' => 'neprisimenu',
                'value' => 'miltai'
            ],
        ],
    ],
    'klausimas2' => [
        'text' => 'Kiek kainuoja jusu...',
        'variantai' => [
            [
                'label' => 'daug',
                'value' => 'padazas'
            ],
            [
                'label' => 'ne tavo reikalas',
                'value' => 'baklazanas'
            ],
            [
                'label' => 'gavau for free',
                'value' => 'vanduo'
            ],
        ],
    ],
    'klausimas3' => [
        'text' => 'Uz ka balsavote',
        'variantai' => [
            [
                'label' => 'uz Manta',
                'value' => 'kiausiniai'
            ],
            [
                'label' => 'uz PHP',
                'value' => 'grybai'
            ],
            [
                'label' => 'as noriu picos!',
                'value' => 'suris'
            ],
        ],
    ]
];

$showResult = !empty($_POST);
$result = [];

if ($showResult) {
    $result = parseSelection($_POST);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background-image: url("http://all4desktop.com/data_images/original/4236532-background-images.jpg");
        }

        nav ul {
            list-style: none;
        }

        nav li {
            display: inline-block;
        }

        .img-container {
            position: relative;
            min-height: 50px;
        }

        .img-container img {
            height: 50px;
            position: absolute;
        }

        .btn-link {
            background: gray;
            border: 1px solid darkgray;
            text-decoration: none;
            color: #fff;
            padding: 1em;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Index</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="pizza.php">Pizza</a></li>
        </ul>
    </nav>
    <div class="container">
        <?php if ($showResult) : ?>
            <div class="img-container">
                <?php foreach ($result['ingridientai'] as $key => $ingridientas) : ?>
                    <img src="<?php print $ingridientas['img']; ?>" alt="<?php print $ingridientas['name']; ?>" style="z-index: <?php print $key ?>; left: <?php print $key ?>0px">
                <?php endforeach; ?>
            </div>
            <p>Jums rekomenduojami ingridientai:</p>
            <ul>
                <?php foreach ($result['ingridientai'] as $ingridientas) : ?>
                    <li>
                        <?php print $ingridientas['name']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p>Kaina: <?php print $result['kaina']; ?></p>
            <a href="pizza.php" class="btn-link">Noriu kitos picos</a>
        <?php else : ?>
            <form method="POST">
                <?php foreach ($klausimai as $kl_id => $klausimas) : ?>
                    <div>
                        <span><?php print $klausimas['text'] ?></span>
                        <select name="<?php print $kl_id; ?>">
                            <?php foreach ($klausimas['variantai'] as $variantas) : ?>
                                <option value="<?php print $variantas['value']; ?>"><?php print $variantas['label']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Uzsakyti</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>