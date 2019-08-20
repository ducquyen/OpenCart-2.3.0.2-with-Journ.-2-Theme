<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-desconto_boleto" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-desconto_boleto" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_value; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="joseanmatias_desconto_boleto_value" value="<?php echo $joseanmatias_desconto_boleto_value; ?>" class="form-control" />
                            <?php if ($error_desconto_boleto_value) { ?>
                                <div class="text-danger"><?php echo $error_desconto_boleto_value; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_method; ?></label>
                        <div class="col-sm-9">
                            <div id="desconto_boleto_method"></div>
                            <?php if ($error_desconto_boleto_method) { ?>
                                <div class="text-danger"><?php echo $error_desconto_boleto_method; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_text_list; ?></label>
                        <div class="col-sm-9">
                            <textarea name="joseanmatias_desconto_boleto_text_list" rows="2" cols="100" class="form-control"><?php echo $joseanmatias_desconto_boleto_text_list; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_text_page; ?></label>
                        <div class="col-sm-9">
                            <textarea name="joseanmatias_desconto_boleto_text_page" rows="2" cols="100" class="form-control"><?php echo $joseanmatias_desconto_boleto_text_page; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_price_update; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_desconto_boleto_price_update) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_desconto_boleto_price_update" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_desconto_boleto_price_update" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_desconto_boleto_price_update" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_desconto_boleto_price_update" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_outofstock; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_desconto_boleto_outofstock) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_desconto_boleto_outofstock" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_desconto_boleto_outofstock" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_desconto_boleto_outofstock" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_desconto_boleto_outofstock" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_status; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_desconto_boleto_status) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_desconto_boleto_status" value="1" checked="checked" /> <?php echo $text_enabled; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_desconto_boleto_status" value="0" /> <?php echo $text_disabled; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_desconto_boleto_status" value="1" /> <?php echo $text_enabled; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_desconto_boleto_status" value="0" checked="checked" /> <?php echo $text_disabled; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_sort_order; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="joseanmatias_desconto_boleto_sort_order" value="<?php echo $joseanmatias_desconto_boleto_sort_order; ?>" class="form-control" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"><!--
    $(document).delegate('#button-ip-add', 'click', function() {
        $.ajax({
            url: 'index.php?route=user/api/addip&token=<?php echo $token; ?>&api_id=<?php echo $api_id; ?>',
            type: 'post',
            data: 'ip=<?php echo $api_ip; ?>',
            dataType: 'json',
            beforeSend: function() {
                $('#button-ip-add').button('loading');
            },
            complete: function() {
                $('#button-ip-add').button('reset');
            },
            success: function(json) {
                $('.alert').remove();

                if (json['error']) {
                    $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['success']) {
                    $('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    var token = '';

    // Login to the API
    $.ajax({
        url: '<?php echo $store_url; ?>index.php?route=api/login',
        type: 'post',
        data: 'key=<?php echo $api_key; ?>',
        dataType: 'json',
        crossDomain: true,
        success: function(json) {
            $('.alert').remove();

            if (json['error']) {
                if (json['error']['key']) {
                    $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['key'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }

                if (json['error']['ip']) {
                    $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error']['ip'] + ' <button type="button" id="button-ip-add" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-danger btn-xs pull-right"><i class="fa fa-plus"></i> <?php echo $button_ip_add; ?></button></div>');
                }
            }

            if (json['token']) {
                $.ajax({
                    url: '<?php echo $store_url; ?>index.php?route=api/joseanmatias_desconto_boleto/methods&token='+ json['token'],
                    type: 'post',
                    data : {methods : '<?php echo implode(",", $joseanmatias_desconto_boleto_method); ?>'},
                    dataType: 'json',
                    beforeSend: function() {
                        $('#desconto_boleto_method').html('<?php echo $text_wait; ?>');
                    },
                    success: function(json) {
                        var select_html = '';
                        if(json['payment_methods']) {
                            for (var i in json['payment_methods']) {
                                if (json['payment_methods'][i]['selected']) {
                                    select_html += '<input type="checkbox" name="joseanmatias_desconto_boleto_method[]" value="' + json['payment_methods'][i]['code'] + '" id="payment_method'+ i +'" checked="checked"><label for="payment_method'+ i +'">' + json['payment_methods'][i]['title'] + '</label><br>';
                                } else {
                                    select_html += '<input type="checkbox" name="joseanmatias_desconto_boleto_method[]" value="' + json['payment_methods'][i]['code'] + '" id="payment_method'+ i +'"><label for="payment_method'+ i +'">' + json['payment_methods'][i]['title'] + '</label><br>';
                                }
                            }
                        } else if(json['error']) {
                            select_html = '<p class="text-warning">'+ json['error'] +'</p>';
                        } else {
                            select_html = '<p class="text-warning"><?php echo $text_no_payment; ?></p>';
                        }

                        $('#desconto_boleto_method').html(select_html);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    //--></script>
<?php echo $footer; ?>