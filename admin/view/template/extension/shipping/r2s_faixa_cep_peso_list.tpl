<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
          <button type="button" data-toggle="tooltip" title="<?php echo $button_copy; ?>" class="btn btn-default" onclick="$('#form-result').attr('action', '<?php echo $copy; ?>').submit()"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-result').submit() : false;"><i class="fa fa-trash-o"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        <a href="<?php echo $config; ?>" data-toggle="tooltip" title="<?php echo $button_config; ?>" class="btn btn-primary"><i class="fa fa-cog"></i> <span class="hidden-xs"><?php echo $button_config; ?></span></a>
      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-result">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php if ($sort == 't2.title') { ?>
                    <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 't1.weight_min') { ?>
                    <a href="<?php echo $sort_weight; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_weights; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_weight; ?>"><?php echo $column_weights; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 't1.postcode_min') { ?>
                    <a href="<?php echo $sort_postcode; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_postcodes; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_postcode; ?>"><?php echo $column_postcodes; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 't1.cost') { ?>
                <a href="<?php echo $sort_cost; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_cost; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_cost; ?>"><?php echo $column_cost; ?></a>
                <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($faixas_cep) { ?>
                <?php foreach ($faixas_cep as $faixa_cep) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($faixa_cep['result_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $faixa_cep['result_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $faixa_cep['result_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $faixa_cep['title']; ?></td>
                  <td class="text-left"><?php echo $faixa_cep['weights']; ?></td>
                  <td class="text-left"><?php echo $faixa_cep['postcodes']; ?></td>
                  <td class="text-left"><?php echo $faixa_cep['cost']; ?></td>
                  <td class="text-right"><a href="<?php echo $faixa_cep['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>