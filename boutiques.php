<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/geekzone2/assets/css/index.css" />
        <title>Geekzone - Boutiques</title>
    </head>
    <body>
        <div class="page">
            <?php include "./composants/header.php" ?>
            <div class="geekzone-container">
                <?php include "./inclure/fonctions/boutique.php" ?>
                <h1>Boutiques</h1>
                <?php foreach(getBoutiqueInfos() as $boutique): ?>
                    <div class="geekzone-boutique">
                        <div>
                            <img
                                src="/geekzone2/stockage/boutiques/<?= $boutique['image'] ?>"
                                alt="Boutique <?= $boutique['ville'] ?>"
                                width="200"
                                style="border-radius: 8px; object-fit: cover;"
                            />
                        </div>
                        <div>
                            <ul>
                                <li><p><strong>Adresse :</strong> <?= $boutique['rue'] ?></p></li>
                                <li><p><strong>Code postal :</strong> <?= $boutique['cp'] ?></p></li>
                                <li><p><strong>Ville :</strong> <?= $boutique['ville'] ?></p></li>
                                <li><p><strong>Téléphone :</strong> <?= $boutique['telephone'] ?></p></li>
                                <li><p><strong>Horaires :</strong> <?= $boutique['horaires'] ?></p></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php include "./composants/footer.php" ?>
        </div>
    </body>
</html>
