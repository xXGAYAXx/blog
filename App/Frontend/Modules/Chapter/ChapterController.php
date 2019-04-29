<?php
namespace App\Frontend\Modules\Chapter;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;

class ChapterController extends BackController
{
  public function executeHome(HTTPRequest $request)
  {
    $this->page->addVar('bannerClass', 'home-banner');
  }
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Liste des chapitres');

    $chapterCount = $this->managers->getManagerOf('Chapter')->count();
    $chapterList = $this->managers->getManagerOf('Chapter')->getList();

    $this->page->addVar('bannerClass', 'index-banner');
    $this->page->addVar('chapterList', $chapterList);
    $this->page->addVar('chapterCount', $chapterCount);
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
    $this->page->addVar('bannerClass', 'show-banner');
    $this->page->addVar('title', $chapter->titre());
    $this->page->addVar('chapter', $chapter);
    $this->page->addVar('precedingChapter', $precedingChapter);
    $this->page->addVar('followingChapter', $followingChapter);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($chapter->chapterNumber()));

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
      $this->app->httpResponse()->redirect('/chapter-'.$chapter->chapterNumber());
    }

    $this->page->addVar('comment', $comment);
    $this->page->addVar('commentForm', $commentForm->createView());

  }

  public function executeLastPosted(HTTPRequest $request)
  {
    $chapter = $this->managers->getManagerOf('Chapter')->getLastPosted();
    $followingChapter = $this->managers->getManagerOf('Chapter')->getUnique($chapter->chapterNumber() + 1);
    $precedingChapter = $this->managers->getManagerOf('Chapter')->getUnique($chapter->chapterNumber() - 1);

    if (empty($chapter))
    {
      $this->app->httpResponse()->redirect404();
    }

    $this->page->addVar('bannerClass', 'last-banner');
    $this->page->addVar('title', 'Dernier chapitre');
    $this->page->addVar('titleChapter', $chapter->titre());
    $this->page->addVar('chapter', $chapter);
    $this->page->addVar('precedingChapter', $precedingChapter);
    $this->page->addVar('followingChapter', $followingChapter);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($chapter->chapterNumber()));

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
      $this->app->httpResponse()->redirect('/chapter-'.$chapter->chapterNumber());
    }

    $this->page->addVar('comment', $comment);
    $this->page->addVar('commentForm', $commentForm->createView());
  }

  public function executePreceding(HTTPRequest $request)
  {
    $this->executeShow($request);
  }

}
