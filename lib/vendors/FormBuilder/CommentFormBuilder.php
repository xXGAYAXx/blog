<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

class CommentFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Votre pseudo <br>(20 caractères max):<br>',
        'id' => 'pseudo',
        'name' => 'pseudo',
        'classField' => 'commentAutor',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le pseudo spécifié est trop long (50 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier votre pseudo'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Votre commentaire : ',
        'id' => 'contenu',
        'name' => 'commentaire',
        'classField' => 'commentContent',
        'validators' => [
          new NotNullValidator('Merci de spécifier votre commentaire'),
        ],
       ]));
  }
}
