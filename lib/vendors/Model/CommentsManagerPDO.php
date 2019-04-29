<?php
namespace Model;

use \Entity\Comment;

class CommentsManagerPDO extends CommentsManager
{

  public function add(Comment $comment)
  {
    $req = $this->dao->prepare('INSERT INTO comments SET pseudo = :pseudo, commentaire = :commentaire, chapter = :chapter, commentDate = NOW()');
    $req->bindValue(':pseudo', $comment->pseudo());
    $req->bindValue(':commentaire', $comment->commentaire());
    $req->bindValue(':chapter', (int) $comment->chapter());
    $req->execute();
  }
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM comments WHERE id = '.(int) $id);
  }

  public function deleteFromChapter($chapterId)
  {
    $this->dao->exec('DELETE FROM comments WHERE chapter = '.(int) $chapterId);
  }

  public function getListOf($chapterId)
  {
    if (!ctype_digit($chapterId))
    {
      throw new \InvalidArgumentException('L\'identifiant de la news passé doit être un nombre entier valide');
    }

    $q = $this->dao->prepare('SELECT * FROM comments WHERE chapter = :chapter ORDER BY commentDate DESC');
    $q->bindValue(':chapter', $chapterId, \PDO::PARAM_INT);
    $q->execute();

    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    $comments = $q->fetchAll();

    foreach ($comments as $comment)
    {
      $comment->setCommentDate(new \DateTime($comment->commentDate()));
    }

    return $comments;
  }

  public function getUnique($id)
  {
    $req = $this->dao->prepare('SELECT * FROM comments WHERE id = :id');
    $req->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $req->execute();

    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');

    if ($comment = $req->fetch())
    {
      $comment->setCommentDate(new \DateTime($comment->commentDate()));

      return $comment;
    }

    return null;
  }
}
