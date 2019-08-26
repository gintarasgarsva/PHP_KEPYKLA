<?php
require '../bootloader.php';

function get_form() {
    return [
        'attr' => [
            //'action' => '', Neb?tina, jeigu action yra ''
            'method' => 'POST',
        ],
        'fields' => [
            'gerimas' => [
                'label' => 'Gerimas',
                'type' => 'select',
                'options' => get_options(),
            ],
        ],
        'buttons' => [
            'submit' => [
                'title' => 'Drink!',
                'extra' => [
                    'attr' => [
                        'class' => 'red-btn'
                    ]
                ]
            ],
        ],
        'callbacks' => [
            'success' => 'form_success',
            'fail' => 'form_fail'
        ],
        'validators' => [
        ]
    ];
}

function get_options() {
    $drinksModel = new App\Drinks\Model();
    $drinks = $drinksModel->get();
    $options = [];

    foreach ($drinks as $drink_id => $drink) {

        $options[$drink->getId()] = $drink->getName();
    }
    return $options;
}

function form_success($filtered_input, &$form) {

    $drink_id = $filtered_input['gerimas'];

    $modelDrinks = new App\Drinks\Model();
    $drinks = $modelDrinks->get(['row_id' => $drink_id]);

    /** @var \App\Drinks\Drink Description * */
    $drink = $drinks[0];
    $drink->drink();

    if ($drink->getAmount() > 0) {
        $modelDrinks->update($drink);
    } else {
        $modelDrinks->delete($drink);
        $form['fields']['gerimas']['options'] = get_options();
    }
}

function form_fail() {
    print 'fail';
}

$form = get_form();
$filtered_input = get_form_input($form);

switch (get_form_action()) {
    case 'submit':
        validate_form($filtered_input, $form);
        break;
}

$modelDrinks = new App\Drinks\Model();
$drinks = $modelDrinks->get();

if (isset($_POST['logout'])) {

    $_SESSION = [];
    header("Location: index.php");
}


