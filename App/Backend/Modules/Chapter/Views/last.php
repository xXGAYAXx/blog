<div class="show-chapter-Box">
  <div class="pagination">
  <?php
    if ($precedingChapter != null) {
      ?>
      <div class="next">
        <p> <a href="/admin/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre suivant</a> </p>
      </div>
      <?php
    }
    if ($followingChapter != null) {
      ?>
      <div class="last">
        <p> <a href="/admin/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre précédent</a> </p>
      </div>
      <?php
    }
  ?>
  <p class="chap-number">Chapitre N°: <?= $chapter['chapterNumber']?></p>
  </div>
  <p>Synopsis: <?= $chapter['synopsis'] ?></p>
  <p><?= nl2br($chapter['contenu']) ?></p>
  <div class="pagination">
  <?php
    if ($precedingChapter != null) {
      ?>
      <div class="next">
        <p> <a href="/admin/chapter-<?= $chapter['chapterNumber'] + 1 ?>">Chapitre suivant</a> </p>
      </div>
      <?php
    }
    if ($followingChapter != null) {
      ?>
      <div class="last">
        <p> <a href="/admin/chapter-<?= $chapter['chapterNumber'] - 1 ?>">Chapitre précédent</a> </p>
      </div>
      <?php
    }
  ?>
  <p>Par <em><?= $chapter['auteur'] ?></em>, le <?= $chapter['postDate']->format('d/m/Y à H\hi') ?> Posté: <?= $chapter['posted'] ?></p>
  <p><a class="btn-success" href="/admin/chapter-update-<?= $chapter['id'] ?>-chap-<?= $chapter['chapterNumber'] ?>.html">Modifier</a> <a class="btn-danger" href="/admin/chapter-delete-<?= $chapter['chapterNumber'] ?>.html">Supprimer</a></p>

  </div>
  <div class="btn-box">
    <button class="btn-primary full-screen">Plein écran</button>
    <button class="btn-primary scroll">Mode scroll</button>
  </div>
</div>
