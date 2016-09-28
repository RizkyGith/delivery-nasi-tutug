<style type="text/css">
#upload-file-<?php echo $self['name']?> {
    position: absolute;
    cursor: pointer;
    margin-top: -24px;
    right: 12px;
    margin-right: 5px;
}

#progress-upload-<?php echo $self['name']?>{
	display : none;
	position: absolute;
}


</style>

<?php if(!empty($value)) : ?>
    <img style="width: 104px; border-radius: 11px; height: 98px;" src="{{ URL::base('data/makanan/'.$value) }}" alt="">
<?php else : ?>
    <input type="text" value="<?php $value ?>" name="<?php echo $self['name']?>"  placeholder="<?php echo l($self['label']) ?>" autocomplete="off" style="display:block;padding-right:30px" readonly/>
<?php endif; ?>

<span id="upload-file-<?php echo $self['name']?>" class="xn xn-upload"  href-target="<?php echo $self['name']?>"></span>
<div id="progress-upload-<?php echo $self['name']?>">
	<progress value="0" max="100"></progress>
	<span class="progress-value">0%</span>
</div>

<input type="file" id="<?php echo $self['name']?>"  style="display:none"/>
<script type="text/javascript">
$(function(){
	$("#upload-file-<?php echo $self['name']?>").on('click',function(e){
		$('#'+$(e.target).attr('href-target')).trigger('click');

	});
	$('#<?php echo $self['name']?>').on('change',function(){
		var input = this;

		// var selector = this.querySelector('input[type="file"]');
        var data = new FormData();
        var name = this.name;
        var that = this;
        var prefixs = '<?php echo $url ?>';

        console.log('testing');



        if (input.files && input.files[0]) {
        	data.append('files[]', input.files[0]);
        }else{
        	return;
        }

        $.ajax({
            url: prefixs,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();

                if (myXhr.upload) {
                    myXhr.upload.addEventListener('progress', function(e){
                        if (e.lengthComputable) {
                            var progress = Math.round(e.loaded / e.total * 100)

                            $('#progress-upload-<?php echo $self['name']?> progress').attr({value:e.loaded,max:e.total});
                            $('#progress-upload-<?php echo $self['name']?> .progress-value').html(progress + '%');
                        }
                    }, false);
                }
                return myXhr;
            },
            beforeSend: function(){
                $("#progress-upload-<?php echo $self['name']?>").show();

            },
            error: function(){
                $("#progress-upload-<?php echo $self['name']?>").hide();

            },
        }).done(function(result){
            $("#progress-upload-<?php echo $self['name']?>").hide();
            if (input.files && input.files[0]) {
				$('input[name="<?php echo $self['name']?>"]').val(input.files[0].name);
			}


        });


	});

})
</script>