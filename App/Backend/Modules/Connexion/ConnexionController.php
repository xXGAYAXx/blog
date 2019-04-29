<?php
namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;

class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
    $this->page->addVar('bannerClass', 'login-banner');

    if ($this->app->user()->isAuthenticated()) {
      $this->app->httpResponse()->redirect('/admin/chapter-list');
    }else {
      if ($request->postExists('login'))
      {
        $login = $request->postData('login');
        $password = $request->postData('password');
        $key = strlen($password);
        $passCrypt = sha1($password.$key);

        if ($login == $this->app->config()->get('login') && $passCrypt == $this->app->config()->get('pass'))
        {
          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('/admin/chapter-list');
        }
        else
        {
          $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
        }
      }
    }

  }

  public function executeLogout(HTTPRequest $request)
  {
    session_destroy();
    $this->app->httpResponse()->redirect('/');
  }
}
