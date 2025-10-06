<?php
include "database/database.php";
session_start();
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit;
}
if ($_SESSION['Role'] === "Admin") {
    header("Location: admin.php");
    exit;
}
$currentPage = 'home.php';
include_once 'nav.php';
?>
<link rel="stylesheet" href="styles/avatar.css">
<div class="container welcome mt-5">
    <div class="row">
        <div class="col-xxl-2 col-12 text-start">
            <button class="back"><i class="bi bi-backspace-fill"></i> Back</button>
        </div>
        <div class="col-xxl-8 col-12 text-center imageicon josefin-sans">
            <img src="<?php echo $_SESSION['Profile'] ?>">
            <h1 class="mt-2">Your current Avatar</h1>
            <h2>Choose your new Avatar</h2>
        </div>
    </div>
    <div class="row">
        <?php
        $icon = array(
            "Sage" => "https://media.valorant-api.com/agents/569fdd95-4d10-43ab-ca70-79becc718b46/displayicon.png",
            "Neon" => "https://cdn3.emoji.gg/emojis/3666-valorant-neon-icon.png",
            "Killjoy" => "https://media.valorant-api.com/agents/1e58de9c-4950-5125-93e9-a0aee9f98746/displayicon.png",
            "Jett" => "https://media.valorant-api.com/agents/add6443a-41bd-e414-f6ad-e58d267f4e95/displayicon.png",
            "Breach" => "https://val.owen.biz/Resources/Thumbnails/breach.png",
            "Viper" => "https://media.valorant-api.com/agents/707eab51-4836-f488-046a-cda6bf494859/displayicon.png",
            "Yoru" => "https://media.valorant-api.com/agents/7f94d92c-4234-0a36-9646-3a87eb8b5c89/displayicon.png",
            "Iso" => "https://cdn3.emoji.gg/emojis/3655-valorant-iso-icon.png",
            "Gekko" => "https://titles.trackercdn.com/valorant-api/agents/e370fa57-4757-3604-3648-499e1f642d3f/displayicon.png",
            "Chamber" => "https://media.valorant-api.com/agents/22697a3d-45bf-8dd7-4fec-84a9e28c69d7/displayicon.png",
            "Fade" => "https://tiermaker.com/images/templates/valorant-agents-fade-15154563/151545631655300856.png",
            "KAY/O" => "https://th.bing.com/th/id/R.b24c32486955c51626f797c747d28e47?rik=f7K%2be%2bmIguF9wg&pid=ImgRaw&r=0",
            "Phoenix"  => "https://media.valorant-api.com/agents/eb93336a-449b-9c1b-0a54-a891f7921d69/displayicon.png",
            "Clove" => "https://www.vlr.gg/img/vlr/game/agents/clove.png",
            "Harbor" => "https://s3-us-east-2.amazonaws.com/strats-gg/images/c50f2e4a-d47a-4d5e-aea1-7b4b1ea5067a.png",
            "Raze" => "https://www.vlr.gg/img/vlr/game/agents/raze.png",
            "Astra" => "https://media.valorant-api.com/agents/41fb69c1-4189-7b37-f117-bcaf1e96f1bf/displayicon.png",
            "Syke" => "https://media.valorant-api.com/agents/6f2a04ca-43e0-be17-7f36-b3908627744d/displayicon.png",
            "Deadlock" => "https://media.valorant-api.com/agents/cc8b64c8-4b25-4ff9-6e7f-37b4da43d235/displayicon.png",
            "Brimstone" => "https://media.valorant-api.com/agents/9f0d8ba9-4140-b941-57d3-a7ad57c6b417/displayicon.png",
            "Cypher" => "https://media.valorant-api.com/agents/117ed9e3-49f3-6512-3ccf-0cada7e3823b/displayicon.png",
            "Omen" => "https://media.valorant-api.com/agents/8e253930-4c05-31dd-1b6c-968525494517/displayicon.png",
            "Skye" => "https://media.valorant-api.com/agents/6f2a04ca-43e0-be17-7f36-b3908627744d/displayicon.png",
            "Reyna" => "https://media.valorant-api.com/agents/a3bfb853-43b2-7238-a4f1-ad90e9e46bcc/displayicon.png"
        );
        foreach ($icon as $key => $value) {
            echo "<div class='col-xxl-2 col-lg-3 col-md-4 col-6 imageicon text-center mt-3'> 
                    <form action='changepf.php' method='post'>
                        <input type='hidden' name='agent_name' value='" . $value . "'>
                        <img src='" . $value . "'><br>
                        <input type='submit' value='" . $key . "' class='selectagent mt-3 josefin-sans'>
                    </form>
                </div>";
        }
        ?>
    </div>
</div>
<script src="javascripts/avatar.js"></script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agent_name'])) {
        $agentName = $_POST['agent_name'];
        $updateQuery = "UPDATE UserAccount SET Profile = '$agentName' WHERE UserID = '{$_SESSION['UserID']}'";

        if ($conn->query($updateQuery) === TRUE) {
            $_SESSION['Profile'] = $agentName;
            echo "<script>window.location.reload(); window.location.href = 'home.php';</script>";
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Agent name is not received.";
    }
} else {
}
$conn->close();
?>