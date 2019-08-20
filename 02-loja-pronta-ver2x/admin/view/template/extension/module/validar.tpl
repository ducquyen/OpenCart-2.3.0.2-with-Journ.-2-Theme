<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-validar" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
   <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-validar" class="form-horizontal">
   
    <div class="form-group">
           <label class="col-sm-8 control-label" for="input-ativo"><?php echo $text_ajuda; ?> <a href="<?php echo $link_custom_field; ?>"> CLIQUE AQUI </a></label>
           </div>
    <div class="form-group">
           <label class="col-sm-2 control-label" for="input-ativo"><?php echo $entry_ativar; ?> <?php echo $entry_cpf; ?></label>
            <div class="col-sm-5">
              
                <label class="radio-inline">
                <?php if ($validar_ativo) { ?>
                <input type="radio" name="validar_ativo" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="validar_ativo" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$validar_ativo) { ?>
                <input type="radio" name="validar_ativo" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="validar_ativo" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
              
            </div>
          </div>
   
    <div class="form-group">
			    <label class="col-sm-2 control-label"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_cpf; ?>"><?php echo $entry_cpf; ?></span></label>
				<div class="col-sm-5">
				  <select name="validar_cpf" id="input-cpf" class="form-control">
				    <?php foreach($custom_fields as $custom_field) { ?>
					<?php if ($validar_cpf == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				 
				</div>
			  </div>
              
              
               <div class="form-group">
           <label class="col-sm-2 control-label" for="input-ativo1"><?php echo $entry_ativar; ?> <?php echo $entry_cnpj; ?></label>
            <div class="col-sm-5">
              
                <label class="radio-inline">
                <?php if ($validar_ativo1) { ?>
                <input type="radio" name="validar_ativo1" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="validar_ativo1" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$validar_ativo1) { ?>
                <input type="radio" name="validar_ativo1" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="validar_ativo1" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
              
            </div>
          </div>
              
              <div class="form-group">
			    <label class="col-sm-2 control-label"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_cnpj; ?>"><?php echo $entry_cnpj; ?></span></label>
				<div class="col-sm-5">
				  <select name="validar_cnpj" id="input-cnpj" class="form-control">
				    <?php foreach($custom_fields as $custom_field) { ?>
					<?php if ($validar_cnpj == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				  
				</div>
			  </div>
              
              
               <div class="form-group">
            <label class="col-sm-2 control-label" for="input-aviso">Atenção:</label>
            <div class="col-sm-10">
            <?php echo $text_aviso; ?>
            </div>
          </div> 
                <div class="form-group">
           <label class="col-sm-2 control-label" for="input-ativo2"><?php echo $entry_ativar; ?> <?php echo $entry_misto; ?></label>
            <div class="col-sm-5">
              
                <label class="radio-inline">
                <?php if ($validar_ativo2) { ?>
                <input type="radio" name="validar_ativo2" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <?php } else { ?>
                <input type="radio" name="validar_ativo2" value="1" />
                <?php echo $text_yes; ?>
                <?php } ?>
              </label>
              <label class="radio-inline">
                <?php if (!$validar_ativo2) { ?>
                <input type="radio" name="validar_ativo2" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="validar_ativo2" value="0" />
                <?php echo $text_no; ?>
                <?php } ?>
              </label>
              
            </div>
          </div>
               <div class="form-group">
			    <label class="col-sm-2 control-label"><span data-toggle="tooltip" data-html="true" title="<?php echo $help_misto; ?>"><?php echo $entry_misto; ?></span></label>
				<div class="col-sm-5">
				  <select name="validar_misto" id="input-misto" class="form-control">
				    <?php foreach($custom_fields as $custom_field) { ?>
					<?php if ($validar_misto == $custom_field['custom_field_id']) { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>" selected><?php echo $custom_field['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></option>
					<?php } ?>
					<?php } ?>
				  </select>
				  
				</div>
			  </div>
             

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-5">
              <select name="validar_status" id="input-status" class="form-control">
                <?php if ($validar_status) { ?>
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
            <label class="col-sm-2 control-label" for="input-aviso">Suporte Técnico:</label>
            <div class="col-sm-10">
            <?php echo $text_suporte; ?>
            </div>
          </div> 
  
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>
