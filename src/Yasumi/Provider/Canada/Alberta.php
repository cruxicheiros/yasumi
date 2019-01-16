<?php
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2019 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 * @author Clark Seanor <clarkseanor@gmail.com>
 */

namespace Yasumi\Provider\Canada;

use DateInterval;
use DateTime;
use DateTimeZone;
use Yasumi\Holiday;
use Yasumi\Provider\Canada;

/**
 * Provider for all holidays in Australian Capital Territory (Australia).
 *
 */
class Alberta extends Canada
{
    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or sub-region.
     */
    public const ID = 'CA-AB';

    public $timezone = 'Canada/Alberta';

    /**
     * Initialize holidays for Alberta (Canada).
     *
     * @throws \InvalidArgumentException
     * @throws \Yasumi\Exception\UnknownLocaleException
     * @throws \Exception
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->addHoliday(new Holiday('Alberta Family Day', [
            'fr_CA' => 'Jour de la famille Alberta',
            'en_CA' => 'Alberta Family Day',
            'en_US' => 'Alberta Family Day'
        ], new DateTime("third monday of february", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));


        /**
         * Thanksgiving is a general holiday in Alberta.
         */

        $this->addHoliday(new Holiday( 'thanksgiving', [
            'fr_CA' => 'Action de grâce',
            'en_CA' => 'Thanksgiving',
            'en_US' => 'Thanksgiving'
        ], new DateTime("second monday of october $this->year", $this->timezone)), $this->locale);


        /**
         * Victoria Day is a general holiday in Alberta.
         */

        $this->addHoliday(new Holiday('victoriaDay', [
            'fr_CA' => 'La Fête de Victoria',
            'en_CA' => 'Victoria Day',
            'en_US' => 'Victoria Day'
        ], new DateTime("previous monday may 25 $this->year", new DateTimeZone($this->timezone)), $this->locale));


        /**
         * Remembrance Day is a general holiday in Alberta.
         */

        $this->addHoliday(new Holiday('Remembrance Day', [
            'fr_CA' => 'Jour du Souvenir',
            'en_CA' => 'Remembrance Day',
            'en_US' => 'Remembrance Day'
        ], new DateTime("$this->year-11-11", new DateTimeZone($this->timezone)), $this->locale));


        /**
         * August Civic Holiday is known as Heritage Day in Alberta.
         */

        $this->removeHoliday("augustCivicHoliday");

        $this->addHoliday(new Holiday('heritageDay', [
            'fr_CA' => 'Jour d\'héritage',
            'en_CA' => 'Heritage Day',
            'en_US' => 'Heritage Day'
        ], new DateTime("first monday of august $this->year", new DateTimeZone($this->timezone)), $this->locale, Holiday::TYPE_BANK));

    }
}
