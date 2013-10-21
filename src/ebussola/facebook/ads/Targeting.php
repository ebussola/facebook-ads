<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 21/10/13
 * Time: 16:49
 */

namespace ebussola\facebook\ads;

/**
 * Class Targeting
 * @package ebussola\facebook\ads
 *
 * Demographics and events
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#demographics
 * @property int[] $genders
 * @property int   $age_min
 * @property int   $age_max
 *
 * Location
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#location
 * @property string[] $countries
 * @property int[]    $cities
 * @property int[]    $regions
 * @property string[] $zips
 *
 * Interest and Broad Category Targeting
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#likes_and_interests
 * @property array $user_adclusters
 * @property array $excluded_user_adclusters
 * @property array $keywords
 *
 * Mobile
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#mobile
 * @property array $user_os
 * @property array $user_device
 * @property array $wireless_carrier
 * @property array $site_category
 *
 * Facebook connections
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#facebook_connections
 * @property array $connections
 * @property array $excluded_connections
 * @property array $friends_of_connections
 *
 * Education and workplace
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#education_and_workplace
 * @property array $college_networks
 * @property array $work_networks
 * @property array $education_statuses
 * @property array $college_years
 * @property array $college_majors
 *
 * Placement
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#placement
 * @property array $page_types
 *
 * Additional Targeting
 * @see https://developers.facebook.com/docs/reference/ads-api/targeting-specs/#additional
 * @property array $relationship_statuses
 * @property array $interested_in
 * @property array $locales
 * @property array $zips
 */
interface Targeting {

}