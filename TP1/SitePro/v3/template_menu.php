<?php
    function renderMenuToHTML($currentPageId, $currentLang) {
        // un tableau qui d\'efinit la structure du site
    $mymenu = array(
        // idPage titre
        'accueil' => array( 'Accueil' ), // à la clé index j'associe Accueil...
        'cv' => array( 'CV' ),
        'competences' => array('Compétences'),
        'projets' => array('Hobbies'),
        'contact'=> array('Contact')
        );
        
        echo ("<nav class=\"menu\">
        <div class=\"photo\">
        <img src=\"../photo.png\" alt=\"Photo CV\"  height=\"200\" width=\"auto\" />
        </div>
        <ul>");
        foreach($mymenu as $pageId => $pageParameters) {

            $url = "http://localhost/IDAW/TP1/SitePro/v3/index.php?page=" . $pageId . "&lang=" . $currentLang;
            if($pageId == $currentPageId){
            echo ("<li class=\"li_menu\" id=\"currentpage\"><a href=\"$url\">$pageParameters[0]</a></li>");}
            else{
                echo ("<li class=\"li_menu\"><a href=\"$url\">$pageParameters[0]</a></li>");
            }
        }
        echo ("</ul>
        </nav>");
        }
?>