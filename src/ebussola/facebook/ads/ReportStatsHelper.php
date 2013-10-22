<?php
/**
 * Created by JetBrains PhpStorm.
 * User: usuario
 * Date: 22/10/13
 * Time: 10:23
 */

namespace ebussola\facebook\ads;


class ReportStatsHelper {

    /**
     * @param string $field
     * Any possible field
     * @see https://developers.facebook.com/docs/reference/ads-api/adreportstats/#columns
     *
     * @param string $type
     * Possible values: "in", ">", "<" or "contains"
     *
     * @param string | array $value
     * If $type is "in" an array should be set
     *
     * @see https://developers.facebook.com/docs/reference/ads-api/adreportstats/#columns
     */
    static public function createFilter($field, $type, $value) {
        return array(
            'field' => $field,
            'type'  => $type,
            'value' => $value
        );
    }

    /**
     * Creates a single period TimeRange
     *
     * @param \DateTime $date_start
     * @param \DateTime $date_end
     *
     * @return array
     */
    static public function createPeriodTimeRange(\DateTime $date_start, \DateTime $date_end) {
        return array(
            array(
                'day_start' => array(
                    'day' => $date_start->format('d'),
                    'month' => $date_start->format('m'),
                    'year' => $date_start->format('Y')
                ),
                'day_stop' => array(
                    'day' => $date_end->format('d'),
                    'month' => $date_end->format('m'),
                    'year' => $date_end->format('Y')
                )
            )
        );
    }

    /**
     * Creates a set of TimeRanges day by day
     *
     * @param \DateTime $date_start
     * @param \DateTime $date_end
     *
     * @return array
     */
    static public function createDailyTimeRange(\DateTime $date_start, \DateTime $date_end) {
        $dates = new \DatePeriod($date_start, new \DateInterval('P1D'), $date_end);
        $time_ranges = [];
        /** @var \DateTime $date */
        foreach ($dates as $date) {
            $time_ranges[] = [
                'time_start' => $date->setTime(0, 0, 0)->getTimestamp(),
                'time_stop' => $date->add(new \DateInterval('P1D'))->getTimestamp()
            ];
        }

        return $time_ranges;
    }

}