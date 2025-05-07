<?php
$produits = require "./données/produits.php";
$filtreNom = $_GET['nom'] ?? '';
$filtreCategorie = $_GET['categorie'] ?? '';
$filtreVille = $_GET['ville'] ?? '';

$produits_filtres = array_filter($produits, function ($produit) use ($filtreNom, $filtreCategorie, $filtreVille) {
    return 
        (empty($filtreNom) || stripos($produit['nom'], $filtreNom) !== false) &&
        (empty($filtreCategorie) || $produit['categorie'] === $filtreCategorie) &&
        (empty($filtreVille) || $produit['ville'] === $filtreVille);
});

function creerProduit($produit) {
    ob_start(); ?>
    <div class="geekzone-produit" style="border: 1px solid #ccc; border-radius: 8px; padding: 16px; box-shadow: 2px 2px 8px rgba(0,0,0,0.1);">
        <a href="produit.php?id=<?= $produit['id'] ?>" style="text-decoration: none; color: inherit;">
            <img src="/geekzone2/stockage/produits/<?= urlencode($produit['categorie']) ?>/<?= urlencode($produit['image']) ?>" 
                alt="<?= htmlspecialchars($produit['nom']) ?>" 
                style="width: 100%; max-width: 240px; height: auto; display: block; margin: 0 auto;" />
            <h3 style="margin: 12px 0 4px 0; font-size: 1.4em; text-align: center;">
                <?= number_format($produit['prix'], 2, ',', ' ') ?> €
            </h3>
            <div style="text-align: center; font-weight: bold;"><?= htmlspecialchars($produit['nom']) ?></div>
            <div style="text-align: center; font-size: 0.9em; font-style: italic;"><?= htmlspecialchars($produit['ville']) ?> - <?= htmlspecialchars($produit['code_postal']) ?></div>
        </a>
    </div>
    <?php
    return ob_get_clean();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Produits - Geekzone</title>
    <link rel="stylesheet" href="/assets/css/index.css" />
</head>
<body>
<div class="page">
    <?php include "./composants/header.php" ?>

    <div class="geekzone-container">
        <form method="get" class="geekzone-form" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <input type="text" name="nom" placeholder="Nom du produit" value="<?= htmlspecialchars($filtreNom) ?>" />
            <select name="categorie">
                <option value="">Toutes les catégories</option>
                <?php foreach (['cuisine', 'gadget', 'mode', 'portable', 'USB'] as $cat): ?>
                    <option value="<?= $cat ?>" <?= $filtreCategorie === $cat ? 'selected' : '' ?>><?= ucfirst($cat) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="ville">
                <option value="">Toutes les villes</option>
                <?php foreach (array_unique(array_column($produits, 'ville')) as $ville): ?>
                    <option value="<?= $ville ?>" <?= $filtreVille === $ville ? 'selected' : '' ?>><?= $ville ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Rechercher</button>
        </form>

        <div class="geekzone-grid-3" style="margin-top: 32px; display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">
            <?php foreach ($produits_filtres as $produit): ?>
                <?= creerProduit($produit); ?>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include "./composants/footer.php" ?>
</div>
</body>
</html>
