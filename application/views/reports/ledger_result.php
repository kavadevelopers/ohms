<title><?=  $_title; ?> | <?= $this->config->config["projectTitle"] ?></title>

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                	<div class="card-header">
                		<div class="row">
	                		<div class="col-md-12">
	                			<h3 class="card-title"><?=  $_title; ?></h3>	
	                		</div>
                		</div>
              		</div>
              		<?php $credit_total = 0;$debit_total = 0; ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm" id="sales">
                                <thead>
                                    <tr>
                                        <th class="text-center">Date</th>
                                        <th>Particulars</th>
                                        <th class="text-center">Vch No.</th>
                                        <th class="text-right">Debit</th>
                                        <th class="text-right">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td class="text-center"><?= vd($date) ?></td>
                                            <th>Opening Balance</th>
                                            <td class="text-center">
                                                -
                                            </td>
                                            <?php if($opening[0] == 'c'){ ?>
                                                <td class="text-right"><?= moneyFormatIndia($opening[1]) ?></td>
                                                <td class="text-right"></td>
                                                <?php $debit_total += $opening[1]; ?>
                                            <?php }else{ ?>
                                                <td class="text-right"></td>
                                                <td class="text-right"><?= moneyFormatIndia($opening[1]) ?></td>
                                                <?php $credit_total += $opening[1]; ?>
                                            <?php } ?>
                                        </tr>
                                	<?php foreach($list as $key => $value){ ?>
	                                	<tr>
	                                		<td class="text-center"><?= vd($value['date']) ?></td>
	                                		<th><?= typestring($value['type']) ?></th>
                                            <td class="text-center">
                                                <?= vch_no($value['type'],$value['tra_id'],$type) ?>
                                            </td>
	                                		<td class="text-right"><?= ledamtd($value['debit'],$value['credit']) ?></td>
	                                		<td class="text-right"><?= ledamtc($value['debit'],$value['credit']) ?></td>
	                                	</tr>
	                                	<?php $credit_total += tledamtc($value['debit'],$value['credit']); ?>
	                                	<?php $debit_total += tledamtd($value['debit'],$value['credit']); ?>
                                	<?php } ?>

                                		<tr>
	                                		<td class="text-right"></td>
                                            <td class="text-right"></td>
                                			<td class="text-right"></td>
	                                		<td class="text-right"><?= moneyFormatIndia($debit_total) ?></td>
	                                		<td class="text-right"><?= moneyFormatIndia($credit_total) ?></td>
                                		</tr>

                                	<?php if($credit_total > $debit_total){ ?>
                                		<tr>
                                            <td class="text-right"></td>
                                			<td class="text-right"></td>
                                			<td class="text-right">Cr Closing Balance</td>
	                                		<td class="text-right"><?= moneyFormatIndia($credit_total - $debit_total) ?></td>
                                			<td class="text-right"></td>
                                		</tr>
                                	<?php } ?>

                                	<?php if($credit_total < $debit_total){ ?>
                                		<tr>
                                            <td class="text-right"></td>
                                			<td class="text-right"></td>
                                			<td class="text-right">Dr Closing Balance</td>
                                			<td class="text-right"></td>
	                                		<td class="text-right"><?= moneyFormatIndia($debit_total - $credit_total) ?></td>
                                		</tr>
                                	<?php } ?>

	                            		<tr>
                                            <td class="text-right"></td>
	                            			<td class="text-right"></td>
	                            			<th class="text-right">Total</td>
	                            			<th class="text-right">
	                                			<?= max(moneyFormatIndia($debit_total),moneyFormatIndia($credit_total)) ?>
	                                		</th>
	                                		<th class="text-right">
	                                			<?= max(moneyFormatIndia($debit_total),moneyFormatIndia($credit_total)) ?>
	                                		</th>
	                            		</tr>

                                </tbody>
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
    $('#sales').DataTable({
    		"paging": false,
           "dom": "<'row'<'col-md-12 my-marD'B>><'row'<'col-md-6'l>>",
           buttons: [ 
                { 
                    extend: 'print',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'pdf',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { 
                    extend: 'excel',
                    title: '<?= $_title ?>',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                }
                
            ],
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "columnDefs": [
                { 
                    "orderable": false, 
                    "targets": [0,1,2,3] 
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