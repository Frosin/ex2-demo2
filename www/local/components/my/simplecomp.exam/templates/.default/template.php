<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<b><?=GetMessage('AUTH_AND_NEWS')?>:</b>

<ul>
<?foreach($arResult['ITEMS'] as &$item):?>
<li>[<?=$item['ID']?>] - <?=$item['LOGIN']?>
<ul>
    <?foreach($item['NEWS'] as $sub):?>
        <li><?=$sub['NAME']?></li>
    <?endforeach;?>
</ul>
</li>



<?endforeach;?>
</ul>