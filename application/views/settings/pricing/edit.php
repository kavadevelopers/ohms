<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>

<div class="content-header">
  	<div class="container-fluid">
    	<div class="row mb-2">
      		<div class="col-sm-6">
        		<h1 class="m-0 text-dark"><?=  $_title; ?></h1>
      		</div>
    	</div>
  	</div>
</div>

<section class="content">
  	<div class="container-fluid">
  	     <div class="row">
            <div class="col-8">
                <div class="card">
                    <form method="post" action=" <?= base_url('prod_pricing/save')?>">
                    	<div class="card-body">
                        	<div class="row">

	                    		<div class="col-md-5">
	                    			<div class="col-md-12">
		                                <div class="form-group">
		                                    <label>Client Name</label>
		                                    <input class="form-control form-control-sm" type="text" name="" placeholder="Client Name" value="<?= $client['name'] ?>" autocomplete="off" readonly>
		                                </div>
		                            </div>
		                            <div class="col-md-12">
		                                <div class="form-group">
		                                    <label>Client Mobile</label>
		                                    <input class="form-control form-control-sm" type="text" name="" placeholder="Client Mobile" value="<?= $client['mobile'] ?>" autocomplete="off" readonly>
		                                </div>
		                            </div>
	                    		</div>

	                    		<div class="col-md-7">
	                    			

	                    			<table class="table table-bordered">
	                    				<thead>
	                    					<tr>
	                    						<th class="text-center">Products</th>
	                    					</tr>
	                    				</thead>
	                    				<tbody>
			                    			<?php foreach ($products as $key => $product) { ?>
			                    				<tr>
			                    					<td>
							                            <div class="form-group row">
					                    					<label for="row_<?= $key ?>" class="col-sm-4 col-form-label text-right">
					                    						<?= $this->general_model->get_product($product['product'])['name']; ?>
					                    					</label>
					                    					<div class="col-sm-8">
					                      						<input type="text" class="form-control numbers-decimal" id="row_<?= $key ?>" placeholder="<?= $this->general_model->get_product($product['product'])['name']; ?>" value="<?= $product['price'] ?>" name="price[]" required>
					                    					</div>
					                  					</div>
					                  					<input type="hidden" name="product[]" value="<?= $product['product'] ?>">
					                  					<input type="hidden" name="product_id[]" value="<?= $product['id'] ?>">
				                  					</td>
			                  					</tr>
			                    			<?php } ?>
	                    				</tbody>
	                    			</table>
	                    		</div>

	                    	</div>
                    		<input type="hidden" name="client_id" value="<?= $client['id'] ?>">
                    	</div>
                    	<div class="card-footer text-right">
                    		<a href="<?= base_url('prod_pricing') ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                    	</div>
                    </form>
                </div>
            </div>
        </div>
  	</div>
</section>