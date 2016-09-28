<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style type="text/css">
				select.ui-datepicker-month {
					float :left;
					width: 41%!important;
				    padding-bottom: 1px;
				    padding-top: 1px;
				    font-size: 15px!important;
				}

				select.ui-datepicker-year{
					width: 60%!important;
					padding-bottom: 1px;
				    padding-top: 1px;
				    font-size: 15px!important;
				}
</style>

<input type="text" name="<?php echo $self['name'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $self['label'] ?>" id="<?php echo $clean_name ?>" autocomplete="off">

<script>
    $(function() {
        $("#<?php echo $clean_name ?>").datepicker({ dateFormat: 'yy-mm-dd', changeMonth: false, changeYear:false});
    });
</script>