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
            	<?php if($_e == 0){ ?>
                <form method="post" action=" <?= base_url('increment_salary/save')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add</h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Employee<span class="astrick">*</span></label>
                                    <select class="form-control form-control-sm select2" name="name">
                                        <option value="">-- Select Employee --</option>
                                        <?php foreach ($employees as $key => $employee) { ?>
                                            <option value="<?= $employee['id'] ?>" <?= set_value('name') == $employee['id']?'selected':'' ?>><?= $employee['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Salary<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="salary" placeholder=" Increment Amount" value="<?= set_value('salary') ?>" autocomplete="off" >
                                    <small><?= form_error('salary'); ?></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add</button> 
                        </div>
                    </div>
                </form>
                <?php }else{ ?>
                <form method="post" action=" <?= base_url('increment_salary/update')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit</h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Employee<span class="astrick">*</span></label>
                                    <select class="form-control form-control-sm select2" name="name">
                                        <option value="">-- Select Employee --</option>
                                        <?php foreach ($employees as $key => $employee) { ?>
                                            <option value="<?= $employee['id'] ?>" <?= set_value('name',$client['employee']) == $employee['id']?'selected':'' ?>><?= $employee['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Salary<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="salary" placeholder="Increment Amount" value="<?= set_value('salary',$client['salary']) ?>" autocomplete="off" >
                                    <small><?= form_error('salary'); ?></small>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?= $client['id'] ?>">
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('employees') ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="employee">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th class="text-right">Salary</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                                <?php foreach ($increments as $key => $increment){ ?>
                                    <tr>
                                        <td><?= $this->general_model->employee($increment['employee'])['name'] ?></td>
                                        <td class="text-right"><?= $increment['salary'] ?></td>
                                        <td class="text-center"><?= vd($increment['date']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('increment_salary/edit/').$increment['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
                                            <a href="<?=base_url('increment_salary/delete/').$increment['id']?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this?')">Delete</a>
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
<script type="text/javascript">
    $(function(){
        $('#employee').DataTable({
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [3] 
                }
            ] 
        });
    });
</script>