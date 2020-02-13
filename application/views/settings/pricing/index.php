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
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-sm" id="clients">
                            <thead>
                                <tr>
                                    <th>Client Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                           </thead>
                            <tbody>
                                <?php foreach ($clients as $key => $client){ ?>
                                    <tr>
                                        <td><?= $client['name'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('prod_pricing/edit/').$client['id'] ?>" class="btn btn-xs btn-primary">Change Prices</a>
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
                    "targets": [1] 
                }
            ] 
        });
    });
</script>

