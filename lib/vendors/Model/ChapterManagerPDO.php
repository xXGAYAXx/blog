<?php
namespace Model;

use \Entity\Chapter;

class ChapterManagerPDO extends ChapterManager
{
  protected function add(Chapter $chapter)
  {
    $req = $this->dao->prepare('INSERT INTO chapters SET auteur = :auteur, chapterNumber = :chapterNumber, synopsis = :synopsis, titre = :titre, contenu = :contenu, postDate = NOW(), posted = :posted');

    $req->bindValue(':titre', $chapter->titre());
    $req->bindValue(':auteur', $chapter->auteur());
    $req->bindValue(':contenu', $chapter->contenu());
    $req->bindValue(':synopsis', $chapter->synopsis());
    $req->bindValue(':posted', $chapter->posted());
    $req->bindValue(':chapterNumber', $chapter->chapterNumber());
    $req->execute();
  }

  public function count()
  {
    return $this->dao->query('SELECT COUNT(id) FROM chapters WHERE posted = "OUI"')->fetchColumn();
  }

  public function delete($chapterNumber)
  {
    $this->dao->exec('DELETE FROM chapters WHERE chapterNumber = '.(int) $chapterNumber);
  }

  public function getList()
  {
    $req = $this->dao->query('SELECT * FROM chapters ORDER BY chapterNumber DESC');
    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

    $listeChapter = $req->fetchAll();

    foreach ($listeChapter as $chapter)
    {
      $chapter->setPostDate(new \DateTime($chapter->postDate()));
    }

    $req->closeCursor();

    return $listeChapter;
  }

  public function getUnique($chapterNumber)
  {
    $req = $this->dao->prepare('SELECT * FROM chapters WHERE chapterNumber = :chapterNumber');
    $req->bindValue(':chapterNumber', (int) $chapterNumber, \PDO::PARAM_INT);
    $req->execute();

    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

    if ($chapter = $req->fetch())
    {
      $chapter->setPostDate(new \DateTime($chapter->postDate()));

      return $chapter;
    }

    return null;
  }

  public function getLast()
  {
    $req = $this->dao->prepare('SELECT * FROM chapters ORDER BY chapterNumber DESC LIMIT 1');
    $req->execute();
    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

    if ($chapter = $req->fetch())
    {
      $chapter->setPostDate(new \DateTime($chapter->postDate()));

      return $chapter;
    }

    return null;
  }

  public function getLastPosted()
  {
    $req = $this->dao->prepare('SELECT * FROM chapters WHERE posted = :posted ORDER BY chapterNumber DESC LIMIT 1');
    $req->bindValue(':posted', 'OUI');
    $req->execute();
    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Chapter');

    if ($chapter = $req->fetch())
    {
      $chapter->setPostDate(new \DateTime($chapter->postDate()));

      return $chapter;
    }

    return null;
  }

  protected function modify(Chapter $chapter)
  {
    $req = $this->dao->prepare('UPDATE chapters SET auteur = :auteur, titre = :titre, chapterNumber = :chapterNumber, contenu = :contenu, synopsis = :synopsis, posted = :posted WHERE id = :id');

    $req->bindValue(':titre', $chapter->titre());
    $req->bindValue(':auteur', $chapter->auteur());
    $req->bindValue(':contenu', $chapter->contenu());
    $req->bindValue(':synopsis', $chapter->synopsis());
    $req->bindValue(':posted', $chapter->posted());
    $req->bindValue(':chapterNumber', $chapter->chapterNumber());
    $req->bindValue(':id', $chapter->id(), \PDO::PARAM_INT);

    $req->execute();
  }
}
