<?php
namespace Entity;

use \OCFram\Entity;

class Chapter extends Entity
{
  protected $auteur,
            $chapterNumber,
            $titre,
            $contenu,
            $synopsis,
            $postDate,
            $posted;

  const AUTEUR_INVALIDE = 1;
  const TITRE_INVALIDE = 2;
  const CONTENU_INVALIDE = 3;
  const SYNOPSIS_INVALIDE = 4;
  const POSTED_INVALIDE = 5;
  const NUMBER_INVALIDE = 6;

  public function isValid()
  {
    return !(empty($this->synopsis) || empty($this->auteur) || empty($this->titre) || empty($this->contenu));
  }

  public function setChapterNumber($chapterNumber)
  {
    if (!is_numeric($chapterNumber) || empty($chapterNumber))
    {
      $this->erreurs[] = self::NUMBER_INVALIDE;
    }

    $this->chapterNumber = (int) $chapterNumber;
  }

  public function setTitre($titre)
  {
    if (!is_string($titre) || empty($titre))
    {
      $this->erreurs[] = self::TITRE_INVALIDE;
    }

    $this->titre = $titre;
  }

  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }

    $this->auteur = $auteur;
  }

  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->contenu = $contenu;
  }

  public function setSynopsis($synopsis)
  {
    if (!is_string($synopsis) || empty($synopsis))
    {
      $this->erreurs[] = self::SYNOPSIS_INVALIDE;
    }

    $this->synopsis = $synopsis;
  }

  public function setPostDate(\DateTime $postDate)
  {
    $this->postDate = $postDate;
  }

  public function setPosted($posted)
  {
    if (!is_string($posted) || empty($posted))
    {
      $this->erreurs[] = self::POSTED_INVALIDE;
    }

    $this->posted = $posted;
  }

  public function auteur()
  {
    return $this->auteur;
  }

  public function chapterNumber()
  {
    return $this->chapterNumber;
  }

  public function titre()
  {
    return $this->titre;
  }

  public function contenu()
  {
    return $this->contenu;
  }

  public function synopsis()
  {
    return $this->synopsis;
  }

  public function postDate()
  {
    return $this->postDate;
  }

  public function posted()
  {
    return $this->posted;
  }

}
