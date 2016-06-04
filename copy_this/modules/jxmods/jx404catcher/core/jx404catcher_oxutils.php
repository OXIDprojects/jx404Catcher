<?php
/*
 *    This file is part of the module jx404Catcher for OXID eShop Community Edition.
 *
 *    The module jx404Catcher for OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    The module jx404Catcher for OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      https://github.com/job963/jx404Catcher
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @copyright (C) Joachim Barthel 2016
 *
 */
class jx404catcher_oxutils extends jx404catcher_oxutils_parent
{
    /**
     * handler for 404 (page not found) error
     *
     * @param string $sUrl url which was given, can be not specified in some cases
     *
     * @return void
     */
    public function handlePageNotFoundError($sUrl = '')
    {
        $sJxId = oxUtilsObject::getInstance()->generateUID();

        $oDb = oxDb::getDb();
        $sSql = "INSERT INTO jx404catches (jxid, jx404url, jxcounts, jxinsert) VALUES ('{$sJxId}', '{$sUrl}', 1, NOW()) "
                . "ON DUPLICATE KEY UPDATE jxcounts=jxcounts+1, jxtimestamp=NOW() ";
        $ret = $oDb->Execute($sSql);


        // Call origin function
        parent::handlePageNotFoundError($sUrl = '');
    }

}
