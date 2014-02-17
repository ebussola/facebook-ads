<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 18/10/13
 * Time: 11:28
 */

namespace ebussola\facebook\ads;

/**
 * Class Campaign
 * @package ebussola\facebook\ads
 *
 * @property string $id
 * @property string $campaign_group_id
 * @property int    $daily_budget
 * @property int    $lifetime_budget
 * @property string $account_id
 * @property string $name
 * @property string $start_time
 * @property string $created_time
 * @property string $campaign_status
 * @property int    $budget_remaining
 * @property string $end_time
 * @property string $updated_time
 */
interface AdSet {

    const STATUS_ACTIVE = 1;
    const STATUS_PAUSED = 2;
    const STATUS_DELETED = 3;
    const STATUS_CAMPAIGN_GROUP_PAUSED = 10;

}