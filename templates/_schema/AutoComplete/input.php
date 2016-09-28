<style type="text/css">
    #<?php echo 'display'.$self['name'] ?> { margin-bottom: 10px; display: inline-block; }
    #<?php echo 'display'.$self['name'] ?> div { background-color: #000; padding: 10px; border-radius: 2px; color: #fff; float: left; margin: 0px 5px 5px 0px; }
    #<?php echo 'display'.$self['name'] ?> div span.delete { margin-left: 10px; border: 2px solid #fff; border-radius: 100%; cursor: pointer; width: 20px; height: 20px; line-height: 18px; display: inline-block; text-align: center; }
    img#loader-<?php echo $self['name'] ?> { position: absolute; margin-top: -27px;right: 16px;display:none;}
</style>

<input id="<?php echo 'input'.$self['name'] ?>" type="text"  value="<?php echo $self->optionLabel($self['foreignLabel'],$self->rowData($value)) ?>" placeholder="<?php echo ucfirst(str_replace('_', ' ', $self['name'])) ?>">
<img id="loader-<?php echo $self['name'] ?>" src="<? echo Theme::base('img/spin.gif') ?>"/>
<input name="<?php echo $self['name'] ?>" value="<?php echo $value ?>" id="<?php echo 'real-'.$self['name'] ?>" type="hidden">

<script type="text/javascript">
    $("#<?php echo 'input'.$self['name'] ?>").autocomplete({
        source: function (request, response) {
            
            <?php if ($flag == 1): ?>
                var data = '<?php echo $data_sources ?>';
                data = JSON.parse(data);

                var matches = $.map(data, function (acItem) {
                    var regexp =  new RegExp('.*'+request.term.toUpperCase()+'.*')
                        
                    if (regexp.test(acItem.label.toUpperCase())) {
                        return {
                            label: acItem.label,
                            value: acItem.value
                        }
                    }
                });
                response(matches);
            <?php else: ?>
            $('#loader-<?php echo $self['name'] ?>').show();
                $.ajax({
                    url: '<?php echo $data_sources ?>',
                    data: { '<?php echo $self['foreignLabel']."!like" ?>': request.term },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        response($.map(data.entries, function(item) {
                            
                            return {
                                label: item.<?php echo $self['foreignLabel'] ?>,
                                value: item.<?php echo $self['foreignKey'] ?>
                            }
                        }));

                        $('#loader-<?php echo $self['name'] ?>').hide();
                    },
                    error: function () {
                        response([]);
                    }
                });
            <?php endif ?>
        },
        select: function(event, ui) {
            ui.item['val'] = ui.item['value'];
            ui.item['value'] = ui.item['label'];
            
            $("#<?php echo 'real-'.$self['name'] ?>").val(ui.item['val']);
        },

        focus: function(event, ui){
            return false;
        }
    });

    $("#<?php echo 'input'.$self['name'] ?>").on('change',function(e){

    })

    $("#<?php echo 'display'.$self['name'] ?>").on('keydown', function(e){
        if (e.which == 13) return false;
    });

    $("#<?php echo 'display'.$self['name'] ?>").on('click', '.delete', function(e){
        $(this).parent().remove();
    });
</script>