<?php
namespace OCFram;

class StringField extends Field
{
  protected $maxLength;

  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="form-errors">'.$this->errorMessage.'</div><br />';
    }

    $widget .= '<label>'.$this->label.'</label><input type="text" name="'.$this->name.'" class="'.$this->classfield.'" placeholder="'.$this->placeholder.'"';

    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }

    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }

    return $widget .= ' />';
  }

  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;

    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}
