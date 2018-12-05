<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2018 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Clark Seanor <clarkseanor@gmail.com>
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Canada.
 */
class Canada extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    const ID = 'CA';

    /**
     * Initialize holidays for Canada.
     *
     * @throws \Yasumi\Exception\InvalidDateException
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize()
    {
        $this->timezone = 'America/Toronto';

        /*
         * Nationwide Holidays
         */
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        /**
         * Canada Day.
         *
         * Canada Day is the national day of Canada. A proclamation was signed in 1868 requesting Canadians to celebrate
         * it. It was instated in 1879 as 'the anniversary of Confederation' (later known as Dominion Day) and
         * officially became Canada Day in October 1982.
         *
         * In Newfoundland and Labrador, Memorial Day (provincial holiday) is observed concurrently.
         *
         * https://www.canada.ca/en/canadian-heritage/services/canada-day-history.html
         * https://en.wikipedia.org/wiki/Canada_Day
         */

        if ($this->year >= 1868 && $this->year <= 1879) {
            $this->addHoliday(new Holiday('anniversaryOfConfederation', [
                'fr_CA' => 'Jour Anniversaire de la Confédération',
                'en_CA' => 'Anniversary of Confederation',
                'en_US' => 'Anniversary of Confederation'
            ], new DateTime("$this->year-7-1", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE));
        } else if ($this->year > 1879 && $this->year <= 1982) {
            $this->addHoliday(new Holiday('dominionDay', [
                'fr_CA' => 'Fête du Dominion',
                'en_CA' => 'Dominion Day',
                'en_US' => 'Dominion Day'
            ], new DateTime("$this->year-7-1", new DateTimeZone($this->timezone)), $this->locale));
        } else if ($this->year > 1982) {
            $this->addHoliday(new Holiday('canadaDay', [
                'fr_CA' => 'Fête du Canada',
                'en_CA' => 'Canada Day',
                'en_US' => 'Canada Day'
            ], new DateTime("$this->year-7-1", new DateTimeZone($this->timezone)), $this->locale));
        }

        /**
         * Labour Day.
         *
         * Labour Day in Canada is held on the first Monday of September.
         * It is an annual holiday to celebrate the achievements of workers.
         * https://en.wikipedia.org/wiki/Labour_Day#Canada
         */
        if ($this->year >= 1894) {
            $this->addHoliday(new Holiday('labourDay', [
                'fr_CA' => 'Fête du travail',
                'en_CA' => 'Labour Day',
                'en_US' => 'Labour Day'
            ], new DateTime("first monday of september $this->year", new DateTimeZone($this->timezone)), $this->locale));
        }

        /*
         * Holidays for federal employees
         */

        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));


        /**
         * Thanksgiving.
         *
         * Thanksgiving is a holiday that celebrates the harvest and blessings of the past year.
         * Thanksgiving has been officially celebrated on the second Monday in October since January 31, 1957. It became
         * a statutory holiday on November 6, 1879, but had no fixed date, falling mostly on the third Monday of October.
         * It was observed prior to this, however was not a statutory holiday.
         * https://en.wikipedia.org/wiki/Thanksgiving_(Canada)
         */

        if ($this->year > 1879 && $this->year < 1957) {
            $this->addHoliday(new Holiday( 'thanksgiving', [
                'fr_CA' => 'Action de grâce',
                'en_CA' => 'Thanksgiving',
                'en_US' => 'Thanksgiving'
            ], new DateTime("third monday of october $this->year", $this->timezone, $this->locale, Holiday::TYPE_BANK)));
        } else if ($this->year >= 1957) {
            $this->addHoliday(new Holiday( 'thanksgiving', [
                'fr_CA' => 'Action de grâce',
                'en_CA' => 'Thanksgiving',
                'en_US' => 'Thanksgiving'
            ], new DateTime("second monday of october $this->year", $this->timezone, $this->locale, Holiday::TYPE_BANK)));
        }

        /**
         * Victoria Day.
         *
         * Victoria Day commemorates Queen Victoria's birthday. The current date of Victoria Day, the Monday before
         * May 25, was set to begin in 1953. For other dates, see the below links.
         *
         * King Edward VII died on 6 May 1910.
         * King George V died on 20 January 1936.
         * King Edward VIII abdicated on 11 December 1936.
         * King George V died on 6 February 1952.
         * In 1953, the date of Victoria Day was set.
         *
         * https://www.canada.ca/en/canadian-heritage/services/important-commemorative-days/victoria-day.html
         * https://en.wikipedia.org/wiki/Victoria_Day
         */

        $sovereignBirthdayTranslations = [
            'fr_CA' => 'Fête du souverain',
            'en_CA' => 'Sovereign\'s Birthday',
            'en_US' => 'Sovereign\'s Birthday'
        ];

        $victoriaDayTranslations = [
            'fr_CA' => 'Jour de Victoria',
            'en_CA' => 'Victoria Day',
            'en_US' => 'Victoria Day'
        ];

        if ($this->year >= 1837 && $this->year < 1845) {  // Queen Victoria's reign, unofficially observed

        } else if ($this->year >= 1845 && $this->year < 1867) {  // Queen Victoria's reign, unofficially observed

        } else if ($this->year >= 1867 && $this->year < 1901) {  // Queen Victoria's reign, unofficially observed

        } else if ($this->year >= 1901 && $this->year < 1910) {  // Queen Victoria's reign, unofficially observed

        } else if ($this->year >= 1910 && $this->year < 1936) {  // Queen Victoria's reign, unofficially observed

        } else if ($this->year = 1936) {

        } else if ($this->year = 1943) {

        }



        /*
         * Observed holidays
         */
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));


    }
}
