<?
class Calculadora
{
  function inputsNumeriques($input1, $input2)
  {
    return is_numeric($input1) && is_numeric($input2);
  }
  function inputsString($input1, $input2)
  {
    return is_string($input1) && is_string($input2);
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
  function factorial($input1)
  {
    if (empty($input2))
    return ($input1 == 0) ? 1 : $input1 * self::factorial($input1 - 1);
    else
    return 'Operació no vàlida';
  }
  function concatenar($input1, $input2)
  {
    if (!$this->inputsString($input1, $input2))
      return 'Operació no vàlida';
    else
      return $input1 . $input2;
  }
  function eliminar($input1, $input2)
  {
    if (!$this->inputsString($input1, $input2))
      return 'Operació no vàlida';
    else
      return str_replace($input2, "", $input1);
  }
}
