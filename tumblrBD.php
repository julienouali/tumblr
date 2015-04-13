<?php
session_start();
define('APP_PATH', __DIR__);
include (APP_PATH.'/conf/_conf.php');
include (INC_DIR.'/functions.php');
include (INC_DIR.'/header.php');

//Initialisationd de la variable de connexion
$connected = FALSE;

// Si image est un champ type=file
if(!empty($_FILES)) {

    if($_FILES['image']['error'] === 0 && $_FILES['image']['size'] > 0) {
        $image = $_FILES['image'];
        $caption = filter_input(INPUT_POST, 'caption',FILTER_SANITIZE_STRING);
        $imageBDD = createImage($image,$caption,$_SESSION['ID']);

        if(!empty($imageBDD)){
            $error = 'Problème lors de l\'enregistrement de l\'image dans la base ';
            $error .= $imageBDD;
        }
    } else {
        $error = 'Problème lors de l\'upload de l\'image';
    }
    
} elseif(filter_has_var(INPUT_GET, 'singleimage')){
        $singleimage = filter_input(INPUT_GET, 'singleimage',FILTER_SANITIZE_STRING);
        if($singleimage != 'ALL') { 
            $allImages = FALSE;
        }
}

if(isset($_SESSION['logged_in'])) {
    $connected = $_SESSION['logged_in'];
    $tabImages = getImages($_SESSION['ID']);
    
    if(isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
        header('refresh:5;'.$_SERVER['PHP_SELF']);
    }
    
} else {
    $tabImages = getImages();
}

//Récupère le tableaux d'images

if(!is_array($tabImages)) {
    $error = $tabImages;
}


//Securiser le PHP_SELF
?>
<div id="container"> <!-- Container -->
<nav>
    
    <?php if($connected === TRUE) { ?>
    <p>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data"> 
            <input type="file" name="image" placeholder="Insérer une image">
            <input type="text" name="caption" placeholder="Commentaire image">
            <input type="submit" value="Envoyer">
        </form>
        <a href="logout.php">Déconnecter</a>
    </p>
    <?php } else { ?>
        <p><a href="login.php">Connecter</a></p>
    <?php }?>
    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <select name="singleimage">
            <option value="ALL">Toutes les images</option>
            <?php
            
            foreach ($tabImages as $imageID => $image) {
                ?>
            <option value="<?php echo $imageID ?>"><?php echo $image['nomImage'];?></option>
            <?php
            }
            
            ?>
        </select>
        <input type="submit" value="Envoyer">
    </form>
    </nav>
<?php if(!empty($error)) { ?>
    <div class="error"><?php echo $error;?></div>  
    
<?php die();
    }
?>
    <?php 
    
    if($allImages == TRUE && $error == '') {
        foreach($tabImages as $imageID => $image) {
?>       
        <figure class="">
            <div class="blocimg">
            <img src="<?php echo DIR_IMG.'/'.$image['path'];?>" alt="<?php echo $image['nomImage'];?>">
            </div>
            
            <figcaption><?php echo $image['caption'].' ';?>
            <?php   if(isset($_SESSION['ID']))  {
                        if($image['idUser'] == $_SESSION['ID']) { ?>
                <a href="delete.php?idImage=<?php echo $image['idImage'];?>" title="Supprimer">X</a>
            <?php       }
                    }?>
            </figcaption>
            
        </figure>
        <?php        
        
        }
    } else {
        
        //Affiche une seule image depuis le tableau
        ?>
        <figure class="">
            <div class="blocimg"><img src="<?php echo DIR_IMG.'/'.$tabImages[$singleimage]['path'];?>" 
                                      alt="<?php echo $tabImages[$singleimage]['nomImage'];?>">
            </div>
            <figcaption><?php echo $tabImages[$singleimage]['caption'];?></figcaption>
        </figure>
<?php
    }
    
    ?>
    
    </div>    <!-- fin container -->
    
    
    
<?php

include (__DIR__.'/includes/footer.php');
?>