<include file="public/head" />

<volist name='list' id='vo' empty='没有东西'>

{$vo.id}
{$vo.table_name}

</volist>

<?php echo MODULE_NAME;?>
<?php echo ACTION_NAME;?>
{$MODULE_NAME} <br>{$CONTROLLER_NAME}<br>{$ACTION_NAME}

<include file='public/foot' />