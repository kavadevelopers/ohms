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
            <div class="col-md-4">
                <form method="post" action=" <?= base_url('increment_salary/report')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Search Employee</h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Employee<span class="astrick">*</span></label>
                                    <select class="form-control form-control-sm select2" name="name" required>
                                        <option value="">-- Select Employee --</option>
                                        <?php foreach ($employees as $key => $employee) { ?>
                                            <option value="<?= $employee['id'] ?>" <?= set_value('name') == $employee['id']?'selected':'' ?>><?= $employee['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-search"></i> Search</button> 
                        </div>
                    </div>
                </form>
            </div>

            <?php if($_e != 0){ ?>
	            <div class="col-8">
	                <div class="card">
	                    <div class="card-body">
	                        <table class="table table-bordered table-hover table-sm" id="employee">
	                            <thead>
	                                <tr>
	                                    <th>Employee Name</th>
	                                    <th class="text-right">Increment Amount</th>
	                                    <th class="text-center">Increment Date</th>
	                                </tr>
	                           </thead>
	                            <tbody>
	                                <?php foreach ($increments as $key => $increment){ ?>
	                                    <tr>
	                                        <td><?= $this->general_model->employee($increment['employee'])['name'] ?></td>
	                                        <td class="text-right"><?= $increment['salary'] ?></td>
	                                        <td class="text-center"><?= vd($increment['date']) ?></td>
	                                   </tr>
	                               <?php } ?>
	                            </tbody>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        <?php } ?>
        </div>
	</div>
</section>

<script type="text/javascript">
    $(function(){
        $('#employee').DataTable({
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        });
    });
</script>