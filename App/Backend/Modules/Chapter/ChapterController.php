<?php
namespace App\Backend\Modules\Chapter;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Chapter;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\ChapterFormBuilder;
use \OCFram\FormHandler;

class ChapterController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $chapterId = $request->getData('id');

    $this->managers->getManagerOf('Chapter')->delete($chapterId);
    $this->managers->getManagerOf('Comments')->deleteFromChapter($chapterId);

    $this->app->user()->setFlash('Le chapitre a bien été supprimé !');

    $this->app->httpResponse()->redirect('/admin/chapter-list');
  }

  public function executeDeleteComment(HTTPRequest $request)
  {
    $commentId = $request->getData('id');
    $commentChap = $request->getData('chap');
    $this->managers->getManagerOf('Comments')->delete($commentId);

    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');

    $this->app->httpResponse()->redirect('/admin/chapter-'.$commentChap);
  }

  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Liste des chapitres');
    $chapterCount = $this->managers->getManagerOf('Chapter')->count();
    $chapterList = $this->managers->getManagerOf('Chapter')->getList();

    $this->page->addVar('bannerClass', 'index-banner');
    $this->page->addVar('listeChapter', $chapterList);
    $this->page->addVar('chapterCount', $chapterCount);
  }

  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);
    $this->page->addVar('bannerClass', 'insert-banner');
    $this->page->addVar('title', 'Ajout d\'un chapitre');
  }

  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
    $this->page->addVar('bannerClass', 'insert-banner');
    $this->page->addVar('title', 'Modification d\'un chapitre');
  }

  public function executeShow(HTTPRequest $request)
  {
    $chapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('chapterNumber'));
    $followingChapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('chapterNumber') + 1);
    $precedingChapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('chapterNumber') - 1);

    if (empty($chapter))
    {
      $this->app->httpResponse()->redirect404();
    }
    $this->page->addVar('precedingChapter', $precedingChapter);
    $this->page->addVar('followingChapter', $followingChapter);
    $this->page->addVar('title', $chapter->titre());
    $this->page->addVar('chapter', $chapter);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($chapter->chapterNumber()));
    $this->page->addVar('bannerClass', 'show-banner');
    if ($request->method() == 'POST'){

      $comment = new Comment([
        'pseudo' => $request->postData('pseudo'),
        'commentaire' => $request->postData('commentaire'),
        'chapter' => $chapter->chapterNumber()
      ]);

    }else {
      $comment = new Comment;
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build($chapter->chapterNumber());
    $commentForm = $formBuilder->form();
    $formHandler = new FormHandler($commentForm, $this->managers->getManagerOf('Comments'), $request);

    if ($formHandler->process())
    {

      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
      $this->app->httpResponse()->redirect('/admin/chapter-'.$chapter->chapterNumber());
    }

    $this->page->addVar('comment', $comment);
    $this->page->addVar('commentForm', $commentForm->createView());
  }


  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $chapter = new Chapter([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu'),
        'synopsis' => $request->postData('synopsis'),
        'posted' => $request->postData('posted'),
        'chapterNumber' => $request->postData('chapterNumber')
      ]);

      if ($request->getExists('id'))
      {
        $chapter->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $chapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('chapterNumber'));
      }
      else
      {
        $chapter = new Chapter;
      }
    }

    $formBuilder = new ChapterFormBuilder($chapter);
    $formBuilder->build();

    $form = $formBuilder->form();

    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Chapter'), $request);

    if ($formHandler->process())
    {

      $this->app->user()->setFlash($chapter->isNew() ? 'Le chapitre a bien été ajouté !' : 'Le chapitre a bien été modifié !');

      $this->app->httpResponse()->redirect('/admin/chapter-'.$chapter->chapterNumber());
    }
    $this->page->addVar('form', $form->createView());
  }

  public function executeLast(HTTPRequest $request)
  {
    $chapter = $this->managers->getManagerOf('Chapter')->getLast();
    $followingChapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('chapterNumber') + 1);
    $precedingChapter = $this->managers->getManagerOf('Chapter')->getUnique($request->getData('chapterNumber') - 1);

    if (empty($chapter))
    {
      $this->app->httpResponse()->redirect404();
    }
    $this->page->addVar('precedingChapter', $precedingChapter);
    $this->page->addVar('followingChapter', $followingChapter);
    $this->page->addVar('bannerClass', 'last-banner');
    $this->page->addVar('title', $chapter->titre());
    $this->page->addVar('chapter', $chapter);
  }
}
