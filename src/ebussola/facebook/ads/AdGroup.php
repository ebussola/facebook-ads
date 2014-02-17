<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:28
 */

namespace ebussola\facebook\ads;

/**
 * Class AdGroup aka Ad
 * @package ebussola\facebook\ads
 * @see https://developers.facebook.com/docs/reference/ads-api/adgroup/#read
 *
 * @property string         $id
 * @property string         $name
 * @property string         $account_id
 * @property string         $campaign_id
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

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_DELETED = 'DELETED';
    const STATUS_PENDING_REVIEW = 'PENDING_REVIEW';
    const STATUS_DISAPPROVED = 'DISAPPROVED';
    const STATUS_PENDING_BILLING_INFO = 'PENDING_BILLING_INFO';
    const STATUS_CAMPAIGN_PAUSED = 'CAMPAIGN_PAUSED';
    const STATUS_ADGROUP_PAUSED = 'ADGROUP_PAUSED';
    const STATUS_CAMPAIGN_GROUP_PAUSED = 'CAMPAIGN_GROUP_PAUSED';

    const BID_TYPE_CPC = 'CPC';
    const BID_TYPE_CPM = 'CPM';
    const BID_TYPE_MULTI_PREMIUM = 'MULTI_PREMIUM';
    const BID_TYPE_ABSOLUTE_OCPM = 'ABSOLUTE_OCPM';
    const BID_TYPE_CPA = 'CPA';

}