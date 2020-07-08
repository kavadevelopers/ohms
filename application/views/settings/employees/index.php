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
                <form method="post" action=" <?= base_url('employees/save')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add <?= $_title ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Employee Name<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Employee Name" value="<?= set_value('name') ?>" autocomplete="off" >
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mobile<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="mobile" placeholder="Mobile" value="<?= set_value('mobile') ?>" autocomplete="off" >
                                    <small><?= form_error('mobile'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Gender<span class="astrick">*</span></label>                                   
                                    <select class="form-control form-control-sm" name="gender">
                                        <option value="Male" <?= set_value('gender') == 'Male'?'selected':''; ?>>Male</option>
                                        <option value="Female" <?= set_value('gender') == 'Female'?'selected':''; ?>>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Per Minute Salary<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="salary" placeholder="Salary" value="<?= set_value('salary') ?>" autocomplete="off" >
                                    <small><?= form_error('salary'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Per day free minutes<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm numbers" type="text" name="free_minuts" placeholder="Per day free minutes" value="<?= set_value('free_minuts') ?>" autocomplete="off" >
                                    <small><?= form_error('free_minuts'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Opening Balance<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="opening" placeholder="Opening Balance" value="<?= set_value('opening') ?>" autocomplete="off" >
                                    <small><?= form_error('opening'); ?></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add</button> 
                        </div>
                    </div>
                </form>
                <?php }else{ ?>

                <form method="post" action=" <?= base_url('employees/update')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit <?= $_title ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Employee Name<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Employee Name" value="<?= set_value('name',$client['name']) ?>" autocomplete="off" >
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Mobile<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="mobile" placeholder="Mobile" value="<?= set_value('mobile',$client['mobile']) ?>" autocomplete="off" >
                                    <small><?= form_error('mobile'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Gender<span class="astrick">*</span></label>                                   
                                    <select class="form-control form-control-sm" name="gender">
                                        <option value="Male" <?= set_value('gender',$client['gender']) == 'Male'?'selected':''; ?>>Male</option>
                                        <option value="Female" <?= set_value('gender',$client['gender']) == 'Female'?'selected':''; ?>>Female</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Per Minute Salary<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="salary" placeholder="Salary" value="<?= set_value('salary',$client['salary']) ?>" autocomplete="off" >
                                    <small><?= form_error('salary'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Per day free minutes<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm numbers" type="text" name="free_minuts" placeholder="Per day free minutes" value="<?= set_value('free_minuts',$client['free_minuts']) ?>" autocomplete="off" >
                                    <small><?= form_error('free_minuts'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Opening Balance<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="opening" placeholder="Opening Balance" value="<?= set_value('opening',$client['opening']) ?>" autocomplete="off" >
                                    <small><?= form_error('opening'); ?></small>
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
                        <table class="table table-bordered table-hover table-sm" id="clients">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-right">O.B.</th>
                                    <th class="text-right">Salary</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                                <?php foreach ($employees as $key => $employee){ ?>
                                    <tr>
                                        <td><?= $employee['name'] ?></td>
                                        <td class="text-center"><?= $employee['mobile'] ?></td>
                                        <td class="text-right"><?= $employee['opening'] ?></td>
                                        <td class="text-right"><?= $employee['salary'] ?></td>
                                        <td class="text-center"><?= $employee['gender'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('employees/edit/').$employee['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
                                            <a href="<?= base_url('employees/delete/').$employee['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this?')">Delete</a>
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
        $('#clients').DataTable({
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [5] 
                }
            ] 
        });
    });
</script>

