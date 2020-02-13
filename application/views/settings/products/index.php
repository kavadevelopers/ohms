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
                <form method="post" action=" <?= base_url('products/save')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add <?= $_title ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Name<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Product Name" value="<?= set_value('name') ?>" autocomplete="off" >
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price of Manufactured<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="price" placeholder="Price of Manufactured" value="<?= set_value('price') ?>" autocomplete="off" >
                                    <small><?= form_error('price'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price of Sell<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="sprice" placeholder="Price of Sell" value="<?= set_value('sprice') ?>" autocomplete="off" >
                                    <small><?= form_error('sprice'); ?></small>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus"></i> Add</button> 
                        </div>
                    </div>
                </form>
                <?php }else{ ?>

                <form method="post" action=" <?= base_url('products/update')?>">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit <?= $_title ?></h3>
                        </div>
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Product Name<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="name" placeholder="Product Name" value="<?= set_value('name',$product['name']) ?>" autocomplete="off" >
                                    <small><?= form_error('name'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price of Manufactured<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="price" placeholder="Price of Manufactured" value="<?= set_value('price',$product['price']) ?>" autocomplete="off" >
                                    <small><?= form_error('price'); ?></small>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Price of Sell<span class="astrick">*</span></label>
                                    <input class="form-control form-control-sm" type="text" name="sprice" placeholder="Price of Sell" value="<?= set_value('sprice',$product['regular_price']) ?>" autocomplete="off" >
                                    <small><?= form_error('sprice'); ?></small>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('products') ?>" class="btn btn-danger btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>

                <?php } ?>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="products">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th class="text-right">Price of Manufactured</th>
                                    <th class="text-right">Price of Sell</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                                <?php foreach ($products as $key => $product){ ?>
                                    <tr>
                                        <td><?= $product['name'] ?></td>
                                        <td class="text-right"><?= $product['price'] ?></td>
                                        <td class="text-right"><?= $product['regular_price'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('products/edit/').$product['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
                                            <a href="<?= base_url('products/delete/').$product['id'] ?>" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure want to delete this?')">Delete</a>
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
        $('#products').DataTable({
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

