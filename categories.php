<?

include 'Sitemap.php';
include '../config/settings.inc.php';
$sitemap = new Sitemap('http://www.roseindigo.com');
$sitemap->setPath('maps/');	
// $sitemap->addItem('/filles/naissance', '1.0', 'daily', 'Today');
$sitemap->setFilename('categories');


// VENDEZ
$sitemap->addItem("/vendez", '0.5', 'daily', 'Today');
$sitemap->addItem("/concept", '0.5', 'daily', 'Today');
$sitemap->addItem("/livre-d-or", '0.5', 'daily', 'Today');

// MARQUES
$servername = _DB_SERVER_;
$username 	= _DB_USER_;
$password 	= _DB_PASSWD_;
// Create connection
$conn = new mysqli($servername, $username, $password);
$conn->select_db("presta");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// print_r( "Connected successfully !!!!<br/>");
// print_r($conn);

if ($result = $conn->query("SELECT DATABASE()")) {
    $row = $result->fetch_row();
    // printf("Default database is %s.\n", $row[0]);
    $result->close();
}
// echo "<br/>";

$sql = "SELECT link_rewrite FROM ps_manufacturer WHERE classification IS NOT NULL";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

        $product_url =  "/?marque=" . $row["link_rewrite"];
       	echo "marque : $product_url<br />\n";
        $sitemap->addItem($product_url, '0.5', 'daily', 'Today');
    }
} else {
    echo "0 results<br/>";
}
$conn->close();



// MAIN CAT
$genre 		= array("filles","garcons");
$age 		= array("1m","3m","6m","9m","12m","18m","2a","3a","4a","5a","6a","7a","8a","9a","10a","12a");
$dressing 	= array("Ensemble","Manteau","Pantalon","Short","Robe","Pull","Chemisier","Chemise","Tee-shirt","Barboteuse","Pyjama","Gigoteuse","Sport","Bain","Bonnet","Autres");


// DRESSING + AGE
foreach ($dressing as &$dress) {
    foreach ($age as &$a) {
    	$path = "/-/".$a."/".$dress;
    	$sitemap->addItem($path, '0.5', 'daily', 'Today');
    	echo "Drerssing + age : $path<br />\n";
	}
}

// DRESSING + GENRE
foreach ($dressing as &$dress) {
    foreach ($genre as &$g) {
    	$path = "/".$g."/-/".$dress;
    	$sitemap->addItem($path, '0.5', 'daily', 'Today');
    	echo "Drerssing + genre : $path<br />\n";
	}
}

// // GENRE + AGE
foreach ($age as &$a) {
    foreach ($genre as &$g) {
    	$path = "/".$g."/".$a;
    	$sitemap->addItem($path, '0.5', 'daily', 'Today');
    	echo "age + genre : $path<br />\n";
	}
}





// CHARTE
$charte     = array("/charte/","/charte/qualite/","/charte/livraison/","/charte/services/","/charte/prix/","/charte/prix/","/charte/securite/","/charte/plus/","/charte/tailles/","/charte/cgv/","/charte/legal/","/charte/apropos/");
foreach ($charte as &$path) {

    $sitemap->addItem($path, '0.5', 'daily', 'Today');
    echo "CHARTE : $path<br />\n";
}


