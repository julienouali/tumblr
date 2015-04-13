<?php
session_start();
define('APP_PATH', __DIR__);
include (APP_PATH.'/conf/_conf.php');
include (INC_DIR.'/functions.php');
include (INC_DIR.'/header.php');

$nom = '';
$prenom = '';
$motDePasse = '';
$verifMotDePasse = '';
$login = '';
$error = FALSE;

if(!empty($_SESSION) && 
    isset($_SESSION['nom'],
        $_SESSION['prenom'],
        $_SESSION['error'])
        ){
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $error = TRUE;
}

?>

        <div id="container">
            
            <?php 
            if($error == TRUE) {
                ?>
            <div class="error"><?php echo $_SESSION['error']; ?></div>
            <?php
            }
            
            if(isset($_SESSION['msg'])) { 
                ?>
                <div class="msg"><?php echo $_SESSION['msg']; ?></div>
            <?php 
            
            }
            
            ?>
            
            
            <p>
                <!-- FORMULAIRE DE LOGIN -->
                <form method="POST" action="backoffice.php">
                    <p>
                        <input type="text" name="login" value="<?php echo $login?>" placeholder="login" required=""/>
                    </p>
                    <p>
                        <input type="password" name="motdepasse" value="" placeholder="Mot de passe" required=""/>
                    </p>
                    <p>
                        <input type="submit" name="logon" value="Se connecter">
                    </p>
                </form>
            </p>
            <p>
                <!-- FORMULAIRE CREATION DE COMPTE -->
                <form method="POST" action="backoffice.php">
                    <p>
                        <input type="text" name="nom" value="<?php echo $nom?>" placeholder="nom" required=""/>
                    </p>
                    <p>
                        <input type="text" name="prenom" value="<?php echo $prenom?>" placeholder="prenom"/>
                    </p>
                    <p>
                        <input type="password" name="motdepasse" value="" placeholder="Mot de passe" required=""/>
                    </p>
                    <p>
                        <input type="password" name="verifmotdepasse" value="" placeholder="Vérification mot de passe" required=""/>
                    </p>
                    <p>
                        <input type="submit" name="create" value="Enregistrer">
                    </p>
                </form>
            </p>
        </div>
<?php 
        include (INC_DIR.'/footer.php');
?>