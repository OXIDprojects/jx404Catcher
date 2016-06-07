[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

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
                        <td class="[{ $listclass }]" style="height: 20px;">&nbsp;<nobr><a href="[{$sShopUrl}][{$a404Url.jx404url}]" target="_blank"><u>[{$a404Url.jx404url}]</u></a></nobr></td>
                        <td class="[{ $listclass }]" style="height: 20px;">&nbsp;<nobr><a href="[{$sShopUrl}][{$a404Url.oxstdurl}]" target="_blank"><u>[{$a404Url.oxstdurl}]</u></a></nobr></td>
                        <td class="[{ $listclass }]">[{$a404Url.jxcount}]</td>
                        <td class="[{ $listclass }]">[{$a404Url.jxinsert}]</td>
                        <td class="[{ $listclass }]">[{$a404Url.jxtimestamp}]</td>
                    </tr>
                [{/foreach}]
            </table>
    </div>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]

