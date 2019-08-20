<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-parcelamento" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-parcelamento" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-3 control-label"><?php echo $entry_valor_minimo; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="joseanmatias_parcelamento_valor_minimo" value="<?php echo $joseanmatias_parcelamento_valor_minimo; ?>" class="form-control" />
                                <?php if ($error_parcelamento_valor_minimo) { ?>
                                    <div class="text-danger"><?php echo $error_parcelamento_valor_minimo; ?></div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_juros; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="joseanmatias_parcelamento_juros" value="<?php echo $joseanmatias_parcelamento_juros; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-3 control-label"><?php echo $entry_total_parcelas; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="joseanmatias_parcelamento_total_parcelas" value="<?php echo $joseanmatias_parcelamento_total_parcelas; ?>" class="form-control" />
                                <?php if ($error_parcelamento_total_parcelas) { ?>
                                    <div class="text-danger"><?php echo $error_parcelamento_total_parcelas; ?></div>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-3 control-label"><?php echo $entry_parcelas_sem_juros; ?></label>
                        <div class="col-sm-9">
                            <input type="text" name="joseanmatias_parcelamento_parcelas_sem_juros" value="<?php echo $joseanmatias_parcelamento_parcelas_sem_juros; ?>" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_text_list; ?></label>
                        <div class="col-sm-9">
                            <textarea name="joseanmatias_parcelamento_text_list" rows="2" cols="100" class="form-control"><?php echo $joseanmatias_parcelamento_text_list; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_text_page; ?></label>
                        <div class="col-sm-9">
                            <textarea name="joseanmatias_parcelamento_text_page" rows="2" cols="100" class="form-control"><?php echo $joseanmatias_parcelamento_text_page; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_tabela_price; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_tabela_price) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_tabela_price" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_tabela_price" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_tabela_price" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_tabela_price" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_price_update; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_price_update) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_price_update" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_price_update" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_price_update" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_price_update" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_showtotal; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_showtotal) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_showtotal" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_showtotal" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_showtotal" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_showtotal" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_showall; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_showall) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_showall" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_showall" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_showall" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_showall" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_showall_expand; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_showall_expand) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_showall_expand" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_showall_expand" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_showall_expand" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_showall_expand" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_outofstock; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_outofstock) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_outofstock" value="1" checked="checked" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_outofstock" value="0" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_outofstock" value="1" /> <?php echo $text_yes; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_outofstock" value="0" checked="checked" /> <?php echo $text_no; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $entry_status; ?></label>
                        <div class="col-sm-9">
                            <div class="btn-group" data-toggle="buttons">
                                <?php if ($joseanmatias_parcelamento_status) { ?>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_status" value="1" checked="checked" /> <?php echo $text_enabled; ?>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_status" value="0" /> <?php echo $text_disabled; ?>
                                    </label>
                                <?php } else { ?>
                                    <label class="btn btn-default">
                                        <input type="radio" name="joseanmatias_parcelamento_status" value="1" /> <?php echo $text_enabled; ?>
                                    </label>
                                    <label class="btn btn-default active">
                                        <input type="radio" name="joseanmatias_parcelamento_status" value="0" checked="checked" /> <?php echo $text_disabled; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>