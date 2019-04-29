<?php
namespace Entity;

use \OCFram\Entity;

class Comment extends Entity
{
  protected $chapter,
            $pseudo,
            $commentaire,
            $commentDate;

  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;

  public function isValid()
  {
    return !(empty($this->pseudo) || empty($this->commentaire));
  }

  public function setchapter($chapterId)
  {
    $this->chapter = (int) $chapterId;
  }

  public function setPseudo($pseudo)
  {
    if (!is_string($pseudo) || empty($pseudo))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }

    $this->pseudo = $pseudo;
  }

  public function setCommentaire($commentaire)
  {
    if (!is_string($commentaire) || empty($commentaire))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->commentaire = $commentaire;
  }

  public function setCommentDate(\DateTime $commentDate)
  {
    $this->commentDate = $commentDate;
  }

  public function chapter()
  {
    return $this->chapter;
  }

  public function pseudo()
  {
    return $this->pseudo;
  }

  public function commentaire()
  {
    return $this->commentaire;
  }

  public function commentDate()
  {
    return $this->commentDate;
  }
}
