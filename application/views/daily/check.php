<title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

<div class="content-header">
  	<div class="container-fluid">
    	<div class="row mb-2">
      		<div class="col-sm-6">
        		<h1 class="m-0 text-dark"><?= $_title ?></h1>
      		</div>
    	</div>
  	</div>
</div>

<section class="content">
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                <form method="post" action=" <?= base_url('daily/show')?>">
                    <div class="card">

                    	<div class="card-body">
                            <div class="row">
                            	<div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date <span class="astrick">*</span></label>
                                        <input type="text" name="fdate" class="form-control form-control-sm datepicker" placeholder="From Date" value="<?= $fdate; ?>" readonly required>
                                        <small><?= form_error('fdate'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date <span class="astrick">*</span></label>
                                        <input type="text" name="tdate" class="form-control form-control-sm datepicker" placeholder="To Date" value="<?= $tdate; ?>" readonly required>
                                        <small><?= form_error('tdate'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm" id="type" name="type" required>
                                            <option value="">-- Select --</option>
                                            <option value="invoice" <?= $type == 'invoice'?'selected':'' ?>>Invoce</option>
                                            <option value="chalan" <?= $type == 'chalan'?'selected':'' ?>>Chalan</option>
                                        </select>
                                        <small><?= form_error('type'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</button>
                        </div>

                	</div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php if(isset($result)){ ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
                <div class="card">
                	<div class="card-body">
                		<table class="table table-bordered table-sm dt">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Chalan/Invoice</th>
                                    <th class="">Client</th>
                                    <th class="text-right">Amount</th>
                                    <th class="">Remarks</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach ($result as $key => $value) { ?>
                            		<tr id="tr-<?= $value['id'] ?>">
	                            		<td class="text-center"><?= vd($value['date']) ?></td>
	                            		<td class="text-center">
	                            			<?php 
		                            			if($value['type'] == tsalepay()){ 
		                            				echo "Sale";
		                            			}else if($value['type'] == tpurchasepay()){
		                            				echo "Purchase";
		                            			}else if($value['type'] == texpensepay()){
		                            				echo "Expenses";
		                            			}else if($value['type'] == tsalarypay()){
		                            				echo "Salary";
		                            			}else if($value['type'] == tloanpay()){
		                            				echo "Loan";
		                            			}
	                            			?>
	                            		</td>
	                            		<td class="text-center">
	                            			<?= ucfirst($type) ?>
	                            		</td>
	                            		<td>
	                            			<?php 
		                            			if($value['type'] == tsalepay()){ 
		                            				echo $this->general_model->_client($value['client'])['name'];
		                            			}else if($value['type'] == tpurchasepay()){
		                            				echo $this->general_model->_client($value['client'])['name'];
		                            			}else if($value['type'] == texpensepay()){
		                            				echo $this->general_model->_expanse_client($value['client'])['name'];
		                            			}else if($value['type'] == tsalarypay()){
		                            				echo $this->general_model->_salary_client($value['client'])['name'];
		                            			}else if($value['type'] == tloanpay()){
		                            				echo $this->general_model->_loan_client($value['client'])['loan_no'];
		                            			}
	                            			?>
	                            		</td>
	                            		<td class="text-right">
	                            			<?= $value['debit'] != 0.00?$value['debit']:$value['credit'] ?>
	                            		</td>
	                            		<td>
	                            			<?= nl2br($value['remarks']) ?>
	                            		</td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm remove-daily" type="button" data-id="<?= $value['id'] ?>" id="rem<?= $value['id'] ?>">
                                                <i class="fa fa-trash" id="trash-<?= $value['id'] ?>"></i>
                                                <span id="trash-progress-<?= $value['id'] ?>" style="display: none;">
                                                    <i class="fa fa-circle-o-notch fa-spin"></i> Please Wait
                                                </span>
                                            </button>
                                        </td>
	                            	</tr>	
                            	<?php } ?>
                            </tbody>
                        </table>
                	</div>
                </div>
            </div>
 		</div>
 	</div>
</section>
<?php } ?>


<script type="text/javascript">
    $(function(){
        $('.remove-daily').click(function() {
            if(confirm('are you sure you want to delete this?')){
                var id = $(this).data('id');
                var type = '<?= $type ?>';
                $.ajax({
                    type : "post",
                    url : "<?php echo site_url('daily/delete'); ?>",
                    data : "id="+id+"&type="+type,
                    beforeSend: function() {
                        $('#trash-'+id).hide();     
                        $('#trash-progress-'+id).show();     
                        $('#rem'+id).attr('disabled',true);
                    },
                    success:function( out ){    
                        $('#tr-'+id).remove();
                        $.notify({
                            title: '<strong></strong>',
                            icon: 'fa fa-check',
                            message: 'Daily Deleted'
                        },{
                            type: 'success'
                        });  
                    }
                });
            }
        });
    })
</script>