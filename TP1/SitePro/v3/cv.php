<?php
require_once('template_header.php');
?>

<h1>Léa-Line SAAD - CV</h1>

<div class="center">

<?php
require_once('template_menu.php');
renderMenuToHTML('cv');
?>

<div class="container">

    <div class="rubrique">
    <h1>Expériences professionnelles</h1>
    <h3>Stagiaire ingénieure logiciel UX - Mai 2024 à Août 2024</h3>
    <p>Ergosign GmbH,Saarbrück, Allemagne</p>
    </div>

    <div class="rubrique">
    <h1>Formation</h1>
    <h3>IMT Nord Europe, Douai - 2023-2026</h3>
    <p>Cycle ingénieur généraliste - filière numérique</p>

    <h3>Lycée Jean-Baptiste Kléber - Strasbourg - 2020-2023</h3>
    <p>Classe préparatoire aux grandes écoles d’ingénieur - filière MP</p>

    <h3>Lycée Jean de Pange - Sarreguemines - 2017-2020</h3>
    <p>Baccalauréat S mention très bien - classe ABIBAC</p>
    </div>

    <div class="rubrique">
    <h1>Projets scolaires</h1>
    <h3>Projet ouvert de première année de cycle ingénieur - Octobre 2023 à avril 2024</h3>
    <p>Cheffe du projet Sport Pour Tous </p>
    </div>
</div>

</div>
<?php
require_once('template_footer.php');
?>