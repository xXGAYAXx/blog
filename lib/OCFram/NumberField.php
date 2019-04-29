<?php
namespace OCFram;

class NumberField extends Field
{

  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="form-errors">'.$this->errorMessage.'</div><br />';
    }

    $widget .= '<label>'.$this->label.'</label><input min="1"  class="'.$this->classfield.'" type="number" name="'.$this->name.'"';

    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }else {
      $widget .= ' value="1"';
    }

    return $widget .= ' />';
  }
}
