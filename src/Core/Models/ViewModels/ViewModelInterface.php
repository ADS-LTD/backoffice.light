<?php

namespace Digitalis\Core\Models\ViewModels;

/**
 *
 * @copyright  2016 ADS LTD http://www.adsyst-secure.com
 * @license    Intellectual property rights of ADS LTD
 * @version    Release: 1.0 
 */
interface ViewModelInterface
{
    public function toArray();
    public function convertToEntity();
    public static function buildFromEntity($entitySource = null);
}
