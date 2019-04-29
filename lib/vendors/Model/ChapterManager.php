<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Chapter;

abstract class ChapterManager extends Manager
{
  public function save(Chapter $chapter)
  {
    if ($chapter->isValid())
    {
      $chapter->isNew() ? $this->add($chapter) : $this->modify($chapter);
    }
    else
    {
      throw new \RuntimeException('La news doit être validée pour être enregistrée');
    }
  }
  abstract protected function add(Chapter $chapter);
  abstract public function getLast();
  abstract public function getLastPosted();
  abstract public function count();
  abstract public function delete($chapterNumber);
  abstract public function getList();
  abstract public function getUnique($chapterNumber);
  abstract protected function modify(Chapter $chapter);
}
