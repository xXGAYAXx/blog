
    <div class="show-chapter-Box">
      <div class="pagination">
      <?php
        if ($followingChapter != null) {
          ?>
          <div class="next">
            <p><a href="/admin/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre<br>suivant</a></p>
          </div>
          <?php
        }
        if ($precedingChapter != null) {
          ?>
          <div class="last">
            <p><a href="/admin/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre<br>précédent</a></p>
          </div>
          <?php
        }
      ?>
      <p class="chap-number">Chapitre N°: <?= $chapter['chapterNumber']?></p>
      </div>
      <div class="btn-box">
        <button class="btn-primary full-screen">Plein écran</button>
        <button class="btn-primary scroll">Mode scroll</button>
      </div>
      <p class="chap-content"><?= nl2br($chapter['contenu']) ?></p>
      <p class="synop"><span class="synop-label">Synopsis: </span><?= $chapter['synopsis'] ?></p>
      <div class="pagination">
      <?php
        if ($followingChapter != null) {
          ?>
          <div class="next">
            <p> <a href="/admin/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre suivant</a> </p>
          </div>
          <?php
        }
        if ($precedingChapter != null) {
          ?>
          <div class="last">
            <p> <a href="/admin/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre précédent</a> </p>
          </div>
          <?php
        }
      ?>
      <p class="signature">Ecrit par: <span class="chap-auteur"><?= $chapter['auteur'] ?></span>, le <?= $chapter['postDate']->format('d/m/Y à H\hi') ?> Posté: <?= $chapter['posted'] ?></p>
      <p><a class="btn-success" href="/admin/chapter-update-<?= $chapter['id'] ?>-chap-<?= $chapter['chapterNumber'] ?>.html">Modifier</a> <a class="btn-danger" href="/admin/chapter-delete-<?= $chapter['chapterNumber'] ?>.html">Supprimer</a></p>

      </div>
      <div class="btn-box">
        <button class="btn-primary full-screen">Plein écran</button>
        <button class="btn-primary scroll">Mode scroll</button>
      </div>
    </div>

    <div class="commentFormBox">
      <form id="commentForm" class="js-simple-ajax-form" method="post" action="">
       <fieldset>
          <legend class="comment-text comment-legend"><h3>Ajouter un commentaire</h3></legend>
          <?= $commentForm ?>
          <div class="btn-box">
            <button type="submit"  class="btn btn-success"><strong>Poster un commentaire</strong></button>
          </div>
       </fieldset>
       <?php if (isset($_GET['result']) && isset($_GET['message'])): ?>
           <div class="status alert alert-<?= $_GET['result'] == 'success' ? 'success' : 'danger' ?>">
               <?= strip_tags($_GET['message']) ?>

           </div>
       <?php else: ?>
           <div class="status"></div>
       <?php endif; ?>
       </form>
    </div>


   <div class="commentListBox">
     <h2>Liste des commentaires</h2>
     <div class="noComment">
       <?php
       if (empty($comments))
       {
       ?>
       <p id="noCommentMsg">Aucun commentaire n'a encore été posté.<br> Soyez le premier à en laisser un !</p>
       <?php
       }

       ?>
     </div>
     <?php
     foreach ($comments as $comment)
     {
     ?>
     <div class="comment">

       <fieldset>
         <legend class="comment-infos">
           Posté par : <strong><?= htmlspecialchars($comment['pseudo']) ?></strong> le : <?= $comment['commentDate']->format('d/m/Y à H\hi') ?>
           <?php if ($user->isAuthenticated()) { ?>
             <a class="btn-danger" href="/admin/comment-delete-<?= $comment['id'] ?>-chap-<?= $chapter['chapterNumber'] ?>.html">Supprimer</a>
           <?php } ?>
         </legend>
         <div class="commentContent"><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></div>
       </fieldset>
     </div>
     <?php
     }
     ?>
   </div>
