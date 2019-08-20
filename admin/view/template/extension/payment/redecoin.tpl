<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-redecoin" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-redecoin" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-12">
              <div class="alert alert-success">
                <div class="pull-left"><a href="https://www.redecoin.com/?refer=opencart" alt="Redecoin" target="_blank"><img src="<?php echo $redecoin_logo; ?>" alt="Redecoin" /></a></div>
                <div class="pull-left media-right">
                  <?php echo $text_info; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-notify"><span data-toggle="tooltip" title="<?php echo $help_notify; ?>"><?php echo $entry_notify; ?></span></label>
            <div class="col-sm-10">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-link"></i></span>
                  <input type="text" readonly="" value="<?php echo $redecoin_notify; ?>" id="input-notify" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-iso4217"><span data-toggle="tooltip" title="<?php echo $help_iso4217; ?>"><?php echo $entry_iso4217; ?></span></label>
            <div class="col-sm-10">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="text" name="" value="<?php echo $redecoin_iso4217; ?>" placeholder="<?php echo $entry_iso4217; ?>" id="input-iso4217" class="form-control" readonly/>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="redecoin_total" value="<?php echo $redecoin_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status-pending"><span data-toggle="tooltip" title="<?php echo $help_order_status_pending; ?>"><?php echo $entry_order_status_pending; ?></span></label>
            <div class="col-sm-10">
              <select name="redecoin_order_status_id_pending" id="input-order-status-pending" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $redecoin_order_status_id_pending) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status-canceled"><span data-toggle="tooltip" title="<?php echo $help_order_status_canceled; ?>"><?php echo $entry_order_status_canceled; ?></span></label>
            <div class="col-sm-10">
              <select name="redecoin_order_status_id_canceled" id="input-order-status-canceled" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $redecoin_order_status_id_canceled) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status-denied"><span data-toggle="tooltip" title="<?php echo $help_order_status_denied; ?>"><?php echo $entry_order_status_denied; ?></span></label>
            <div class="col-sm-10">
              <select name="redecoin_order_status_id_denied" id="input-order-status-denied" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $redecoin_order_status_id_denied) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-order-status-processing"><span data-toggle="tooltip" title="<?php echo $help_order_status_processing; ?>"><?php echo $entry_order_status_processing; ?></span></label>
            <div class="col-sm-10">
              <select name="redecoin_order_status_id_processing" id="input-order-status-processing" class="form-control">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $redecoin_order_status_id_processing) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="redecoin_status" id="input-status" class="form-control">
                <?php if ($redecoin_status) { ?>
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
            <label class="col-sm-2 control-label" for="input-token"><span data-toggle="tooltip" title="<?php echo $help_token; ?>"><?php echo $entry_token; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="redecoin_token" value="<?php echo $redecoin_token; ?>" placeholder="<?php echo $entry_token; ?>" id="input-token" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-secret_key"><span data-toggle="tooltip" title="<?php echo $help_secret_key; ?>"><?php echo $entry_secret_key; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="redecoin_secret_key" value="<?php echo $redecoin_secret_key; ?>" placeholder="<?php echo $entry_secret_key; ?>" id="input-secret_key" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="redecoin_sort_order" value="<?php echo $redecoin_sort_order; ?>" placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 