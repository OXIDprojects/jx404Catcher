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
        
        /*$blAdminLog = $myConfig->getConfigParam('blLogChangesInAdmin');
        $sExcludeThis = $myConfig->getConfigParam( 'sJxAdminLogExcludeThis' );
        if ( !Empty($sExcludeThis) ) {
            $sExcludeThis = "AND l.oxsql NOT REGEXP '{$sExcludeThis}' ";
        }
        
        $cReportType = $this->getConfig()->getRequestParameter( 'jxadminlog_reporttype' );
        if (empty($cReportType))
            $cReportType = "all";

        if ($cReportType == "regexp")
            $sFreeRegexp = $this->getConfig()->getRequestParameter( 'jxadminlog_regexp' );

        $cAdminUser = $this->getConfig()->getRequestParameter( 'jxadminlog_adminuser' );
        if (empty($cAdminUser)) {
            $cAdminUser = "all";
            $sWhereUser = "";
        } else {
            $sWhereUser = "AND l.oxuserid = '{$cAdminUser}' ";
        }*/

        $oDb = oxDb::getDb( oxDB::FETCH_MODE_ASSOC );

        $sSql = "SELECT c.jxid, c.jx404url, c.jxcount, c.jxinsert, c.jxtimestamp, s.oxstdurl "
                . "FROM jx404catches c "
                . "LEFT JOIN oxseo s ON (c.jx404url = s.oxseourl) "
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

        $oModule = oxNew('oxModule');
        $oModule->load('jx404catcher');
        $this->_aViewData["sModuleId"] = $oModule->getId();
        $this->_aViewData["sModuleVersion"] = $oModule->getInfo('version');

        return $this->_sThisTemplate;
    }
	
		
}
