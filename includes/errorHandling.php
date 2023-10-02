<?
if (isset($_POST['calcular'])) {

  if ((is_numeric($input2)) && ($operation === 'factorial')) {
    mostrarAlerta("⚠️Per al calcul factorial sols introduir el primer valor.⚠️");
    $result = 'Operació no vàlida';
  }
  if (empty($input1) && empty($input2)) {
    mostrarAlerta("⚠️Si us plau, afegeix dos nombres.⚠️");
  }
  if ($operation == '/' && $input2 == 0) {
    mostrarAlerta("⚠️No pots dividir per zero.⚠️");
  }
  elseif (!empty($input1) && empty($input2) && $operation !== 'factorial') {
    mostrarAlerta("⚠️Si us plau, afegeix el nombre del segon terme.⚠️");
    $result = 'Operació no vàlida';
  } 
  if (empty($input1) && !empty($input2)) {
    mostrarAlerta("⚠️Si us plau, afegeix el nombre del primer terme.⚠️");
  }
  if ($operation === 'factorial' && empty($input1) && empty($input2)) {
    mostrarAlerta("⚠️Si us plau, introdueix un valor.⚠️");
    if (!empty($input1) && empty($input2)) {
      $result = $calculator->factorial($input1);
    }
  }
}
