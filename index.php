<?php
session_start();

// Inicialitza l'array de l'historial si encara no existeix
if (!isset($_SESSION['history'])) {
  $_SESSION['history'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obté les dades del formulari
  $input1 = $_POST['input1'];
  $input2 = $_POST['input2'];
  $operation = $_POST['operacio'];

  // Inicialitza el resultat
  $result = '';

  // Realitza l'operació seleccionada
  switch ($operation) {
    case '+':
      $result = $input1 + $input2;
      break;
    case '-':
      $result = $input1 - $input2;
      break;
    case '*':
      $result = $input1 * $input2;
      break;
    case '/':
      if ($input2 != 0) {
        $result = $input1 / $input2;
      } else {
        $result = 'Divisió per zero';
      }
      break;
    case 'factorial':
      // Implementa el càlcul del factorial
      function factorial($n) {
        return ($n == 0) ? 1 : $n * factorial($n - 1);
      }
      $result = factorial($input1);
      break;
    case 'concatenate':
      $result = $input1 . $input2;
      break;
    case 'eliminar':
      $result = str_replace($input2, "", $input1);
      break;
    default:
      $result = 'Operació no vàlida';
  }



  // Afegir l'operació a l'històric
  $operationString = "$input1 $operation $input2 = $result";
  array_push($_SESSION['history'], $operationString);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Calculadora</title>
</head>
<body>
  <h1>Calculadora</h1>

  <form action="" method="post">
    <label for="input1">Primer valor:</label>
    <input type="text" id="input1" name="input1"><br><br>

    <label for="operacio">Operació:</label>
    <select id="operacio" name="operacio">
      <option value="+">Suma (+)</option>
      <option value="-">Resta (-)</option>
      <option value="*">Multiplicació (*)</option>
      <option value="/">Divisió (/)</option>
      <option value="factorial">Factorial</option>
      <option value="concatenate">Concatenar strings</option>
      <option value="eliminar">Eliminar part string</option>
    </select><br><br>

    <label for="input2">Segon valor:</label>
    <input type="text" id="input2" name="input2"><br><br>

    <button type="submit" name="calcular">Calcular</button>
  </form>
  <?php
    // Mostra el resultat
    echo "<h2>Resultat:</h2>";
    echo "<p>$result</p>";
  ?>
  <h2>Historial d'operacions:</h2>
  <ul id="history">
    <?php
    
    foreach ($_SESSION['history'] as $operation) {
      echo "<li>$operation</li>";
    }
    ?>
  </ul>
</body>
</html>
