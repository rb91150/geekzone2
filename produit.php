<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/assets/css/index.css" />
    <title>Produit n°<?= $_GET['id'] ?> - Geekzone</title>
</head>
<body>
    <div class="page">
        <?php include "./composants/header.php"; ?>
        
        <div class="geekzone-container">
            <?php
                $produits = require "./données/produits.php";
                $id = $_GET['id'] ?? null;
                if (!isset($id) || !isset($produits[$id - 1])) {
                    echo "<h2>Produit introuvable.</h2>";
                    exit;
                }

                $produit = $produits[$id - 1];
            ?>

            <?php if ($_SERVER['REQUEST_METHOD'] === "POST"): ?>
                <h2>Vous avez commandé le produit <?= htmlspecialchars($produit['nom']) ?></h2>
            <?php endif; ?>

            <div class="geekzone-grid-2" style="gap: 64px; align-items: start;">
                <img src="/geekzone2/stockage/produits/<?= urlencode($produit['categorie']) ?>/<?= urlencode($produit['image']) ?>"
                     alt="<?= htmlspecialchars($produit['nom']) ?>"
                     style="width: 100%; max-width: 400px; height: auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.2);" />

                <div>
                    <h1 style="font-size: 3em; margin: 4px 0 0 0; color: #00C853;">
                        <?= number_format($produit['prix'], 2, ',', ' ') ?> €
                    </h1>
                    <h2 style="font-size: 2em; margin: 4px 0;"><?= htmlspecialchars($produit['nom']) ?></h2>

                    <div style="margin: 16px 0;">
                        Catégorie :
                        <span style="background-color: #00E676; padding: 6px 20px; border-radius: 50px; color: white;">
                            <?= htmlspecialchars($produit['categorie']) ?>
                        </span>
                    </div>

                    <div style="margin-bottom: 16px; color: #666;">
                        Ville : <?= htmlspecialchars($produit['ville']) ?> - <?= htmlspecialchars($produit['code_postal']) ?>
                    </div>

                    <p style="margin-bottom: 16px;"><?= nl2br(htmlspecialchars($produit['description'])) ?></p>
                    <p style="margin-bottom: 24px;"><?= $produit['details'] ?></p>

                    <form action="" method="post">
                        <button class="geekzone-button geekzone-button-full">Commander</button>
                    </form>
                </div>
            </div>

            <h1 style="font-size: 2em; margin-top: 64px;">Autres produits</h1>
            <?php
                $autres_produits = array_filter($produits, function ($autre) use ($produit) {
                    return $autre['id'] !== $produit['id'] && $autre['categorie'] === $produit['categorie'];
                });

                function creerProduit($p) {
                    ob_start(); ?>
                    <div class="geekzone-produit" style="width: 200px; margin-bottom: 32px;">
                        <a href="produit.php?id=<?= $p['id'] ?>" style="text-decoration: none; color: inherit;">
                            <img src="/geekzone2/stockage/produits/<?= urlencode($p['categorie']) ?>/<?= urlencode($p['image']) ?>"
                                 alt="<?= htmlspecialchars($p['nom']) ?>"
                                 style="width: 100%; height: auto; border-radius: 8px;" />
                            <h3 style="margin: 8px 0; font-size: 1.2em;"><?= number_format($p['prix'], 2, ',', ' ') ?> €</h3>
                            <div><?= htmlspecialchars($p['nom']) ?></div>
                            <div style="font-size: 0.8em; font-style: italic; color: #666;">
                                <?= htmlspecialchars($p['ville']) ?> - <?= htmlspecialchars($p['code_postal']) ?>
                            </div>
                        </a>
                    </div>
                    <?php
                    return ob_get_clean();
                }
            ?>

            <div class="geekzone-grid-3" style="margin-top: 32px;">
                <?php foreach ($autres_produits as $p): ?>
                    <?= creerProduit($p); ?>
                <?php endforeach; ?>
            </div>
        </div>

        <?php include "./composants/footer.php"; ?>
    </div>
</body>
</html>
