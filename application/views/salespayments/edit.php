<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<form method="post" action=" <?= base_url('salespayments/update')?>">
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
                                        <label>Date <span class="astrick">*</span></label>
                                        <input type="text" name="date" class="form-control form-control-sm datepicker" placeholder="Date" value="<?= vd($sale['date']); ?>" readonly required>
                                        <small><?= form_error('date'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Client <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm select2" id="client" name="client" required>
                                            <option value="">-- Select Client --</option>
                                            <?php foreach ($clients as $key => $client) { ?>
                                                <option value="<?= $client['id'] ?>" <?= $client['id'] == $sale['client']?'selected':'' ?>><?= $client['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <small><?= form_error('client'); ?></small>
                                    </div>
                                </div>

                                

                                <div class="col-md-12">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Challan<small>(Amount)</small> <span class="astrick">*</span></label>
                                                <input type="text" name="challan" class="form-control form-control-sm numbers-decimal" value="<?= $sale['black'] ?>" placeholder="Amount" required>
                                                <small><?= form_error('challan'); ?></small>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Invoice<small>(Amount)</small> <span class="astrick">*</span></label>
                                                <input type="text" name="invoice" class="form-control form-control-sm numbers-decimal" value="<?= $sale['white'] ?>" placeholder="Amount" required>
                                                <small><?= form_error('invoice'); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control form-control-sm" name="desc" placeholder="Description..." rows="5"><?= $sale['desc'] ?></textarea>
                                        <small><?= form_error('desc'); ?></small>
                                    </div>
                                </div>

                                <input type="hidden" name="id" value="<?= $sale['id'] ?>">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('salespayments') ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>