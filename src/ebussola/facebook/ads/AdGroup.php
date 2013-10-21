<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:28
 */

namespace ebussola\facebook\ads;

/**
 * Class AdGroup
 * @package ebussola\facebook\ads
 * @see https://developers.facebook.com/docs/reference/ads-api/adgroup/#read
 *
 * @property string         $id
 * @property string         $name
 * @property string         $account_id
 * @property string         $created_time
 * @property \stdClass      $targeting
 * @property int[]          $tracking_specs #see https://developers.facebook.com/docs/reference/ads-api/tracking-specs/
 * @property \stdClass      $bid_info
 * @property string         $bid_type
 * @property int[]          $creative_ids
 * @property array          $conversion_specs
 * @property string         $adgroup_status
 * @property string         $updated_time
 */
interface AdGroup {

}