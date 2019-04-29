<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Comment;

abstract class CommentsManager extends Manager
{
  abstract public function add(Comment $comment);
  abstract public function delete($id);
  abstract public function deleteFromChapter($chapterId);
  abstract public function getUnique($id);
  abstract public function getListOf($chapterId);

  public function save(Comment $comment)
  {
    if ($comment->isValid())
    {
      $this->add($comment);
    }
    else
    {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }


}
