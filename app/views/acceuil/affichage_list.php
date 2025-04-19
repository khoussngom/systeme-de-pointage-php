<?php 
include __DIR__ . "/../layout/base.layout.php";

return function ($data) {
    ob_start();
    $urlCss = "http://" . $_SERVER["HTTP_HOST"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Affichage Liste</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="<?= $urlCss . Chemins::CheminAssetCss->value . '/affichage_list.css' ?>">
</head>
<body>
  <div class="sidebar">
    <div>
      <h2>Sonatel</h2>
      <ul>
        <li><i class="fas fa-tachometer-alt"></i> Tableau de bord</li>
        <br><br>
        <li class="active"><i class="fas fa-graduation-cap"></i> Promotions</li>
        <br>
        <li><i class="fas fa-book"></i> Référentiels</li>
        <br>
        <li><i class="fas fa-users"></i> Apprenants</li>
        <br>
        <li><i class="fas fa-calendar-check"></i> Présences</li>
        <br>
        <li><i class="fas fa-laptop"></i> Kits & Laptops</li>
        <br>
        <li><i class="fas fa-chart-line"></i> Rapports & Stats</li>
      </ul>
    </div>
    <button style="padding: 10px; background-color: #ffe6e6; border: none; border-radius: 5px;">
      <i class="fas fa-sign-out-alt"></i> Déconnexion
    </button>
  </div>

  <div class="main">
    <div class="top-bar">
      <h2><span style="color: orange;"><?= htmlspecialchars(end($data['Promotion'])['MatriculePromo']) ?> </span></h2>
      <button style="padding: 10px 15px; background-color: #00775b; color: white; border-radius: 8px; border: none;">
        + Ajouter promotion
      </button>
    </div>

    <div class="filters">
      <input type="text" placeholder="Rechercher...">
      <select><option>Filtrer par classe</option></select>
      <select><option>Filtrer par statut</option></select>
    </div>

    <div class="stats">
      <div class="stat-card"><i class="fas fa-user-graduate fa-2x"></i><?= htmlspecialchars($data['nbrAppr']) ?><br><small>Apprenants</small></div>
      <div class="stat-card"><i class="fas fa-book fa-2x"></i><?= htmlspecialchars($data['nbrRef']) ?><br><small>Référentiels</small></div>
      <div class="stat-card"><i class="fas fa-user fa-2x"></i><?= htmlspecialchars($data['nbrProm']) ?><br><small>Promotions</small></div>
      <div class="stat-card"><i class="fas fa-users fa-2x"></i>13<br><small>Permanents</small></div>
    </div>

    <table>
      <thead>
        <tr>
          <th>Photo</th>
          <th>Promotion</th>
          <th>Date de début</th>
          <th>Date de fin</th>
          <th>Référentiel</th>
          <th>Statut</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['Promotion'] as $promotion): ?>
          <tr>
            <td><img src="<?=Chemins::CheminAssetImage->value . '/' . ($promotion['photoPromo'] ?? 'imagesp7.jpeg')?>" class="photo" /></td>
            <td><?= htmlspecialchars($promotion['MatriculePromo']) ?></td>
            <td><?= htmlspecialchars($promotion['debut']) ?></td>
            <td><?= htmlspecialchars($promotion['fin']) ?></td>
            <td class="tags">
              <?php foreach (explode(',', $promotion['filiere']) as $filiere): ?>
                <span class="<?= "tag-".htmlspecialchars(trim($filiere)) ?>"><?= htmlspecialchars(trim($filiere)) ?></span>
              <?php endforeach; ?>
            </td>
            <td class="status <?= htmlspecialchars($promotion['etat']) ?>">●<?= htmlspecialchars($promotion['etat']) ?></td>
            <td class="actions"><i class="fas fa-ellipsis-h"></i></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="pagination">
      <form method="get" style="display: inline;">
          <span>par page</span>
          <select name="perPage" onchange="this.form.submit()">
            <?php foreach ([2,4,6,12,24,48] as $option): ?>
              <option value="<?= $option ?>" <?= ($option == (isset($_GET['perPage']) ? (int)$_GET['perPage'] : 6)) ? 'selected' : '' ?>>
                <?= $option ?>
              </option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" name="page" value="1">
        </form>

        <span><?= $data['pageActuelle'] ?> sur <?= $data['totalPages'] ?></span>

        <?php
          $perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 6;
        ?>

        <?php if ($data['pageActuelle'] > 1): ?>
          <a href="?page=<?= $data['pageActuelle'] - 1 ?>&perPage=<?= $perPage ?>"><button><</button></a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $data['totalPages']; $i++): ?>
          <a href="?page=<?= $i ?>&perPage=<?= $perPage ?>">
            <button <?= ($i == $data['pageActuelle']) ? 'class="active-page"' : '' ?>>
              <?= $i ?>
            </button>
          </a>
        <?php endfor; ?>

        <?php if ($data['pageActuelle'] < $data['totalPages']): ?>
          <a href="?page=<?= $data['pageActuelle'] + 1 ?>&perPage=<?= $perPage ?>"><button>></button></a>
        <?php endif; ?>
    </div>



  </div>
</body>
</html>
<?php
    return ob_get_clean(); 
}
?>
