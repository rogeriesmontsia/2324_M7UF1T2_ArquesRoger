<?php
session_start();

class Calculadora
{
  public static function inputsPlenes($input1, $input2)
  {
    return !empty($input1) && !empty($input2);
  }
  public static function sumar($input1, $input2)
  {
    return $input1 + $input2;
  }
  public static function restar($input1, $input2)
  {
    return $input1 - $input2;
  }
  public static function multiplicar($input1, $input2)
  {
    return $input1 * $input2;
  }
  public static function dividir($input1, $input2)
  {
    if ($input2 != 0) {
      return $input1 / $input2;
    } else {
      return 'Divisió per zero';
    }
  }
  public static function factorial($n)
  {
    return ($n == 0) ? 1 : $n * self::factorial($n - 1);
  }
  public static function concatenar($input1, $input2)
  {
    return $input1 . $input2;
  }
  public static function eliminar($input1, $input2)
  {
    return str_replace($input2, "", $input1);
  }
}

function mostrarResultat($result)
{
  echo "<h2>🥁Resultat:</h2>";
  echo "<p>$result</p>";
}

function mostrarAlerta($message)
{
  echo "<div class=\"caixaResultat\">$message</div><br>";
}

function llimpiarHistorial()
{
  $_SESSION['history'] = array(); // Llimpiar el historial
  header("Location: " . $_SERVER['PHP_SELF']); // Redirigir a la mateixa página
  exit();
}

// Inicialitza l'array de l'historial si encara no existeix
if (!isset($_SESSION['history'])) {
  $_SESSION['history'] = array();
}

if (isset($_POST['llimpiar_historial'])) {
  llimpiarHistorial();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obté les dades del formulari
  $input1 = $_POST['input1'];
  $input2 = $_POST['input2'];
  $operation = $_POST['operacio'];

  // Inicialitza el resultat
  $result = '';

  // Realitza l'operació seleccionada

  if ($operation === 'factorial') {
    if (!empty($input1)) {
      $result = Calculadora::factorial($input1);
    } else {

      $result = 'Operació no vàlida';
    }
  } else {
    if (Calculadora::inputsPlenes($input1, $input2)) {
      switch ($operation) {
        case '+':
          $result = Calculadora::sumar($input1, $input2);
          break;
        case '-':
          $result = Calculadora::restar($input1, $input2);
          break;
        case '*':
          $result = Calculadora::multiplicar($input1, $input2);
          break;
        case '/':
          $result = Calculadora::dividir($input1, $input2);
          break;
        case 'concatenate':
          $result = Calculadora::concatenar($input1, $input2);
          break;
        case 'eliminar':
          $result = Calculadora::eliminar($input1, $input2);
          break;
        default:
          $result = 'Operació no vàlida';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Calculadora🧙‍♂️</title>
  <link rel="stylesheet" href="styles.css">
</head>
<header>
  <h1>Calculadora🧙‍♂️</h1>
</header>

<body>


  <form action="" method="post">
    <label for="input1">Primer valor:</label>
    <input type="text" id="input1" name="input1"><br><br>
    <label for="operacio">Operació a realitzar:</label><br>
    <input type="radio" id="suma" name="operacio" value="+">
    <label for="operacio">➕</label><br>
    <input type="radio" id="resta" name="operacio" value="-">
    <label for="operacio">➖</label><br>
    <input type="radio" id="multiplicacio" name="operacio" value="*">
    <label for="operacio">✖️</label><br>
    <input type="radio" id="divisio" name="operacio" value="/">
    <label for="operacio">➗</label><br>
    <input type="radio" id="factorial" name="operacio" value="factorial">
    <label for="operacio">Factorial</label><br>
    <input type="radio" id="concatena" name="operacio" value="concatenate">
    <label for="operacio">Concatenar strings</label><br>
    <input type="radio" id="elimina" name="operacio" value="eliminar">
    <label for="operacio">Eliminar part string</label><br><br>
    <label for="input2">Segon valor:</label>
    <input type="text" id="input2" name="input2"><br><br>

    <button class="boto" type="submit" name="calcular">Calcular🪄</button>
  </form>

  <?php
  // Mostra el resultat només si l'operació és vàlida
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($operation)) {
      mostrarAlerta("⚠️Si us plau, selecciona una operació.⚠️");
    }
    if (empty($input1) && empty($input2) && $operation !== 'factorial') {
      mostrarAlerta("⚠️Si us plau, afegeix dos nombres.⚠️");
      $result = 'Operació no vàlida';
    }
    if (!empty($input1) && empty($input2)) {
      mostrarAlerta("⚠️Si us plau, afegeix el nombre del segon terme.⚠️");
      $result = 'Operació no vàlida';
    }
    if (empty($input1) && !empty($input2)) {
      mostrarAlerta("⚠️Si us plau, afegeix el nombre del primer terme.⚠️");
      $result = 'Operació no vàlida';
    }
    
    if (!empty($operation) && empty($input1) && !empty($input2)) {
      mostrarAlerta("⚠️Si us plau, afegeix el nombre del primer terme.⚠️");
      $result = 'Operació no vàlida';
    }
    if ($result !== 'Operació no vàlida') {
      mostrarResultat($result);
    }
    if ($operation === 'factorial' && empty($input1) && empty($input2)) {
      mostrarAlerta("⚠️Si us plau, introdueix un valor.⚠️");
      if (!empty($input1) && empty($input2)) {
        $result = Calculadora::factorial($input1);
      }
      // Afegir l'operació a l'històric
    }
    if ($result !== 'Operació no vàlida') {
      $operacioRealitzada = "$input1 $operation $input2 = $result";
      array_push($_SESSION['history'], $operacioRealitzada);
    } else {
      //$result = 'Operació no vàlida';
      //mostrarAlerta("Si us plau, introdueix dos valors.");
      //$result = 'Operació no vàlida';
    }
  }
  ?>
  <div id="historial" style="display: -webkit-box">
    <h2>📜Historial d'operacions📜</h2>
    <form method="POST">
      <button class ="botoEliminar" type="submit" name="llimpiar_historial" title="Eliminar historial">🗑️</button>
    </form>
  </div>
  <div id="history">
    <?php
    // Obtenim el total d'operacions realitzades
    $total_operacions = count($_SESSION['history']);
    // Itera a través del historial en ordre invers
    for ($i = $total_operacions - 1; $i >= 0; $i--) {
      $operacio = $_SESSION['history'][$i];
      echo "$operacio<br>";
    }
    ?>

  </div>
</body>

</html>