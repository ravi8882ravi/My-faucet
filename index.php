<?php
include 'config.php';

$user_ip = $_SERVER['REMOTE_ADDR'];  // Get User's IP Address

// Check Claim Cooldown
$sql = "SELECT claim_time FROM claims WHERE user_ip = '$user_ip' ORDER BY claim_time DESC LIMIT 1";
$result = $conn->query($sql);
$can_claim = true;

if ($result->num_rows > 0) {
    $last_claim = $result->fetch_assoc()['claim_time'];
    $time_since_last_claim = time() - strtotime($last_claim);

    if ($time_since_last_claim < $claim_interval) {
        $can_claim = false;
        $remaining_time = $claim_interval - $time_since_last_claim;
    }
}

// Handle Faucet Claim
if ($_SERVER["REQUEST_METHOD"] == "POST" && $can_claim) {
    $reward_amount = rand($min_reward * 100000000, $max_reward * 100000000) / 100000000;

    // Save Claim in Database
    $stmt = $conn->prepare("INSERT INTO claims (user_ip) VALUES (?)");
    $stmt->bind_param("s", $user_ip);
    $stmt->execute();
    $stmt->close();

    echo "<p>✅ You have claimed $reward_amount BTC! Come back later.</p>";
} else {
    if (!$can_claim) {
        echo "<p>❌ You must wait " . gmdate("H:i:s", $remaining_time) . " before claiming again.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crypto Faucet</title>
</head>
<body>
    <h1>🚰 Free Crypto Faucet</h1>
    <form method="POST">
        <button type="submit" <?= !$can_claim ? 'disabled' : '' ?>>💰 Claim Reward</button>
    </form>
</body>
</html>
