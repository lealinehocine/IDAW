<?php
    require_once('template_header.php');
    require_once("template_menu.php");

    $defaultLang = 'fr'; 
    $currentLang = isset($_GET['lang']) ? $_GET['lang'] : $defaultLang;
    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
    $currentPageId = $_GET['page'];
}
?>

<?php
renderMenuToHTML($currentPageId, $currentLang);
?>

<div class="center">
    <header class="bandeau_haut">


        <h1>Léa-Line SAAD</h1>

        <?php
        if($currentLang=="fr"){
            echo '<a href="index.php?page=' .$currentPageId . '&lang=en">Anglais</a>';
        }
        else
        echo '<a href="index.php?page=' .$currentPageId . '&lang=fr">Français</a>';
        ?>

    </header>


    <section class="corps">
    <?php
    $pageToInclude = $currentLang . "/" .$currentPageId . ".php";
    if(is_readable($pageToInclude))
    require_once($pageToInclude);
    else
    require_once("error.php");
    ?>
</section>


    </div>
<?php
require_once('template_footer.php');


