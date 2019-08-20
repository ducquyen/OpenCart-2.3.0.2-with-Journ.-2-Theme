<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div class="container"><?php echo $content_top; ?>
	<style type="text/css">
		.rc-payment-center span{font-weight: bold; color: #F79219;}
		.rc-payment-center {max-width: 500px; margin: 0 auto; float: none;}
		.rc-payment-center label{border: 1px solid #cccccc;display: -webkit-inline-box;background-color: #dedede;padding: 3px 15px;border-radius: 12px;font-size: 13px;color: #000;margin: 20px 0;}
		.rc-payment-center a{margin: 20px 0;}
	</style>
	<div class="row">
		<div class="col-md-12"><h3><?php echo $text_order_registered; ?></h3></div>
	</div>
	<div class="row" style="text-align:center;">
		<div class="col-md-12 rc-payment-center"><h3><?php echo $text_payment_instruction; ?></h3></div>
		<div class="col-md-12 rc-payment-center"><img src="<?php echo $order_redecoin["resp"]["qrcode"]; ?>" alt="Redecoin Payment" /></div>
		<form><div class="col-md-12 rc-payment-center"><label><?php echo $order_redecoin["resp"]["address"]; ?></label></div></form>
	</div>
	<div class="row">
		<div class="col-md-12 rc-payment-center" style="text-align:right;">
			<a href='<?php echo $continue; ?>' class="btn btn-success"><?php echo $text_i_paid; ?></a>
		</div>
	</div>
<?php echo $footer; ?>