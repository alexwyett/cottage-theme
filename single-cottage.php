<?php
/**
 * The Template for displaying all single cottage posts
 */
  
// Queue property css and javascript.  Again these are just
// example asset files but could be used as a basis for your
// theme.

add_action(
    "wp_enqueue_scripts", 
    function () {
        WPTabsApiAdmin::enqueueJs(
            WPTABSAPIPLUGINNAME . 'jQuery.availabilityCalendar.js',
            'jQuery.availabilityCalendar.js'
        );
        WPTabsApiAdmin::enqueueJs(
            WPTABSAPIPLUGINNAME . 'property.js',
            'property.js'
        );

        wp_deregister_script('jquery');
        wp_register_script(
            'jquery', 
            '//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js',
            false,
            null
        );
        wp_enqueue_script('jquery');
    }, 
    11
);
    
// We'll need these links to build our availability calendar form
$bookingUrl = WpTabsApi__getEndPointPermalink($post->ID, 'booking/create');

// Wordpress header.  All of the wordpress functions can be used here just like
// any other wordpress template.
get_header(); ?>
        
<!-- Inner wrapper for bevel -->
<div class="wrapper-inner inner">
    <div class="main-body">
    
<?php

// Wordpress loop which includes the property object from the tabs api
require_once 'cottage-loop.php';

?>

    </div>
                    
<!-- Property Calendar -->
<div class="property-calendar">

    <div class="row">
        <div class="col-xs-6"> 
            <form class="form col-xs-3 affix affix-top" id="enquiry-form" data-enquiry-url="<?php echo site_url('wp-admin/admin-ajax.php'); ?>" action="<?php echo $bookingUrl; ?>" method="post">
                <!-- Hidden variables -->
                <input name="action" value="enquiry" type="hidden">
                <input id="fromDate" name="fromDate" type="hidden">
                <input id="toDate" name="toDate" type="hidden">
                <input name="propRef" type="hidden" value="<?php echo $property->getPropref(); ?>">
                <input name="brandCode" type="hidden" value="<?php echo $property->getBrandcode(); ?>">
                <!-- /Hidden variables -->
                
                <fieldset>
                    <legend>Your Holiday</legend>
                    <div class="form-group col-xs-6">
                        <label for="nights">Number of Nights:</label>
                        <select id="nights" name="nights" class="form-control">
        <?php 
        foreach (range(2, 28) as $r) {
            echo sprintf(
                '<option value="%s"%s>%s nights</option>',
                $r,
                (($r == 7) ? ' selected' : ''),
                $r
            );
        }
        ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="adults">Adults:</label>
                        <select id="adults" name="adults" class="form-control">
        <?php 
        foreach (range(1, $property->getAccommodates()) as $r) {
            echo sprintf(
                '<option value="%s">%s</option>',
                $r,
                $r
            );
        }
        ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="children">Children: <small>(3 to 17yrs)</small></label>
                        <select id="children" name="children" class="form-control">
                            <option value="0">0</option>
        <?php 
        foreach (range(1, $property->getAccommodates()) as $r) {
            echo sprintf(
                '<option value="%s">%s</option>',
                $r,
                $r
            );
        }
        ?>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="infants">Infants: <span>(Under 2yrs)</span></label>
                        <select id="infants" name="infants" class="form-control">
                            <option value="0">0</option>
            <?php 
            foreach (range(1, $property->getAccommodates()) as $r) {
                echo sprintf(
                    '<option value="%s">%s</option>',
                    $r,
                    $r
                );
            }
            ?>
                        </select>
                    </div>
            <?php
            if ($property->hasPets()) {
                ?>
                    <div class="form-group col-xs-6">
                        <label for="pets">Pets:</label>
                        <select id="pets" name="pets" class="form-control">
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                <?php
            }
            ?>
                    <div class="form-group col-xs-12">
                        <p id="booking-summary" class="bg-info">
                            Please select a date from the calendar below to start your booking.
                        </p>
                        <div class="booking-cta">
                            <button class="submit btn btn-primary" id="booknow" disabled="disabled">Book Now</button>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset class="booking-section">
                    <div class="inner">
                        <!-- Extra Breakdown -->
                        <div id="bookingExtras" class="bookingExtras"></div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="calendarContainer" class="col-xs-6">
                
    <?php
    $pointer = 0;
    foreach (array(date('Y'), (date('Y')+1)) as $year) {
        for ($month = 1; $month <= 12; $month++) {
            $monthTime = mktime(0, 0, 0, $month, 1, $year);
            if ($monthTime >= mktime(0, 0, 0, date('m'), 1, date('Y'))) {
                echo $property->getCalendarWidget(
                    $monthTime,
                    array(
                        'start_day' => strtolower(
                            $property->getChangeOverDay()
                        ),
                        'attributes' => 'class="wp-tabs-api-calendar table table-condensed table-bordered"',
                        'sevenRows' => true
                    )
                );

                $pointer++;
            }
        }
    }
    ?>
                
        </div>
    </div>
</div>
<!-- /Property Calendar -->

<?php get_footer(); ?>