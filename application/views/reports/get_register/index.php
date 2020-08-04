<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>
<form method="post" action=" <?= base_url('reports/get_register_result')?>">
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
                    		</div>
                  		</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>From Date <span class="astrick">*</span></label>
                                        <input type="text" name="fdate" class="form-control form-control-sm datepicker" placeholder="From Date" value="<?= $fdate; ?>" readonly required>
                                        <small><?= form_error('fdate'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To Date <span class="astrick">*</span></label>
                                        <input type="text" name="tdate" class="form-control form-control-sm datepicker" placeholder="To Date" value="<?= $tdate; ?>" readonly required>
                                        <small><?= form_error('tdate'); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Chalan/Invoice <span class="astrick">*</span></label>
                                        <select class="form-control form-control-sm" name="chin" required>
                                            <option value="">-- Select --</option>
                                            <option value="invoice" <?= isset($chin) && $chin == "invoice"?'selected':''; ?>>Invoce</option>
                                            <option value="chalan" <?= isset($chin) && $chin == "chalan"?'selected':''; ?>>Chalan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                	<div class="form-group">
                                		<label>Type <span class="astrick">*</span></label>
                                		<select class="form-control form-control-sm" name="type" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="1" <?= isset($type) && $type == "1"?'selected':''; ?>>Sale</option>
                                            <option value="3" <?= isset($type) && $type == "3"?'selected':''; ?>>Purchase</option>
                                        </select>
                                	</div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

<?php if(isset($result)){ ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-sm dt" id="sales">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Chalan/Invoice No.</th>
                                    <th class="">Client</th>
                                    <th class="text-right">Bill Amount</th>
                                    <?php if($chin == 'invoice'){ ?>
                                        <th class="text-right">Tax Amount</th>
                                    <?php } ?>
                                    <th class="text-right">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; $tax = 0; $gross = 0; ?>
                                <?php foreach ($result as $key => $value) { ?>
                                    <tr>
                                        <td class="text-center"><?= vd($value['date']) ?></td>
                                        <td class="text-center">
                                            <?php if($type == '1'){ ?>
                                                <a href="<?= base_url('sales/edit/').$value['tra_id'] ?>" target="_blank">
                                                    <?= $this->general_model->getRegisterInvoice($type,$chin,$value['tra_id']); ?>
                                                </a>
                                            <?php }else{ ?>
                                                <a href="<?= base_url('purchase/edit/').$value['tra_id'] ?>" target="_blank">
                                                    <?= $this->general_model->getRegisterInvoice($type,$chin,$value['tra_id']); ?>
                                                </a>
                                            <?php } ?>
                                        </td>
                                        <td><?= $this->general_model->_client($value['client'])['name'] ?></td>
                                        <td class="text-right">
                                            <?= moneyFormatIndia($this->general_model->getRegisterGross($type,$chin,$value['tra_id'])); ?>
                                        </td>
                                        <?php if($chin == 'invoice'){ ?>
                                            <td class="text-right">
                                                <?= moneyFormatIndia($this->general_model->getRegisterTax($type,$chin,$value['tra_id'])); ?>
                                            </td>
                                        <?php } ?>
                                        <td class="text-right">
                                            <?= moneyFormatIndia($this->general_model->getRegisterTotal($type,$chin,$value['tra_id'])); ?>
                                        </td>
                                    </tr>
                                    <?php $total += $this->general_model->getRegisterTotal($type,$chin,$value['tra_id']); ?>
                                    <?php $tax += $this->general_model->getRegisterTax($type,$chin,$value['tra_id']); ?>
                                    <?php $gross += $this->general_model->getRegisterGross($type,$chin,$value['tra_id']); ?>
                                <?php } ?>    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th class="text-right">Total : </th>
                                    <th class="text-right"><?= moneyFormatIndia($gross); ?></th>
                                    <?php if($chin == 'invoice'){ ?>
                                        <th class="text-right"><?= moneyFormatIndia($tax); ?></th>
                                    <?php } ?>
                                    <th class="text-right"><?= moneyFormatIndia($total); ?></th>
                                </tr> 
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<script type="text/javascript" language="javascript" >  
 $(function(){ 
    $('#sales').DataTable({
            "paging": false,
           "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l>>",
           buttons: [ 
                { 
                    extend: 'print',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    },
                    footer: true
                },
                { 
                    extend: 'pdf',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    },
                    footer: true
                },
                { 
                    extend: 'excel',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    },
                    footer: true
                }
                
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [0,1,2,3,4,5] 
                }
            ] 
        });  
        $('a[target^="_blank"]').click(function() {
            return openWindow(this.href);
        });
    });

 function openWindow(url) {

    if (window.innerWidth <= 640) {
        // if width is smaller then 640px, create a temporary a elm that will open the link in new tab
        var a = document.createElement('a');
        a.setAttribute("href", url);
        a.setAttribute("target", "_blank");

        var dispatch = document.createEvent("HTMLEvents");
        dispatch.initEvent("click", true, true);

        a.dispatchEvent(dispatch);
    }
    else {
        var width = window.innerWidth * 0.66 ;
        // define the height in
        var height = width * window.innerHeight / window.innerWidth ;
        // Ratio the hight to the width as the user screen ratio
        window.open(url , 'newwindow', 'width=' + width + ', height=' + height + ', top=' + ((window.innerHeight - height) / 2) + ', left=' + ((window.innerWidth - width) / 2));
    }
    return false;
}
</script>