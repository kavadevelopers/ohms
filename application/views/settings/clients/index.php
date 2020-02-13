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
                <form method="post" action=" <?= base_url('clients/save')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add <?= $_title ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Name<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Client Name" value="<?= set_value('name') ?>" autocomplete="off" >
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
                                    <label>Client Type<span class="astrick">*</span></label>
                                    <select class="form-control form-control-sm" name="type">
                                        <option value="Sales" <?= set_value('type') == "Sales"?'selected':''; ?>>Sales</option>
                                        <option value="Purchase" <?= set_value('type') == "Purchase"?'selected':''; ?>>Purchase</option>
                                    </select>
                                    <small><?= form_error('type'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Challan Opening Balance<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="chalan_opening" placeholder="Challan Opening Balance" value="<?= set_value('chalan_opening') ?>" autocomplete="off" >
                                    <small><?= form_error('chalan_opening'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Invoice Opening Balance<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="invoice_opening" placeholder="Invoice Opening Balance" value="<?= set_value('invoice_opening') ?>" autocomplete="off" >
                                    <small><?= form_error('invoice_opening'); ?></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add</button> 
                        </div>
                    </div>
                </form>
                <?php }else{ ?>

                <form method="post" action=" <?= base_url('clients/update')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit <?= $_title ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Name<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Client Name" value="<?= set_value('name',$client['name']) ?>" autocomplete="off" >
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
                                    <label>Client Type<span class="astrick">*</span></label>
                                    <select class="form-control form-control-sm" name="type">
                                        <option value="Sales" <?= set_value('type',$client['type']) == "Sales"?'selected':''; ?>>Sales</option>
                                        <option value="Purchase" <?= set_value('type',$client['type']) == "Purchase"?'selected':''; ?>>Purchase</option>
                                    </select>
                                    <small><?= form_error('type'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Challan Opening Balance<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="chalan_opening" placeholder="Challan Opening Balance" value="<?= set_value('chalan_opening',$client['challan_opening']) ?>" autocomplete="off" >
                                    <small><?= form_error('chalan_opening'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Invoice Opening Balance<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="invoice_opening" placeholder="Invoice Opening Balance" value="<?= set_value('invoice_opening',$client['invoice_opening']) ?>" autocomplete="off" >
                                    <small><?= form_error('invoice_opening'); ?></small>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $client['id'] ?>">
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('clients') ?>" class="btn btn-danger btn-sm">Cancel</a>
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
                                    <th>Client Name</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                                <?php foreach ($clients as $key => $client){ ?>
                                    <tr>
                                        <td><?= $client['name'] ?></td>
                                        <td class="text-center"><?= $client['mobile'] ?></td>
                                        <td class="text-center"><?= $client['type'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('clients/edit/').$client['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
                                            <a href="<?= base_url('clients/delete/').$client['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this?')">Delete</a>
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
                    "targets": [3] 
                }
            ] 
        });
    });
</script>

