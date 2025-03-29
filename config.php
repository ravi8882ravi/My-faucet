<?php
$host = "sql300.infinityfree.com";  // InfinityFree MySQL Hostname
$user = "if0_38598967";  // InfinityFree MySQL Username
$pass = "r9992r9992";  // InfinityFree MySQL Password
$dbname = "if0_38598967_FastPayFaucet";  // InfinityFree Database Name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Faucet Settings
$min_reward = 0.00000001;  // Minimum Reward in BTC
$max_reward = 0.00000001;  // Maximum Reward in BTC
$claim_interval =0.0.10;  // Claim Cooldown (Seconds)
?>
