<?php
session_start();
include 'includes/functions.php';
inicialitzarHistorial();
#xdebug_info();

$operation = '';
if (isset($_POST['calcular'])) {
  $input1 = $_POST['input1'];
  $input2 = $_POST['input2'];
  $operation = $_POST['operacio'];
  $result = '';
}

include 'Calculadora.php';
$calculator = new Calculadora();
switch ($operation) {
  case '+':
    $result = $calculator->sumar($input1, $input2);
    break;
  case '-':
    $result = $calculator->restar($input1, $input2);
    break;
  case '*':
    $result = $calculator->multiplicar($input1, $input2);
    break;
  case '/':
    $result = $calculator->dividir($input1, $input2);
    break;
  case 'concatenate':
    $result = $calculator->concatenar($input1, $input2);
    break;
  case 'eliminar':
    $result = $calculator->eliminar($input1, $input2);
    break;
  case 'factorial':
    $result = $calculator->calcularFactorial($input1);
    break;
  default:
    $result = 'Operació no vàlida';
}

//Llimpia l'historial fent clic al botó
if (isset($_POST['llimpiar_historial'])) {
  llimpiarHistorial();
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calculadora🧙‍♂️</title>
  <link rel="stylesheet" href="styles.css">

</head>
<header>
  <h1>Calculadora🧙‍♂️</h1>
</header>

<body>
  <form class="formulariInputs" method="POST">
    <input type="text" id="input1" name="input1" placeholder="Primer valor"><br>
    <label for="operacio">Operació a realitzar:</label><br>
    <div class="radio-option">
    <input type="radio" id="suma" name="operacio" value="+" checked="checked">
    <label for="operacio">➕</label><br>
    </div>
    <div class="radio-option">
    <input type="radio" id="resta" name="operacio" value="-">
    <label for="operacio">➖</label><br>
    </div>
    <div class="radio-option">
    <input type="radio" id="multiplicacio" name="operacio" value="*">
    <label for="operacio">✖️</label><br>
    </div>
    <div class="radio-option">
    <input type="radio" id="divisio" name="operacio" value="/">
    <label for="operacio">➗</label><br>
    </div>
    <div class="radio-option">
    <input type="radio" id="factorial" name="operacio" value="factorial">
    <label for="operacio">❗</label><br>
    </div>
    <div class="radio-option">
    <input type="radio" id="concatena" name="operacio" value="concatenate">
    <label for="operacio">Concatenar strings</label><br>
    </div>
    <div class="radio-option">
    <input type="radio" id="elimina" name="operacio" value="eliminar">
    <label for="operacio">Eliminar part string</label><br><br>
    </div>
    <input type="text" id="input2" name="input2" placeholder="Segon valor"><br>

    <button class="botoCalcular" type="submit" name="calcular">Calcular🪄</button>
  </form>

  <?php
  if (isset($_POST['calcular']) && ($result != 'Operació no vàlida')) {
    mostrarResultat($result);
    $operacioRealitzada = "$input1 $operation $input2 = $result";
    array_push($_SESSION['history'], $operacioRealitzada);
  } else {
    include 'includes/errorHandling.php';
  }
  ?>

  <div class="historial">
    <h1>📜</h1>
    <h2>Historial d'operacions</h2>
    <h1>📜</h1>
    <form class="formBoto" method="POST">
      <button class="botoEliminar" type="submit" name="llimpiar_historial" title="Eliminar historial">
        <h1>🗑️</h1>
      </button>
    </form>
  </div>

  <div id="history">
    <?php
    mostrarHistorial();
    ?>
  </div>

</body>

</html>