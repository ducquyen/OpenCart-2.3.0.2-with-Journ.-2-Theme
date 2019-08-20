<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-module" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i>  <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="module_social_chat_status" id="input-status" class="form-control">
                <?php if ($module_social_chat_status) { ?>
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
            <label class="col-sm-2 control-label" for="input-status"><?php echo $facebook; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_facebook" value="<?php echo $module_social_chat_facebook; ?>" id="input-status" class="form-control"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $whatsapp; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_whatsapp" value="<?php echo $module_social_chat_whatsapp; ?>" id="input-status" class="form-control"/>
            </div>
          </div>

           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $email; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_email" value="<?php echo $module_social_chat_email; ?>" id="input-status" class="form-control"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $call; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_call" value="<?php echo $module_social_chat_call; ?>" id="input-status" class="form-control"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $call_to_action; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_call_to_action" value="<?php echo $module_social_chat_call_to_action; ?>" id="input-status" class="form-control"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $button_color; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_button_color" value="<?php echo $module_social_chat_button_color; ?>" id="input-status" class="form-control"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $position; ?></label>
            <div class="col-sm-10">
               <select name="module_social_chat_position" id="input-status" class="form-control">
                <?php if ($module_social_chat_position=='left') { ?>
                <option value="left" selected="selected"><?php echo $text_left; ?></option>
                <option value="right"><?php echo $text_right; ?></option>
                <?php } else { ?>
                <option value="left"><?php echo $text_left; ?></option>
                <option value="right" selected="selected"><?php echo $text_right; ?></option>
                <?php } ?>
               </select>

            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $order; ?></label>
            <div class="col-sm-10">
              <input type="text" name="module_social_chat_order" value="<?php echo $module_social_chat_order; ?>" id="input-status" class="form-control"/>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
