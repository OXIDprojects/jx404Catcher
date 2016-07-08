<?php
/**
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
 * @copyright (C) 2016 Joachim Barthel
 * @author    Joachim Barthel <jobarthel@gmail.com>
 *
 */

class jx404catcher_list extends oxAdminDetails {

    protected $_sThisTemplate = "jx404catcher_list.tpl";

    /**
     * Displays the latest admin log entries as full report
     */
    public function render() 
    {
        parent::render();

        $myConfig = oxRegistry::getConfig();
        
        /*if ($myConfig->getBaseShopId() == 'oxbaseshop') {
            // CE or PE shop
            $sWhereShopId = "";
        } else {
            // EE shop
            $sWhereShopId = "AND l.oxshopid = {$myConfig->getBaseShopId()} ";
        }*/
        
        $oDb = oxDb::getDb( oxDB::FETCH_MODE_ASSOC );

        /*$sSql = "SELECT c.jxid, c.jx404url, c.jxcount, c.jxinsert, c.jxtimestamp, s.oxstdurl "
                . "FROM jx404catches c "
                . "LEFT JOIN oxseo s ON (c.jx404url = s.oxseourl) "
                . "ORDER BY c.jx404url ";*/
        
        $sSql = "SELECT c.jxid, c.jx404url, c.jxcount, c.jxinsert, c.jxtimestamp, h.oxident, s.oxseourl, s.oxobjectid "
                . "FROM jx404catches c "
                . "LEFT JOIN oxseohistory h ON (MD5(LOWER(c.jx404url)) = h.oxident) "
                . "LEFT JOIN oxseo s ON h.oxobjectid = s.oxobjectid "
                . "ORDER BY c.jx404url ";
        
        try {
            $rs = $oDb->Select($sSql);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
        
        $a404Urls = array();
        if ($rs) {
            while (!$rs->EOF) {
                array_push($a404Urls, $rs->fields);
                $rs->MoveNext();
            }
        }
        
        $this->_aViewData["a404Urls"] = $a404Urls;
        
        $this->_aViewData["sShopUrl"] = $myConfig->getShopURL();

        $oModule = oxNew('oxModule');
        $oModule->load('jx404catcher');
        $this->_aViewData["sModuleId"] = $oModule->getId();
        $this->_aViewData["sModuleVersion"] = $oModule->getInfo('version');

        return $this->_sThisTemplate;
    }
    
    
    public function saveNewSeoUrls()
    {
        $myConfig = oxRegistry::getConfig();
        if ($myConfig->getBaseShopId() == 'oxbaseshop') {
            // CE or PE shop
            $sShopId = "'oxbaseshop' ";
        } else {
            // EE shop
            $sShopId = $myConfig->getBaseShopId();
        }
        $iLang = $this->_iEditLang;

        $oDb = oxDb::getDb();
        //$aCatIds = $this->getConfig()->getRequestParameter( 'jxtx_catid' ); 
        $a404Urls = $this->getConfig()->getRequestParameter( 'jx404_404urls' ); 
        $aSeoUrls = $this->getConfig()->getRequestParameter( 'jx404_seourls' ); 

        foreach ($aSeoUrls as $key => $sSeoUrl) {
            //$sSql = "UPDATE oxcategories SET jxamazoncategory = '{$aTaxoVals[$key]}' WHERE oxid = '{$aCatIds[$key]}' ";
            $sSql = "SELECT oxobjectid "
                    . "FROM oxseo "
                    . "WHERE oxseourl = '{$sSeoUrl}' "
                        . "AND oxlang = {$iLang} "
                        . "AND oxshopid = {$sShopId} "
                    . "LIMIT 1";
            $sObjectId = $oDb->getOne($sSql);
            //echo '<hr>' . $sSeoUrl . '-' .$sObjectId . '<br>';
            //echo $oDb->getOne("SELECT oxobjectid FROM oxseohistory WHERE oxobjectid = " . $oDb->quote($sObjectId) . " AND oxshopid = {$sShopId} AND oxlang = {$iLang} ");
            //echo '<br>';
            if ($sObjectId != '') {
                if ($oDb->getOne("SELECT oxobjectid FROM oxseohistory WHERE oxobjectid = " . $oDb->quote($sObjectId) . " AND oxshopid = {$sShopId} AND oxlang = {$iLang} ") == '') {
                    //echo 'not found<br><br>';
                    $sSql = "INSERT INTO oxseohistory "
                            . "(oxobjectid, oxident, oxshopid, oxlang, oxhits, oxinsert) "
                            . "VALUES "
                            . "('{$sObjectId}', MD5(LOWER('{$a404Urls[$key]}')), {$sShopId}, {$iLang}, 0, NOW())";
                    //echo $sSql;
                    if ($sSeoUrl != '') {
                        $oDb->execute($sSql);
                    }
                }
                else {
                    //echo 'found<br><br>';
                    $sSql = "UPDATE oxseohistory "
                            . "SET oxident = MD5(LOWER('{$a404Urls[$key]}')) "
                            . "WHERE oxobjectid = " . $oDb->quote($sObjectId) . " "
                                . "AND oxshopid = {$sShopId} "
                                . "AND oxlang = {$iLang} ";
                    //echo $sSql;
                    if ($sSeoUrl != '') {
                        $oDb->execute($sSql);
                    }
                }
            }
            
        }
        return;
    }

	
		
}
