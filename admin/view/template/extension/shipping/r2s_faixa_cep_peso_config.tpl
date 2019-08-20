<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-faixa_cep_peso" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-faixa_cep_peso" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $entry_title; ?></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-text-width"></i></div>
                                <input type="text" name="r2s_faixa_cep_peso_title" value="<?php echo $r2s_faixa_cep_peso_title; ?>" size="1" class="form-control" />
                            </div>
                            <?php if ($error_title) { ?>
                          <div class="text-danger"><?php echo $error_title; ?></div>
                          <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $entry_status; ?></label>
                        <div class="col-md-9">
                            <select name="r2s_faixa_cep_peso_status" class="form-control">
                                <?php if ($r2s_faixa_cep_peso_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo $entry_sort_order; ?></label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></div>
                                <input type="text" name="r2s_faixa_cep_peso_sort_order" value="<?php echo $r2s_faixa_cep_peso_sort_order; ?>" size="1" class="form-control" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>