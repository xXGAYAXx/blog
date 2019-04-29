<?php
  if ($chapter['posted'] === 'OUI'){
    ?>
    <div class="show-chapter-Box">
      <div class="pagination">
      <?php
      if ($followingChapter != null) {
        ?>
        <div class="next">
          <p><a href="/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre<br>suivant</a></p>
        </div>
        <?php
      }
      if ($precedingChapter != null) {
        ?>
        <div class="last">
          <p><a href="/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre<br>précédent</a></p>
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
      <div class="synop">
        <p class="chap-label">Synopsis: </p>
        <p><?= $chapter['synopsis'] ?></p>
      </div>
      <div class="chap">
        <p class="chap-label">Chapitre: </p>
        <p class="chap-content"><?= nl2br($chapter['contenu']) ?></p>
      </div>
      <div class="btn-box">
        <button class="btn-primary full-screen">Plein écran</button>
        <button class="btn-primary scroll">Mode scroll</button>
      </div>

      <div class="pagination">
      <?php
      if ($followingChapter != null) {
        ?>
        <div class="next">
          <p><a href="/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre<br>suivant</a></p>
        </div>
        <?php
      }
      if ($precedingChapter != null) {
        ?>
        <div class="last">
          <p><a href="/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre<br>précédent</a></p>
        </div>
        <?php
      }
      ?>
      <p class="signature">Ecrit par: <span class="chap-auteur"><?= $chapter['auteur'] ?></span>, le <?= $chapter['postDate']->format('d/m/Y à H\hi') ?></p>

      </div>

    </div>

    <div class="commentFormBox">
      <form id="commentForm" class="js-simple-ajax-form" method="post" action="">
       <fieldset>
          <legend class="comment-text comment-legend"><h3>Ajouter un commentaire</h3></legend>
          <?= $commentForm ?>
       </fieldset>
       <div class="btn-box">
         <button type="submit"  class="btn btn-success"><strong>Poster un commentaire</strong></button>
       </div>
      </form>
    </div>


   <div class="commentListBox">
     <h3>Liste des commentaires</h3>
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
         <legend>
           Posté par : <span class="chap-auteur"><strong><?= htmlspecialchars($comment['pseudo']) ?></strong></span> le : <?= $comment['commentDate']->format('d/m/Y à H\hi') ?>
         </legend>
         <div class="commentContent"><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></div>
       </fieldset>
     </div>
     <?php
     }
     ?>
   </div>
   <?php
 }else {
   ?>
   <div class="show-chapter-Box">
     <div class="pagination">
     <?php
     if ($followingChapter != null) {
       ?>
       <div class="next">
         <p><a href="/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre<br>suivant</a></p>
       </div>
       <?php
     }
     if ($precedingChapter != null) {
       ?>
       <div class="last">
         <p><a href="/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre<br>précédent</a></p>
       </div>
       <?php
     }
     ?>
     <p class="chap-number">Chapitre N°: <?= $chapter['chapterNumber']?></p>
     </div>
     <p class="synop"><span class="synop-label">Synopsis: </span><?= $chapter['synopsis'] ?></p>

     <p class="futur-post-text">Ce chapitre sera bientôt disponible... Encore un peu de patience!</p>

   <?php
 }
?>
