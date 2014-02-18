<?php

$mainImage = $property->getMainImage();
if ($mainImage) {
    $mainImage = $mainImage->getFilename();
} else {
    $mainImage = '';
}

$shortlistLink = sprintf(
    '<p><a href="%s" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add to shortlist</a></p>',
    $wpTabsApi->getCottagePermalink($property, 'shortlist')
);
if ($property->isOnShortlist()) {
    $shortlistLink = sprintf(
        '<p><a href="%s" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span> Remove from shortlist</a></p>',
        $wpTabsApi->getCottagePermalink($property, 'shortlist')
    );
}

?>
<article class="entry-header cottage-summary row">
    <div class="main-image col-xs-12 col-sm-3 col-md-3">
        <img src="<?php echo WpTabsApi__getImageCache($property->getPropRef(), $mainImage, 'tocc', 200, 175); ?>" alt="<?php the_title(); ?>" class="img-responsive">
    </div>
    <div class="summary col-xs-12 col-sm-9 col-md-9">
        <h2 class="entry-title">
            <?php the_title(); ?>
        </h2>
        <h3>Sleeps: <?php echo $property->getAccommodates(); ?></h3>
        <h4>Bedrooms: <?php echo $property->getBedrooms(); ?></h4>
        <p><?php echo $property->getAvailabilityDescription(); ?></p>
        <p><?php echo $shortlistLink; ?></p>
    </div>
</article>