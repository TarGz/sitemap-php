<?

include 'Sitemap.php';
include '../config/settings.inc.php';
$sitemap = new Sitemap('http://www.roseindigo.com');
$sitemap->setPath('maps/');	
// $sitemap->addItem('/filles/naissance', '1.0', 'daily', 'Today');
$sitemap->setFilename('products');


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
    printf("Default database is %s.\n", $row[0]);
    $result->close();
}
echo "<br/>";

$sql = "SELECT * FROM  ps_product LIMIT 0 , 50000 ";
//SELECT ps_product.* FROM LEFT JOIN ps_stock_available on  WHERE  ps_stock_available.quantity IS NO NULL
print_r($sql);
echo "<br/>";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	// 89946746
    	
    	// $sql_quantity = "SELECT `quantity` FROM `ps_stock_available` WHERE `id_product` LIKE ".$row["id_product"];
    	// $result_quantity = $conn->query($sql);
    	// print_r($result_quantity);
        $product_url =  "/unecategorie/" . $row["id_product"]. "-nomduproduit.html";

        $sitemap->addItem($product_url, '0.5', 'daily', 'Today');
    }
} else {
    echo "0 results<br/>";
}
$conn->close();



$sitemap->createSitemapIndex('http://www.roseindigo.com/', 'Today');
