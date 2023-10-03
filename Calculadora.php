<?
include 'config.php';
class Calculadora
{
  function inputsNumeriques($input1, $input2)
  {
    return is_numeric($input1) && is_numeric($input2);
  }
  function sumar($input1, $input2)
  {
    if (!$this->inputsNumeriques($input1, $input2))
      return 'Operació no vàlida';
    else
      return $input1 + $input2;
  }
  function restar($input1, $input2)
  {
    if (!$this->inputsNumeriques($input1, $input2)) {
      return 'Operació no vàlida';
    } else {
      return $input1 - $input2;
    }
  }
  function multiplicar($input1, $input2)
  {
    if (!$this->inputsNumeriques($input1, $input2))
      return 'Operació no vàlida';
    else
      return $input1 * $input2;
  }
  function dividir($input1, $input2)
  {
    if ((!$this->inputsNumeriques($input1, $input2)) || ($input2 == 0)) {
      return 'Operació no vàlida';
    } else {
      return $input1 / $input2;
    }
  }
  function factorialRecursiu($input1)
  {
    if (($input1 < 0) || (!is_numeric($input1))) {
      return 'Operació no vàlida';
    }

    if ($input1 == 0 || $input1 == 1) {
      return 1;
    } else {
      return $input1 * $this->factorialRecursiu($input1 - 1);
    }
  }
  function factorialIteratiu($input1)
  {
    if (($input1 < 0) || (!is_numeric($input1))) {
      return 'Operació no vàlida';
    }

    $factorial = 1;
    for ($i = 1; $i <= $input1; $i++) {
      $factorial *= $i;
    }

    return $factorial;
  }
  function calcularFactorial($input1)
  {
    if (METODE_FACTORIAL === 'ITERATIU') {
      return $this->factorialIteratiu($input1);
    } elseif (METODE_FACTORIAL === 'RECURSIU') {
      return $this->factorialRecursiu($input1);
    } else {
      return 'Métode no vàlid';
    }
  }
  function concatenar($input1, $input2)
  {
    return $input1 . $input2;
  }
  function eliminar($input1, $input2)
  {
    return str_replace($input2, "", $input1);
  }
}
