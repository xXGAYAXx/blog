<h2>posté(s)</h2>
<div class="chapter-posted-list-box">

	<?php
	foreach ($listeChapter as $chapter)
	{
		if ($chapter['posted'] === 'OUI'){
			?>
			<div class="chapter-box">

				<div class="infosChapter ">
					<a href="/admin/chapter-<?= $chapter['chapterNumber']?>"><h3 class="chapter-title"><?= $chapter['titre'] ?></h3></a>
					<p>Chapitre N°:<?= $chapter['chapterNumber']?></p>
					<p>Par : <?= $chapter['auteur'] ?> <br>Le : <?= $chapter['postDate']->format('d/m/Y à H\hi') ?></p>
				</div>
				<p><a class="btn-success" href="/admin/chapter-update-<?= $chapter['id'] ?>-chap-<?= $chapter['chapterNumber'] ?>.html">Modifier</a> <a class="btn-danger" href="/admin/chapter-delete-<?= $chapter['chapterNumber'] ?>.html">Supprimer</a></p>

			</div>

			<?php
		}
	}
			?>
		</div>
		<h2>Non posté(s)</h2>
		<div class="chapter-not-posted-list-box">

			<?php
			foreach ($listeChapter as $chapter)
			{
				if ($chapter['posted'] === 'NON'){
					?>
					<div class="chapter-box">

						<div class="infosChapter ">
							<a href="/admin/chapter-<?= $chapter['chapterNumber']?>"><h3 class="chapter-title"><?= $chapter['titre'] ?></h3></a>
							<p>Chapitre N°:<?= $chapter['chapterNumber']?></p>
							<p>Par : <?= $chapter['auteur'] ?> <br>Le : <?= $chapter['postDate']->format('d/m/Y à H\hi') ?></p>
						</div>
						<p><a class="btn-success" href="/admin/chapter-update-<?= $chapter['id'] ?>-chap-<?= $chapter['chapterNumber'] ?>.html">Modifier</a> <a class="btn-danger" href="/admin/chapter-delete-<?= $chapter['chapterNumber'] ?>.html">Supprimer</a></p>

					</div>
				
					<?php
				}
			}
					?>
			</div>
