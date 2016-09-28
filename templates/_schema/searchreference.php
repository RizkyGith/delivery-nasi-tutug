<style>
    td, th, h4 {
        cursor: pointer;
        text-align: center;
    }
    <?php echo "#".$self['name']."Modal" ?>{display: none;}
</style>

<div class="span-11">
    <input type="text" id="<?php echo $self['name'].'_search' ?>" readonly="readonly" value="<?php echo (!empty($value))? @$entry[$self['foreignLabel']] :'' ?>" placeholder="Click Search Button">
    <input type="hidden" value="<?php echo @$value ?>" name="<?php echo $self['name'] ?>" id="<?php echo $self['name'] ?>">
</div>
<a style="background:#0096C9; padding: 3px 0 0 0" class="click button span-1" data-toggle="modal" data-target="#<?php echo $self['name'] ?>Modal">
    <img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjQ0Nzk3M0EzOUE4RjExRTI4RDE0QjJGMTgwRUFCMzk3IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjQ0Nzk3M0E0OUE4RjExRTI4RDE0QjJGMTgwRUFCMzk3Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NDQ3OTczQTE5QThGMTFFMjhEMTRCMkYxODBFQUIzOTciIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NDQ3OTczQTI5QThGMTFFMjhEMTRCMkYxODBFQUIzOTciLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz5L8/bBAAADIElEQVR42rzXUUgUQRgH8LldEYKDQBACoSgEQ1i4BykUoSgUpSgkwV4OLhKjtzJ6kESfRB9SgsK4ozhfjOslKJKOJOHgSBKLIBSCUBCEnoSDA0E4r/8c38b4ubs3u6s38IOd2dn185vZmblIZu2h8FEa4TRd78CmCFkGWmf+X9dV6VsP/aQLog59FiELcxRg4GJ43OuDNZin66hLPxnkNGzAMP0DRxaMfFka3kGzj3edpKC+wKkgwdSVRYQH8gmuOPTdoiHZhgK0gAXtrF8nfIPLfucUDybpEMgKPIBll3echTFIKG1ykr+HDihqD1O5HBFkCBJKXZqCi7DM2lWbcAeuQ1Fpt2DW47mKg8Fg2kAUJunaNgojrM3LAtyEPaUtDu1ezx0IZh/DBPehga6lLEwodV1LMM7axryeccpMXIm2BI98ZISbgS2l3gUNepkpR5rAAkGWYF2p+7UHKaVuQpdbf54Zi0W7FCIrtiyrWzqZqdsXRqPDehK2/GH1Js11xjjB2opHEAx/h6kVzH7ZKDjszGEL3w529ILBzGdtLUcQTIzVt7VWYATzE3ZBkD4wlXoQfayed+vLPm0EUjYWQZBmGFDqfmGpMOJK/S+suPXnmZERpljE0/IrC5ARmdEk1CttL6GkkxnMmcpEX4A8bf/2BPwIV31+Xc/hGpu4L7SPEEqq7sEq2J/6BfgKt2G9ynsa6PjRz9p9HUUNJWXrMMjSaMEapKHHIc3y/iRsQL/D/WFIeA2tW2ZkeUOZmWVn2YRyePpNQxfTXMzSSpaqrTOH3vealvOMy1nWax3apWBjQQIyXNKXg3MwCgWNr2gP5uA8dNDzvI8c6rtVhsn0+i8nYIp+jvRAK01Wu/yCHHxgE7WXDvaX2DtfKdk/PEwlz59OlVKiH2lZH5/4bpCAvDITtlQLSP7hFN8oxTEWO6DPyoKq/iwSakBGyA1Rh9yEu102y+STH/NDykZpihrAZmx2Q97hXnLke6YSUOTx6ltRwxKlOdTpcO/McU5gt+Nor0NAuadtt7aOewLrBCTXqEG37aCWAcWetd3I243/BBgA61/QFPBXRNcAAAAASUVORK5CYII=" height="20px" />
</a>

<!-- Modal -->
<div class="dialog" id="<?php echo $self['name'] ?>Modal" tabindex="-1" role="dialog" aria-labelledby="<?php echo $self['name'] ?>ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="<?php echo $self['name'] ?>ModalLabel">Search Data <?php echo $self['foreign']   ?></h4>
            </div>
            <div class="modal-body">
                <input id="keyword-<?php echo $self['name'] ?>" type="text" value="" autocomplete="off" placeholder="Please type word for search then press enter">
                <div id="result-search-<?php echo $self['name'] ?>" style="height: 400px; overflow: auto; display: none;">
                    <table class="table table-striped table-bordered">
                        <thead class="head-result" id="head-<?php echo $self['name'] ?>">
                            <tr>
                                <?php $heads = $self->getFilterColumns('array'); ?>
                                <?php foreach($heads as $head): ?>
                                    <th><?php echo strtoupper(str_replace('_', ' ', $head))  ?></th>
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody class="body-result" id="body-result-<?php echo $self['name'] ?>" >
                        </tbody>
                    </table>
                    <div id="loader" style="text-align: center; display: none;"><img src="<?php echo URL::base("images/loading.gif") ?>"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end Modal -->