// AIDE
$aide     = array("/aide/","/aide/7___questions-generales.html","/aide/8___acheter.html","/aide/9___vendez-videz-vos-armoires.html","/aide/8__comment-ca-marche-.html","/aide/9__compte-client.html","/aide/10__programme-de-parrainage.html","/aide/11__contact.html","/aide/12__qualite-des-vetements.html","/aide/13__generalites.html","/aide/14__livraison.html","/aide/15__retour.html","/aide/16__generalites.html","/aide/17__que-puis-je-envoyer-.html","/aide/18__comment-etre-paye-.html","/aide/19__comment-encaisser-ses-gains-.html","/aide/20__assurance-retour.html","/aide/21__indemnisation.html","/aide/29_comment-puis-je-vendre-mes-vetements-a-roseindigo-.html","/aide/45_combien-darticles-puis-je-mettre-par-sac-.html","/aide/44_que-signifie-comme-neuf-.html","/aide/43_que-signifient-des-vetements-a-la-mode-.html","/aide/38_jhabite-en-region-parisienne-departements-75-92-93-ou-94-pourquoi-ne-puis-je-pas-commander-de-sac-.html","/aide/37_quadvient-il-des-vetements-non-repris-.html","/aide/36_puis-je-demander-le-retour-de-mes-vetements-.html","/aide/35_sous-combien-de-temps-mon-sac-va-t-il-etre-traite-.html","/aide/34_comment-vais-je-savoir-que-roseindigo-a-bien-receptionne-mon-sac-.html","/aide/33_comment-puis-je-trouver-le-point-mondial-relay-le-plus-proche-de-chez-moi-.html","/aide/32_dois-je-payer-pour-vous-adresser-mon-sac-de-vetements-.html","/aide/31_que-se-passe-t-il-une-fois-mon-sac-commande-.html","/aide/30_pourquoi-mon-sac-est-il-payant-.html","/aide/46_pourquoi-certains-articles-que-vous-nacceptez-pas-sont-disponibles-sur-le-site-.html","/aide/39_criteres-qualite-quelles-conditions-de-reprise-.html","/aide/40_quels-vetements-rachetez-vous-.html","/aide/41_quels-vetements-ne-sont-pas-repris-.html","/aide/42_quelles-marques-ne-sont-pas-rachetees-.html","/aide/47_pourquoi-ne-reprenez-vous-pas-les-articles-de-taille-6-mois-et-12-mois-.html","/aide/48_acceptez-vous-les-vetements-avec-une-etiquette-au-nom-de-mon-enfant-.html","/aide/58_marques-reprises.html","/aide/49_combien-vais-je-etre-paye-.html","/aide/50_comment-determinez-vous-la-valeur-de-mon-sac-.html","/aide/52_que-se-passe-t-il-si-je-conteste-la-valeur-de-reprise-de-mes-articles-.html","/aide/53_comment-beneficier-de-mes-gains-.html","/aide/54_dois-je-attendre-que-mes-vetements-soient-vendus-sur-le-site-de-roseindigo-pour-percevoir-mes-gains-.html","/aide/55_puis-je-utiliser-mes-gains-sur-roseindigocom-.html","/aide/56_si-je-choisis-de-recevoir-un-cheque-quand-vais-je-le-recevoir-.html","/aide/11_comment-sais-je-la-qualite-des-vetements-que-jachete-.html","/aide/12_que-signifie-bon-etat.html","/aide/13_que-signifie-neuf-avec-etiquette-.html","/aide/14_que-signifie-quun-article-nest-plus-disponible-.html","/aide/15_lorsquun-vetement-presente-une-etiquette-avec-plusieurs-tailles-laquelle-indiquez-vous-.html","/aide/16_a-quel-rythme-mettez-vous-des-nouveaux-articles-en-ligne-.html","/aide/19_est-ce-quun-article-mis-dans-mon-panier-mest-reserve-.html","/aide/22_puis-je-modifier-ou-annuler-une-commande-validee-.html","/aide/4_comment-fonctionnons-nous-.html","/aide/51_je-viens-de-connaitre-mon-gain-pourquoi-navez-vous-pas-rachete-tous-mes-vetements-.html","/aide/5_pourquoi-dois-je-creer-un-compte-client-.html","/aide/6_comment-puis-je-modifier-les-informations-de-mon-compte-.html","/aide/7_que-dois-je-faire-si-jai-oublie-mon-mot-de-passe-.html","/aide/8_que-dois-je-faire-si-je-souhaite-modifier-mon-mot-de-passe-.html","/aide/17_sous-quel-delai-vais-je-etre-livre-.html","/aide/18_quels-sont-vos-couts-de-livraison-.html","/aide/20_quest-ce-quun-article-cadeau-.html","/aide/21_que-se-passe-t-il-si-je-nai-pas-recu-ma-commande-.html","/aide/23_puis-je-etre-livree-en-dehors-de-la-france-.html","/aide/24_puis-je-retourner-un-article-qui-ne-me-convient-pas-.html","/aide/25_comment-proceder-pour-retourner-un-article-.html","/aide/26_dois-je-payer-les-frais-dexpedition-de-retour-.html","/aide/27_quand-et-comment-vais-je-recevoir-mon-remboursement-.html","/aide/28_sous-quels-delais-dois-je-vous-retourner-un-article-.html","/aide/10_comment-nous-contacter-.html","/aide/9_comment-fonctionne-le-programme-de-parrainage-.html","/aide/57_quest-ce-que-lassurance-retour-.html","/aide/59_que-se-passe-t-il-si-mon-sac-est-egare.html");
foreach ($aide as &$path) {

    $sitemap->addItem($path, '0.5', 'daily', 'Today');
    echo "AIDE: $path<br />\n";
}













$sitemap->createSitemapIndex('http://www.roseindigo.com/', 'Today');

