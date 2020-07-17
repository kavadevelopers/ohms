<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<form method="post" action=" <?= base_url('reports/register_result')?>">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">
                    	<div class="card-header">
                    		<div class="row">
    	                		<div class="col-md-6">
    	                			<h3 class="card-title"><?=  $_title; ?></h3>	
    	                		</div>
                    		</div>
                  		</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chalan/Invoice <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm" name="chin" required>
                                            <option value="">-- Select --</option>
                                            <option value="invoice" <?= isset($chin) && $chin == "invoice"?'selected':''; ?>>Invoce</option>
                                            <option value="chalan" <?= isset($chin) && $chin == "chalan"?'selected':''; ?>>Chalan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                	<div class="form-group">
                                		<label>Type <span class="astrick">*</span></label>
                                		<select class="form-control form-control-sm" name="type" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="1" <?= isset($type) && $type == "1"?'selected':''; ?>>Sale</option>
                                            <option value="2" <?= isset($type) && $type == "2"?'selected':''; ?>>Purchase</option>
                                            <option value="3" <?= isset($type) && $type == "3"?'selected':''; ?>>Expenses</option>
                                            <!-- <option value="4" <?= isset($type) && $type == "4"?'selected':''; ?>>Salary</option> -->
                                        </select>
                                	</div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php if(isset($result)){ ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-md-12">
                <div class="card">
                	<div class="card-body">
                		<table class="table table-bordered table-sm dt" id="sales">
                            <thead>
                                <tr>
                                    <th class="text-center">Chalan/Invoice</th>
                                    <th class="">Client</th>
                                    <th class="text-right">Credit</th>
                                    <th class="text-right">Debit</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php foreach ($result as $key => $value) { ?>
                            		<?php $amount = $this->general_model->client_total($value['client'],$chin,$type); ?>
                            		<tr>
                            			<td class="text-center"><?= ucfirst($chin) ?></td>
                            			<?php if($type == '1' || $type == '2'){ ?>
                            				<td><?= $this->general_model->_client($value['client'])['name'] ?></td>
                            			<?php }else if($type == "3"){ ?>
                            				<td><?= $this->general_model->_expanse_client($value['client'])['name'] ?></td>
                            			<?php } ?>
                            			<td class="text-right"><?= rs().moneyFormatIndia(amountCreDeb($amount['credit'],$amount['debit'])[0]) ?></td>
                            			<td class="text-right"><?= rs().moneyFormatIndia(amountCreDeb($amount['credit'],$amount['debit'])[1]) ?></td>
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
        $('#sales').DataTable({
            "paging": false,
           "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l>>",
           buttons: [ 
                { 
                    extend: 'print',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                }
                
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [0,1,2,3] 
                }
            ] 
        });  
    })
</script>