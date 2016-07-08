[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]
<link href="[{$oViewConf->getModuleUrl('jx404catcher','out/admin/src/jx404catcher.css')}]" type="text/css" rel="stylesheet">

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]


<style>
    #liste tr:hover td{
        background-color: #e0e0e0;
    }

    #liste td.activetime {
        background-image: url(bg/ico_activetime.png);
        min-width: 17px;
        background-position: center center;
        background-repeat: no-repeat;
    }
    .listitem, .listitem2 {
        padding-left: 4px;
        padding-right: 16px;
        white-space: nowrap;
    }
</style>


<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="jx404catcher_list">
</form>

[{assign var="oConfig" value=$oViewConf->getConfig() }]
[{assign var="iUrlLength" value=$oConfig->getConfigParam("sJx404CatcherUrlLength") }]
               
            <form name="jx404" id="jx404" action="[{ $oViewConf->getSelfLink() }]" method="post">
                [{ $oViewConf->getHiddenSid() }]
                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                <input type="hidden" name="fnc" value="saveNewSeoUrls">
                <input type="hidden" name="oxid" value="[{ $oxid }]">
                       
    <div id="liste">
            <div style="height: 12px;"></div>
            
            <table cellspacing="0" cellpadding="0" border="0" width="99%">
                <colgroup>
                    <col width="35%">
                    <col width="35%">
                    <col width="6%">
                    <col width="12%">
                    <col width="12%">
                </colgroup>
                <tr>
                    <td class="listheader">[{ oxmultilang ident="JX404CATCHER_404URL" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JX404CATCHER_NEWURL" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JX404CATCHER_COUNT" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JX404CATCHER_INSERT" }]</td>
                    <td class="listheader">[{ oxmultilang ident="JX404CATCHER_UPDATE" }]</td>
                </tr>
                [{foreach item=a404Url from=$a404Urls}]
                    [{ cycle values="listitem,listitem2" assign="listclass" }]
                    <tr>
                        <td class="[{ $listclass }]" style="height: 20px;">
                            &nbsp;<nobr><a href="[{$sShopUrl}][{$a404Url.jx404url}]" title="[{$sShopUrl}][{$a404Url.jx404url}]" target="_blank"><u>[{$a404Url.jx404url|substr:0:$iUrlLength}][{if $a404Url.jx404url|strlen > $iUrlLength}]...[{/if}]</u></a></nobr>
                            <input type="hidden" name="jx404_404urls[]" value="[{$a404Url.jx404url}]">
                        </td>
                        <td class="[{ $listclass }]" style="height: 20px;">
                            &nbsp;<nobr><a href="[{$sShopUrl}][{$a404Url.oxseourl}]" title="[{$sShopUrl}][{$a404Url.oxsteorl}]" target="_blank"><u>[{*$a404Url.oxseourl|substr:0:$iUrlLength}][{if $a404Url.oxseourl|strlen > $iUrlLength}]...[{/if*}]...</u></a></nobr>
                            <input id="" name="jx404_seourls[]" size="[{$iUrlLength}]" value="[{ $a404Url.oxseourl }]" class="flatInput">
                        </td>
                        <td class="[{ $listclass }]">[{$a404Url.jxcount}]</td>
                        <td class="[{ $listclass }]">[{$a404Url.jxinsert}]</td>
                        <td class="[{ $listclass }]">[{$a404Url.jxtimestamp}]</td>
                    </tr>
                [{/foreach}]
            </table>
    </div>
                <input type="submit"
                    onClick="document.forms['jxtaxo'].elements['fnc'].value = 'saveAmazonCategoryValues';" 
                    value=" [{ oxmultilang ident="GENERAL_SAVE" }] " [{ $readonly }]>
            </form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]

