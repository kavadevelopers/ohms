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
                <form method="post" action=" <?= base_url('salary/monthly')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Search</h3>
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
                                <div class="form-group">
                                    <label>Month<span class="astrick">*</span></label>
                                    <select class="form-control form-control-sm select2" name="month" required>
                                        <option value="">-- Select Month --</option>
                                        <?php foreach ($months as $key => $month) { ?>
                                            <option value="<?= $month['month'].'-'.$month['year'] ?>" <?= set_value('month') == $month['month'].'-'.$month['year']?'selected':'' ?>><?= $month['month'].'-'.$month['year'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <small><?= form_error('month'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-refresh"></i> Reset</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i> Search</button> 
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
	                                    <th class="text-center">Date</th>
                                        <th class="text-right">Per Min Salary</th>
	                                    <th class="text-center">Hours In This Day</th>
	                                    <th class="text-right">Salary In This Day</th>
	                                </tr>
	                           </thead>
	                            <tbody>
                                    <?php $Tmin = 0;$Tsalary = 0; ?>
	                                <?php foreach ($salary as $key => $value){ ?>
	                                    <tr>
	                                        <td class="text-center"><?= vd($value['date']) ?></td>
                                            <td class="text-right">
                                                <?php if($value['salary'] > 0){ ?>
                                                    <?= rs().moneyFormatIndia($value['salary'] / get_one_day($value['minute'],$employee['free_minuts'])) ?>
                                                <?php }else{ ?>
                                                    <?= rs().moneyFormatIndia(0) ?>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center"><?= $value['minute'] ?></td>
                                            <td class="text-right">
                                                <?= rs().moneyFormatIndia($value['salary']) ?>        
                                            </td>
	                                   </tr>
	                               <?php $Tmin += $value['minute']; $Tsalary += $value['salary']; } ?>
	                            </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-right">Total : </th>
                                        <th class="text-center"><?= $Tmin ?></th>
                                        <th class="text-right"><?= rs().moneyFormatIndia($Tsalary) ?></th>
                                    </tr>
                                </tfoot>
	                        </table>
	                    </div>
	                </div>
	            </div>
	        <?php } ?>
        </div>
	</div>
</section>

<style type="text/css">
    tfoot th{
        font-size: 20px;
    }
</style>