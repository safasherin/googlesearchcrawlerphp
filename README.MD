# safasherinsulaiman/searchengine

Utility class for scraping google search results. It can work as a stand alone component. 

## installation

You can add this library as a local, per-project dependency to your project using [Composer](https://getcomposer.org/):

```
composer require safasherinsulaiman/searchengine:dev-main
```

## Usage
Basic Usage shown in code below.  Current setup has been tested on "uae" and "us" regions. 
#### Please note that scraping google is againts its ToS. If you attempt to run more than 10 queries per hour, your IP will be blocked by google -  usually for about 24 hours.

```
<?php
require __DIR__ . '/vendor/autoload.php';
use Safasherinsulaiman\Searchengine\Searchengine;

echo "Starting up!!!.........";
echo "<br><br>";

$client = new Searchengine();
// currently tested on region "uae" and "us"
$client->setEngine("uae");
// Enter the search query as a array of words
// search returns an ArrayIterator Object
$results = $client->search(["flowers","delivery"]);

foreach($results as $result){
    echo json_encode($result);
    echo "<br>";
    echo "<br>";

}
echo "<br><br>";
echo ".........END OF LIST.........";
?>
```

The code above yields the output below:
```
Starting up!!!.........

{"rank":1,"keyword":"flowers delivery ","url":"https:\/\/www.800flower.ae\/","title":"800Flowers - Same day Delivery - Online Flower Delivery Dubai","desc":"\"Wow\" Loved Ones From Only AED 95. Enjoy Same Day Express Flower Delivery. Top Choice for Online Flower Delivery. Freshly Cut Flowers for any occasion. Delivery within UAE.","promoted":true}

{"rank":2,"keyword":"flowers delivery ","url":"https:\/\/www.fnp.ae\/","title":"Send Flowers Online - Same Day Flowers Delivery","desc":"Send Flowers Online - Same Day Flowers DeliveryAd\u00b7https:\/\/www.fnp.ae\/Ad\u00b7https:\/\/www.fnp.ae\/ ","promoted":true}

{"rank":3,"keyword":"flowers delivery ","url":"https:\/\/www.bloomingbox.com\/","title":"Same Day Delivery | Order Flowers Online","desc":"Assortments starting at AED 120. Flowers sourced daily with guaranteed freshness. A variety of the most trending flowers and roses. Same Delivery all over UAE. Treats-Bundles-Cakes.","promoted":true}

{"rank":4,"keyword":"flowers delivery ","url":"https:\/\/www.buyanyflowers.com\/","title":"Flowers Starts with 79 AED - Free Same Day Delivery in 1 Hr","desc":"One Stop Shop for All Your Flowers Need-Bouquets, Vase Arrangements, & Basket Arrangements","promoted":true}

{"rank":5,"keyword":"flowers delivery ","url":"https:\/\/www.fnp.ae\/","title":"Flower Delivery Dubai, Online Flower Shop, #1 Florist UAE ...","desc":"FNP is a leading Flower Shop for 24*7 Online Flower Delivery in Dubai & across UAE. Send fresh flowers with same day, 1 Hour and midnight delivery options.","promoted":false}

{"rank":6,"keyword":"flowers delivery ","url":"https:\/\/www.flowers.ae\/","title":"Flower Delivery Dubai | Flower Shop Dubai | Florist Dubai","desc":"FNP is a leading Flower Shop for 24*7 Online Flower Delivery in Dubai & across UAE. Send fresh flowers with same day, 1 Hour and midnight delivery options.","promoted":false}

......truncated

{"rank":54,"keyword":"flowers delivery ","url":"https:\/\/www.theflowershop.ae\/","title":"Same-Day Delivery From AED 99 - Flowershop.ae\u00ae","desc":"Beautiful Flower Arrangements with 100% Satisfaction! Fresh Flowers Hand-Delivered in UAE. Trusted By 200,000+ Happy Customers. Order Now & Enjoy Same-Day Delivery to Dubai, UAE. Earn Rewards Points. Guaranteed Delivery. Trusted By Over 200,000.","promoted":true}

{"rank":55,"keyword":"flowers delivery ","url":"https:\/\/www.urbanblooms.ae\/","title":"Urban Blooms - Free Delivery Today","desc":"Send Flowers For Any Occasions. Enjoy Same Day 1 Hr Free Delivery. Choose From Variety of Flowers All Over Dubai.","promoted":true}



.........END OF LIST.........

```

