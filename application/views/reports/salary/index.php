<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<form method="post" action=" <?= base_url('reports/salary_reports')?>">
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
                                        <label>Employee <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm select2" id="employee" name="employee" required>
                                            <option value="">-- Select Employee --</option>
                                            <?php foreach ($employees as $key => $employee) { ?>
                                                <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <small><?= form_error('employee'); ?></small>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>From Date <span class="astrick">*</span></label>
                                        <input type="text" name="fdate" class="form-control form-control-sm datepicker" placeholder="From Date" value="<?= date('01-m-Y'); ?>" readonly required>
                                        <small><?= form_error('fdate'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>To Date <span class="astrick">*</span></label>
                                        <input type="text" name="tdate" class="form-control form-control-sm datepicker" placeholder="To Date" value="<?= date('t-m-Y'); ?>" readonly required>
                                        <small><?= form_error('tdate'); ?></small>
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