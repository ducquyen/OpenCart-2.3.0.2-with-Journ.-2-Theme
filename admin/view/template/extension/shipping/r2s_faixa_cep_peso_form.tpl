<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-option" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-option" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"><?php echo $entry_title; ?></label>
                        <div class="col-sm-10">
                            <?php foreach ($languages as $language) { ?>
                                <div class="input-group"><span class="input-group-addon"><img src="language/<?php echo $language['code']; ?>/<?php echo $language['code']; ?>.png" title="<?php echo $language['name']; ?>" /></span>
                                    <input type="text" name="description[<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($description[$language['language_id']]) ? $description[$language['language_id']]['title'] : ''; ?>" class="form-control" />
                                </div>
                                <?php if (isset($error_title[$language['language_id']])) { ?>
                                    <div class="text-danger"><?php echo $error_title[$language['language_id']]; ?></div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_weight; ?></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="weight_min" value="<?php echo $weight_min; ?>" class="form-control" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="weight_max" value="<?php echo $weight_max; ?>" class="form-control" />
                                </div>
                            </div>
                            <?php if ($error_weight) { ?>
                                <span class="text-danger"><?php echo $error_weight; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_postcode; ?></label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" name="postcode_min" value="<?php echo $postcode_min; ?>" class="form-control" />
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="postcode_max" value="<?php echo $postcode_max; ?>" class="form-control" />
                                </div>
                            </div>
                            <?php if ($error_postcode) { ?>
                                <span class="text-danger"><?php echo $error_postcode; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-cost"><?php echo $entry_cost; ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa"><?php echo $currency_simbol; ?></i></span>
                                <input type="text" name="cost" value="<?php echo $cost; ?>" placeholder="<?php echo $entry_cost; ?>" id="input-cost" class="form-control" />
                            </div>
                            <?php if ($error_cost) { ?>
                                <span class="text-danger"><?php echo $error_cost; ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div></div>
<?php echo $footer; ?>