//insert_drinks();
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
            <h1 class="vakaro-meniu">Vakaro MENIU</h1>
            <div id="turinys">
                <?php require ROOT . '/core/templates/form/form.tpl.php'; ?>

                <!-- Trigger/Open The Modal -->
                <!--            <button id="myBtn">Open Modal</button>-->

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h1>Update Drink:</h1>
                        <form id="update-drink-form" method="post">
                            <input type="hidden" name="id">
                            <input type="text" name="name" placeholder="Name">
                            <input type="text" name="amount_ml" placeholder="Amount ml">
                            <input type="text" name="abarot" placeholder="Abarot %">
                            <input type="text" name="image" placeholder="Image url">
                            <button id="update-button" type="submit" name="update-button">Update</button>
                        </form>
                    </div>

                </div>
                <?php if (isset($_SESSION['email'])): ?>
                    <div id="drinkAddDiv">
                        <form id="addDrink">
                            <select name="drink">
                                <option value="0">Alus</option>
                                <option value="1">Balta</option>
                                <option value="2">Samagonas</option>
                            </select>
                            <button type="submit">Add drink</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

                <div class="gerimai">  
                    <?php foreach ($drinks as $drink): ?>
                        <div data-id="<?php print $drink->getId(); ?>" class="gerimas">
                            <?php if (isset($_SESSION['email'])): ?>
                                <span class="update-btn" data-id="<?php print $drink->getId(); ?>">Update</span>
                                <span class="delete-btn" data-id="<?php print $drink->getId(); ?>">X</span>
                            <?php endif; ?>
                            <h1><?php print $drink->getName(); ?></h1>
                            <h2><span><?php print $drink->getAmount(); ?></span>ml</h2>
                            <h3><span><?php print $drink->getAbarot(); ?></span>%</h3>
                            <img src="<?php print $drink->getImage(); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                
        </div>
        <script>


            function setListener() {
                let forma = document.querySelector("form");
                forma.addEventListener("submit", fn);
            }
            setListener();
            function fn(e) {

                e.preventDefault();

                let select = document.querySelector("select");

                let formData = new FormData(e.target);
                formData.append("action", "submit");

                fetch("./drinks.php", {
                    method: "POST",
                    body: formData
                })
                        .then(response => {
                            response.text().then(text => {
//                            console.log(text);
                                document.querySelector("html").innerHTML = text;
                                setListener();
                            });
                        });

            }

            const deleteButtons = document.querySelectorAll(".delete-btn");

            deleteButtons.forEach(button => {
                button.addEventListener("click", e => {
//                    console.log(e.target.id);

                    let buttonElement = e.target;

                    let formData = new FormData();
                    formData.append("drink_id", buttonElement.getAttribute('data-id'));

                    fetch("./api/drinks/delete.php", {
                        method: "POST",
                        body: formData
                    })
                            .then(response => {
                                response.json().then(json => {
//                            console.log(json);
                                    if (json.status === "success") {
                                        buttonElement.parentNode.remove();
                                    }
                                });
                            });
                });
            });

            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var modalCloseBtn = document.getElementsByClassName("close")[0];
            // When the user clicks on <span> (x), close the modal
            modalCloseBtn.onclick = function () {
                modal.style.display = "none";
            }

            let updateButtons = document.querySelectorAll('.update-btn');
            updateButtons.forEach(function (button) {
                // When the user clicks anywhere outside of the modal, close it
                button.onclick = function (event) {
                    modal.style.display = "block";
                    modal.querySelector('input[name="id"]').value = event.target.getAttribute('data-id');
                    modal.querySelector('input[name="name"]').value = event.target.parentNode.querySelector("h1").innerHTML;
                    modal.querySelector('input[name="amount_ml"]').value = event.target.parentNode.querySelector("h2 span").innerHTML;
                    modal.querySelector('input[name="abarot"]').value = event.target.parentNode.querySelector("h3 span").innerHTML;
                    modal.querySelector('input[name="image"]').value = event.target.parentNode.querySelector("img").getAttribute("src");
                };
            });

            let updateForm = document.getElementById("update-drink-form");
            updateForm.addEventListener("submit", updateFormFunction);

            function updateFormFunction(e) {

                e.preventDefault();

                let formData = new FormData(e.target);


                fetch("./api/drinks/update.php", {
                    method: "POST",
                    body: formData
                })
                        .then(response => {
                            response.json().then(json => {
                                console.log(json);
                                if (json.status === "success") {
                                    let divas = document.querySelector('*[data-id="' + e.target.id.value + '"]')
                                    divas.querySelector("h1").innerHTML = e.target.name.value;
                                    divas.querySelector("h2 span").innerHTML = e.target.amount_ml.value;
                                    divas.querySelector("h3 span").innerHTML = e.target.abarot.value;
                                    divas.querySelector("img").setAttribute("src", e.target.image.value);
                                    modal.style.display = "none";
                                }
                            });
                        });
            }

            let addForm = document.getElementById("addDrink");
            addForm.addEventListener("submit", e => {
                e.preventDefault();

                let formData = new FormData(e.target);


                fetch("./api/drinks/add.php", {
                    method: "POST",
                    body: formData
                })
                        .then(response => {
                            response.json().then(json => {
                                console.log(json);

//                                    let divas = document.querySelector('*[data-id="' + e.target.id.value + '"]')
//                                    divas.querySelector("h1").innerHTML = e.target.name.value;
//                                    divas.querySelector("h2 span").innerHTML = e.target.amount_ml.value;
//                                    divas.querySelector("h3 span").innerHTML = e.target.abarot.value;
//                                    divas.querySelector("img").setAttribute("src", e.target.image.value);
//                                    modal.style.display = "none";

                            });
                        });

            });

        </script>
    </body>
</html>