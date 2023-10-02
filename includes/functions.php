<?

function inicialitzarHistorial()
{
  // Inicialitza l'array de l'historial si encara no existeix
  if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = array();
  }
}

function mostrarHistorial()
{
  // Obtenim el total d'operacions realitzades
  $total_operacions = count($_SESSION['history']);
  // Itera a través del historial en ordre invers
  for ($i = $total_operacions - 1; $i >= 0; $i--) {
    $operacio = $_SESSION['history'][$i];
    echo "$operacio<br><hr>";
  }
}

function mostrarResultat($result)
{
  echo "<div class=\"caixaResultat\"><h2>🥁Resultat🥁</h2>";
  echo "<h1>$result</h1></div>";
}

function mostrarAlerta($message)
{
  echo "<div class=\"caixaAlerta\">$message</div><br>";
}

function llimpiarHistorial()
{
  $_SESSION['history'] = array();
}
