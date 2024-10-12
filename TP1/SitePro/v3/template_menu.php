<?php
    function renderMenuToHTML($currentPageId, $currentLang) {
        // un tableau qui d\'efinit la structure du site
    $mymenu = array(
        // idPage titre
        'accueil' => array( 'Accueil' ), // à la clé index j'associe Accueil...
        'cv' => array( 'CV' ),
        'projets' => array('Hobbies'),
        'contact'=> array('Contact')
        );
        echo ("<nav class=\"menu\">
        <ul>");
        foreach($mymenu as $pageId => $pageParameters) {

            $url = "http://localhost/IDAW/TP1/SitePro/v3/index.php?page=" . $pageId . "&lang=" . $currentLang;
            if($pageId == $currentPageId){
            echo ("<li id=\"currentpage\"><a href=\"$url\">$pageParameters[0]</a></li>");}
            else{
                echo ("<li><a href=\"$url\">$pageParameters[0]</a></li>");
            }
        }
        echo ("</ul>
        </nav>");
        }
?>