<?php defined('IN_IA') or exit('Access Denied');?><div class="modal-dialog" id="goods-selector-opmodal-<?php  echo $goods['id'];?>">
    <div class="modal-content">
        <div class="modal-header">
            <button data-dismiss="modal" class="close hasoption-close" type="button">×</button>
            <h4 class="modal-title">商品设置选项</h4>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger hide" id="ophtml"></div>
            <table class="table" style="width:100%;margin-top: 10px">
                <thead>
                <tr>
                    <th style=""><?php  if(empty($options)) { ?>商品<?php  } else { ?>规格<?php  } ?>名称</th>
                    <th style="width:100px;">原价</th>
                    <th style="width:100px;">库存</th>
                    <?php  if(is_array($column)) { foreach($column as $colk => $col) { ?>
                    <th style="width:100px;">
                        <?php  echo $col['title'];?>
                    </th>
                    <?php  } } ?>
                    <?php  if(!empty($options)) { ?>
                    <th style="width:100px;">
                       全选 <input type="checkbox">
                    </th>
                    <?php  } ?>
                </tr>
                </thead>
                <tbody id="param-items" class="ui-sortable">
                <!--没有规格-->
                <?php  if(empty($options)) { ?>
                    <tr class="multi-product-item goods-item">
                        <td><?php  echo $goods['title'];?></td>
                        <td>&yen;<?php  echo $goods['marketprice'];?></td>
                        <td><?php  echo $goods['total'];?></td>
                        <?php  if(is_array($column)) { foreach($column as $colk => $col) { ?>
                        <td>
                            <input name="<?php  echo $col['name'];?>" type="<?php  echo $col['type'];?>" class="form-control" value="<?php  echo $col['default'];?>" max="<?php  echo $col['max'];?>" min="<?php  echo $col['min'];?>">
                        </td>
                        <?php  } } ?>
                    </tr>
                <?php  } else { ?>
                <!--有规格-->
                <?php  if(is_array($options)) { foreach($options as $ok => $option) { ?>
                <tr class="multi-product-item goods-item">
                    <td><?php  echo $option['title'];?></td>
                    <td>&yen;<?php  echo $option['marketprice'];?></td>
                    <td><?php  echo $option['stock'];?></td>
                    <?php  if(is_array($column)) { foreach($column as $colk => $col) { ?>
                    <td>
                        <input name="<?php  echo $col['name'];?>" type="<?php  echo $col['type'];?>" class="form-control" value="<?php  echo $col['default'];?>" max="<?php  echo $col['max'];?>" min="<?php  echo $col['min'];?>">
                    </td>
                    <?php  } } ?>
                    <td>
                        <input type="checkbox" class="form-control option-item" value="<?php  echo $option['id'];?>" data-price="<?php  echo $option['marketprice'];?>">
                    </td>
                </tr>
                <?php  } } ?>
                <?php  } ?>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary goods-selector-op-<?php  if(empty($options)) { ?>goods<?php  } else { ?>option<?php  } ?>" type="button" id="option_submit" data-id="<?php  echo $id;?>" data-dismiss="modal">确认</button>
            <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
        </div>
    </div>

</div>

<script>
    //规格选项状态渲染
    $(function () {
        var goodsid = <?php  echo $goods['id'];?>;
        var goods = model.selectedPool[goodsid];
        var htm = $(model.ele).find('.op-html').html();
        if (htm){
            $('#ophtml').html(htm);
            $('#ophtml').removeClass('hide');
        }

//        如果有规格
        if (goods.options != undefined && model.option_switch == 1){
            $.each(goods.options,function (i, v) {
                var id = v.id;
                //渲染勾选
                var p = $('.option-item[value="'+id+'"]').attr('checked',true);
                //渲染字段
                var column = v.column;
                if (column != undefined)
                    $.each(column,function (colname,colvalue) {
                        $('.option-item[value="'+id+'"]').parent().parent().find('input[name="'+colname+'"]').val(colvalue);
                    });
            });
        }else{
//            没有规格
            var column = goods.column;
            if (column != undefined)
                $.each(column,function (colname,colvalue) {
                    $('#goods-selector-opmodal-'+goodsid).find('input[name="'+colname+'"]').val(colvalue);
                });
        }

        model.selectedPool = undefined;
        model.ele = undefined;
    });
</script>

