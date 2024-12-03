<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crypto Masters</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h4>Crypto Masters</h4>
        <p>Welcome to Sahara Agency for Trading and scamming people</p>
        <form method="POST" action="index.php">
            <div class="form-group">
                <input type="number" id="amount" name="amount" placeholder="Montant" required 
                value="<?php echo isset($_POST['amount']) ? htmlspecialchars($_POST['amount']) : ''; ?>">

                <select id="crypto" name="crypto">
                    <option value="BTC" <?php echo (isset($_POST['crypto']) && $_POST['crypto'] == 'BTC') ? 'selected' : ''; ?>>Bitcoin (BTC)</option>
                    <option value="ETH" <?php echo (isset($_POST['crypto']) && $_POST['crypto'] == 'ETH') ? 'selected' : ''; ?>>Ethereum (ETH)</option>
                </select>
            </div>
            <button type="submit">Convertir</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $amount = $_POST['amount'];
            $crypto = $_POST['crypto'];
            $url = "https://cex.io/api/ticker/{$crypto}/EUR";

            if (is_numeric($amount) && $amount > 0) {
                $json = file_get_contents($url);

                if ($json) {
                    $data = json_decode($json, true);
                    $rate = $data['last'];

                    if ($rate) {
                        $result = $amount * $rate;
                        echo "<div class='result'>{$amount} {$crypto} = " . number_format($result, 2, ',', ' ') . " EUR</div>";
                    } else {
                        echo "<div class='error'>Erreur lors de la récupération du taux de change.</div>";
                    }
                } else {
                    echo "<div class='error'>Impossible de récupérer les données de l'API.</div>";
                }
            } else {
                echo "<div class='error'>Veuillez saisir un montant valide.</div>";
            }
        }
        ?>
    </div>
</body>
</html>
