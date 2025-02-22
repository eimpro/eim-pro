<?php
// Filter images for the current product
$images = array_filter($product_images, function($image) use ($product) {
    return $image['ProductID'] == $product['ID'];
});

if (!empty($images)) {
    // Generate carousel for images
    // Use unique carousel ID for each product
    $carousel_id = 'carouselExampleIndicators' . $product['ID'];
    echo '<div id="' . htmlspecialchars($carousel_id) . '" class="carousel slide">';
    echo '<div class="carousel-inner">';

    foreach($images as $index => $image) {
      // Display each image in the carousel
      echo '<div class="carousel-item ' . ($index === 0 ? 'active' : '') . '">';
      echo '<a href="' . htmlspecialchars('adm/' . $image['ImageURL']) . '" data-fancybox="' . htmlspecialchars($product['Name']) . '">';
      echo '<img src="' . htmlspecialchars('adm/' . $image['ImageURL']) . '" class="d-block w-100" alt="Product Image" style="height:200px; object-fit:cover;">';
      echo '</a>';
      echo '</div>';
    }

    // Carousel controls
    echo '</div>';
    echo '<button class="carousel-control-prev" type="button" data-bs-target="#' . htmlspecialchars($carousel_id) . '" data-bs-slide="prev">';
    echo '<span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>';
    echo '<span class="visually-hidden">Previous</span>';
    echo '</button>';
    echo '<button class="carousel-control-next" type="button" data-bs-target="#' . htmlspecialchars($carousel_id) . '" data-bs-slide="next">';
    echo '<span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>';
    echo '<span class="visually-hidden">Next</span>';
    echo '</button>';
    echo '</div>';
}
?>