<style>
td { cursor: pointer; }
</style>

<script class="javascript">$(function(){

    "use strict";
    $('.btn-find-clear').on('click',function(e){
        e.preventDefault();
        $("#<?php echo $self['name']?>").val('').trigger('change');
        $("#<?php echo $self['name'].'_search' ?>").val('');
    })

    $(".click").bind('click',function(evt){
        evt.stopPropagation();
        evt.preventDefault();
        $("#<?php echo $self['name']?>Modal").dialog({ width: 768, maxHeight: 500 });
    });

    var limit = 20;
    var skip = 0;
    var z = 0;
    var keyword;

    function getData<?php echo $self['name']?>(keyword, limit, skip, event){
        $.ajax({
            method: "GET",
            url: "<?php echo URL::site(strtolower($self['foreign'])).'.json?!match="+keyword+"&!limit="+limit+"&!skip="+skip+"' ?>",
            beforeSend: function (xhr) {
               $("#loader").css("display","block");
            },
            error: function(jqXHR, exception) {
                if (jqXHR.status === 0) {
                    $("#loader").css("display","none");
                    $('.body-result').append('<tr><td colspan="3">Not connect.\n Verify Network.</td></tr>');
                } else if (jqXHR.status == 404) {
                    $("#loader").css("display","none");
                    $('.body-result').append('<tr><td colspan="3">Requested page not found. [404]</td></tr>');
                } else if (jqXHR.status == 500) {
                    $("#loader").css("display","none");
                    $('.body-result').append('<tr><td colspan="3">Internal Server Error. [500]</td></tr>');
                } else if (exception === 'parsererror') {
                    $("#loader").css("display","none");
                    $('.body-result').append('<tr><td colspan="3">Requested JSON parse failed.</td></tr>');
                } else if (exception === 'timeout') {
                    $("#loader").css("display","none");
                    $('.body-result').append('<tr><td colspan="3">Time out error.</td></tr>');
                } else if (exception === 'abort') {
                    $("#loader").css("display","none");
                    $('.body-result').append('<tr><td colspan="3">Ajax request aborted.</td></tr>');
                } 
                // else {
                //     $("#loader").css("display","none");
                //     $('.body-result').append('<tr><td colspan="3">Uncaught Error</td></tr>');
                // }
            }
        }).done(function(data){
            $("#loader").css("display","none");
            var th = '';
            var td = '';
            var neededfield = <?php echo $self->getFilterColumns() ?>;

            if(data['entries'].length){
                $.each(data['entries'], function(k, v){
                    td =  td + '<tr data-view="'+v.<?php echo $self['foreignLabel'] ?>+'" id="'+v.$id+'">';
                    $.each(v, function(fieldname, value){
                        var check = $.inArray(fieldname, neededfield);
                        if(check >= 0){
                            if(typeof(value) === 'object'){
                                    value = value['name'];
                                }
                            td += '<td style="text-align: center;">'+value+'</td>';
                        }
                    });
                    td = td + '</tr>';
                });
            } else {
                if(event == 1){
                    td = '<tr><td colspan="3">Data not available</td></tr>';
                }
            }

            $("#body-result-<?php echo $self['name'] ?>").append(td);
            $('#keyword-<?php echo $self["name"] ?>').val('');
        });
    }

    $('#keyword-<?php echo $self["name"] ?>').on('keypress', function(e){
        if(e.which == 13){
            e.preventDefault();
            $("#result-search-<?php echo $self['name'] ?>").show();
            $("#body-result-<?php echo $self['name'] ?> tr").replaceWith(null);

            keyword = $(this).val();
            skip = 0;

            var event = 1; //Event keypress
            getData<?php echo $self['name']?>(keyword, limit, skip, event);
        }
    });

    $("#result-search-<?php echo $self['name'] ?>").on('scroll', function() {
        var trueDivHeight = $("#result-search-<?php echo $self['name'] ?>")[0].scrollHeight;
        var divHeight = $("#result-search-<?php echo $self['name'] ?>").height();
        var max = trueDivHeight - divHeight;
        var event = 2; //Event Scroll

        if($("#result-search-<?php echo $self['name'] ?>").scrollTop() == max) {
            skip = skip + 20;
            getData<?php echo $self['name']?>(keyword, limit, skip, event);
        }
    });

    $("#result-search-<?php echo $self['name'] ?>").on('click','tr', function(){
        var datavalue = $(this).attr('data-view');
        var id = $(this).attr('id');

        if(id){
            $("#<?php echo $self['name']?>").val(id).trigger('change');
            $("#<?php echo $self['name'].'_search' ?>").val(datavalue);
            // $("#<?php echo $self['name'] ?>Modal").modal('hide');
            $( ".modal-dialog" ).dialog( "close" );
        }
    });

    $("#<?php echo $self['name'] ?>Modal").on('hidden.bs.modal', function () {
        $("#result-search-<?php echo $self['name'] ?>").hide();
        $("#body-result-<?php echo $self['name'] ?> tr").replaceWith(null);
        $("#keyword-<?php echo $self['name'] ?>").val('');
        skip = 0;
    });
});
</script>
