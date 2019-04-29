
	<h2>Commencez au 1er chapitre en cliquant <a href="/chapter-1">ICI</h2></p>
<div class="chap-list-page">
	<div class="chapter-posted-list-box">
		<?php
		foreach ($chapterList as $chapter)
		{
			if ($chapter['posted'] === 'OUI') {
				?>
				<div class="chapter-box">

						<div class="infosChapter ">
							<a href="/chapter-<?= $chapter['chapterNumber']?>"><h3 class="chapter-title-frontend"><?= $chapter['titre'] ?></h3></a>
							<p>Chapitre N°:<?= $chapter['chapterNumber']?></p>
							<p>Le : <?= $chapter['postDate']->format('d/m/Y à H\hi') ?></p>
							<p>Par : <?= $chapter['auteur'] ?></p>
						</div>

				</div>
				<?php
			}
		}
		?>
	</div>

</div>
