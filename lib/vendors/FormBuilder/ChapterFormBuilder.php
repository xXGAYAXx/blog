<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\SelectField;
use \OCFram\NumberField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\NumberValidator;

class ChapterFormBuilder extends FormBuilder
{
  public function build()
  {
    $this->form->add(new StringField([
        'label' => 'Auteur (10 caractères maximum):<br>',
        'name' => 'auteur',
        'classField' => 'chapter-autor',
        'maxLength' => 10,
        'validators' => [
          new MaxLengthValidator('L\'auteur spécifié est trop long (10 caractères maximum)', 10),
          new NotNullValidator('Merci de spécifier l\'auteur du chapitre'),
        ],
       ]))
       ->add(new NumberField([
        'label' => 'Chapitre N°: ',
        'name' => 'chapterNumber',
        'classField' => 'chapter-number',
        'validators' => [
          new NumberValidator('Merci de spécifier le numéro du chapitre'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Titre : ',
        'name' => 'titre',
        'classField' => 'chapter-title',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le titre spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le titre du chapitre'),
        ],
       ]))
       ->add(new SelectField([
        'label' => 'Poster ce chapitre : ',
        'name' => 'posted',
        'classField' => 'chapter-post',
        'validators' => [
          new NotNullValidator('Merci de spécifier si vous voulez poster ce chapitre ou pas'),
        ],
       ]))
       ->add(new TextField([
        'label' => 'Synopsis :<br>',
        'name' => 'synopsis',
        'classField' => 'chapter-synopsis',
        'rows' => 4,
        'cols' => 30,
        'validators' => [
          new NotNullValidator('Merci de spécifier le synopsis du chapitre'),
        ],
      ]))
       ->add(new TextField([
        'label' => 'Contenu :<br>',
        'name' => 'contenu',
        'classField' => 'chapter-content',
        'rows' => 8,
        'cols' => 60,
        'validators' => [
          new NotNullValidator('Merci de spécifier le contenu du chapitre'),
        ],
      ]));
  }
}
