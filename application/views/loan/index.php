<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                	<div class="card-header">
                		<div class="row">
	                		<div class="col-md-6">
	                			<h3 class="card-title"><?=  $_title; ?></h3>	
	                		</div>
	                		<div class="col-md-6 text-right">
	                			<a href="<?= base_url('loans/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
	                		</div>
                		</div>
              		</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" id="loan">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th>Loan No.</th>
                                        <th>Bank Name</th>
                                        <th>Remarks</th>
                                        <th class="text-center">Installments</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($loans as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= vd($value['date']); ?></td>
                                            <td><?= $value['loan_no']; ?></td>
                                            <td><?= $value['bank']; ?></td>
                                            <td><?= nl2br($value['remarks']); ?></td>
                                            <td class="text-center"><?= $value['installments']; ?></td>
                                            <td style="text-align: center;">
                                                <a href="<?= base_url('loans/view/').$value['id'] ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="<?= base_url('loans/delete/').$value['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this?');"><i class="fa fa-trash"></i></a>
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
    </div>
</section>

<script type="text/javascript">
    $(function(){
        $('#loan').DataTable({
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [1] 
                }
            ] 
        });
    });
</script>