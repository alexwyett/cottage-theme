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

echo sprintf(
    '<div class="cottage-row media">
        <a href="%s" class="pull-left">
            <img src="%s" class="media-object">
        </a>
        <div class="media-body">
            <h4 class="media-heading">%s</h4>
            <p>%s</p>
            <p>Sleeps: %s | Bedrooms: %s</p>
            %s
        </div>
    </div>',
    $wpTabsApi->getCottagePermalink($property),
    WpTabsApi__getImageCache($property->getPropRef(), $mainImage, 'tocc', 175, 175),
    $property->getName(),
    $property->getAvailabilityDescription(),
    $property->getAccommodates(),
    $property->getBedrooms(),
    $shortlistLink
);