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
 *
 * Please note that this provider is not historically accurate and should not be used to definitively
 * find dates of holidays that happened in the past.
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
         * Canada Day is observed on July 1, unless that date falls on a Sunday, in which case July 2 is substituted.
         *
         * https://www.canada.ca/en/canadian-heritage/services/canada-day-history.html
         * https://en.wikipedia.org/wiki/Canada_Day
         */

        $this->addHoliday($this->calculateCanadaDay());


        /**
         * Labour Day.
         *
         * Labour Day in Canada is held on the first Monday of September. It was instituted in 1894.
         * It is an annual holiday to celebrate the achievements of workers.
         * https://en.wikipedia.org/wiki/Labour_Day#Canada
         */

        $this->addHoliday(new Holiday('labourDay', [
            'fr_CA' => 'Fête du travail',
            'en_CA' => 'Labour Day',
            'en_US' => 'Labour Day'
        ], new DateTime("first monday of september $this->year", new DateTimeZone($this->timezone)), $this->locale));


        /*
         * Holidays for federal employees
         *
         * Some holidays are mandatory for employees of the federal government but not others.
         */

        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));
        $this->addHoliday($this->secondChristmasDay($this->year, $this->timezone, $this->locale, Holiday::TYPE_BANK));


        /**
         * Remembrance Day.
         *
         * Remembrance Day is a day commemorating the end of World War 1. It serves to commemorate fallen soldiers.
         * https://en.wikipedia.org/wiki/Remembrance_Day#Canada
         */

        $this->addHoliday(new Holiday('Remembrance Day', [
            'fr_CA' => 'Jour du Souvenir',
            'en_CA' => 'Remembrance Day',
            'en_US' => 'Remembrance Day'
        ], new DateTime("$this->year-11-11", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));


        /**
         * Thanksgiving.
         *
         * Thanksgiving is a holiday that celebrates the harvest and blessings of the past year.
         * Thanksgiving has been officially celebrated on the second Monday in October since January 31, 1957. It became
         * a statutory holiday on November 6, 1879, but had no fixed date, falling mostly on the third Monday of October.
         * It was observed prior to this, however was not a statutory holiday.
         * https://en.wikipedia.org/wiki/Thanksgiving_(Canada)
         */

        $this->addHoliday(new Holiday( 'thanksgiving', [
            'fr_CA' => 'Action de grâce',
            'en_CA' => 'Thanksgiving',
            'en_US' => 'Thanksgiving'
        ], new DateTime("second monday of october $this->year", $this->timezone)), $this->locale, Holiday::TYPE_BANK);


        /**
         * Victoria Day.
         *
         * Victoria Day commemorates Queen Victoria's birthday. The current date of Victoria Day, the Monday before
         * May 25, was set to begin in 1953, and coincides with the celebration of the sovereign's birthday.
         *
         * https://www.canada.ca/en/canadian-heritage/services/important-commemorative-days/victoria-day.html
         * https://en.wikipedia.org/wiki/Victoria_Day
         */

        $this->addHoliday(new Holiday('sovereignsBirthday', [
            'fr_CA' => 'Fête du souverain',
            'en_CA' => 'Sovereign\'s Birthday',
            'en_US' => 'Sovereign\'s Birthday'
        ], new DateTime("previous monday may 25 $this->year", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_OBSERVANCE));

        $this->addHoliday(new Holiday('victoriaDay', [
            'fr_CA' => 'La Fête de Victoria',
            'en_CA' => 'Victoria Day',
            'en_US' => 'Victoria Day'
        ], new DateTime("previous monday may 25 $this->year", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));


        /**
         * August Civic Holiday.
         * https://en.wikipedia.org/wiki/Civic_Holiday
         */

        $this->addHoliday(new Holiday('augustCivicHoliday', [
            'fr_CA' => 'Premier lundi d\'août',
            'en_CA' => 'Civic Holiday',
            'en_US' => 'Civic Holiday'
        ], new DateTime("first monday of august $this->year", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));

        /*
         * Observed holidays
         */
        $this->addHoliday($this->easter($this->year, $this->timezone, $this->locale, Holiday::TYPE_OBSERVANCE));
    }

    /**
     * @return Holiday
     * @throws \Exception
     */
    public function calculateCanadaDay()
    {
        $date = new DateTime("01-07-$this->year", new DateTimeZone($this->timezone));

        if ($date->format('w') == 0) {  // If the date falls on a Sunday
            $date = new DateTime("02-07-$this->year");
        }

        return new Holiday('canadaDay', [
            'fr_CA' => 'Fête du Canada',
            'en_CA' => 'Canada Day',
            'en_US' => 'Canada Day'
        ], $date, $this->locale);
    }
}
