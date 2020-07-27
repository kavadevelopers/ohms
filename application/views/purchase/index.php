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
	                			<a href="<?= base_url('purchase/add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
	                		</div>
                		</div>
              		</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" id="purchase">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Invoice No.</th>
                                        <th>Challan No.</th>
                                        <th>Client</th>
                                        <th>Challan</th>
                                        <th>Invoice</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" language="javascript" >  
 $(function(){ 
    $('#purchase').DataTable({
         "processing":true, 
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            }, 
           "serverSide":true, 
           "paging": false,
           "ajax":{  
                url:"<?php echo base_url() . 'purchase/get_purchase'; ?>",  
                type:"POST"  
           },
           "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l>><'row'<'col-md-12'tr>><'row'<'col-md-6'i><'col-md-6'p>>",
           buttons: [ 
                { 
                    extend: 'print',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?= $_title ?>',
                    exportOptions: {

                        columns: [0,1,2,3,4,5]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                }
                
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [0,1,2,3,4,5,6] 
                },{
                    "targets": [4,5],
                    "className": "text-right",
                },{
                    "targets": [0,1,2,6],
                    "className": "text-center",
                }
            ] 
        });  
    });
</script>