    <title><?=$this->config->config["projectTitle"]?> | <?php echo $_title; ?></title>

   	<div class="content-header">
      	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h1 class="m-0 text-dark">Welcome To OHMS</h1>
          		</div>
        	</div>
      	</div>
    </div>

    <?php
    $this->db->order_by('id','asc');
    $this->db->limit(25);
    $this->db->where('date <' , date("Y-m-d", strtotime("-25 days")));
    $old25_invoices = $this->db->get('sales')->result_array();
    ?>

    <section class="content">
      	<div class="container-fluid">
      	     <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Invoice Balance</span>
                            <span class="info-box-number"><?= rs().moneyFormatIndia($this->general_model->get_total_invoice()) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fa fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Chalan Balance</span>
                            <span class="info-box-number"><?= rs().moneyFormatIndia($this->general_model->get_total_chalan()) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">25 days old Invoices</h3>    
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-sm dt">
                                <thead>
                                    <tr>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Invoice-Chalan</th>
                                        <th>Client Name</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($old25_invoices as $key => $value) { ?>
                                        <tr>
                                            <td class="text-center"><?= $value['invoice'] != ""?"Invoice":"Chalan" ?></td>
                                            <td class="text-center"><?= vd($value['date']) ?></td>
                                            <td class="text-center"><?= $value['invoice'].'-'.$value['chalan'] ?></td>
                                            <td>
                                                <?php $sale_client = $this->db->get_where('clients',['id' => $value['client_id']])->row_array() ?>
                                                <?= $sale_client['name'].'- <small><b>('.$sale_client['mobile'].'</small></b>)' ?>
                                            </td>
                                            <td class="text-center"><?= rs().$value['net_invoice'].' - '.rs().$value['challan_total'] ?></td>
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
            $('.dt').DataTable({
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


