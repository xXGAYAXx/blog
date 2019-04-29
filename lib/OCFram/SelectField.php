<?php
namespace OCFram;

class SelectField extends Field
{

  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="form-errors">'.$this->errorMessage.'</div><br />';
    }

    $widget .= '<label>'.$this->label.'</label><SELECT class="'.$this->classfield.'" name="'.$this->name.'"';
    $widget .= '>';

    $widget .= '<OPTION>NON';
    $widget .= '<OPTION>OUI';

    return $widget .= '</SELECT>';
  }
}
