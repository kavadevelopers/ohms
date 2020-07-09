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
                                        <th class="text-center">Chalan/Invoce</th>
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
                                    <?php foreach ($loop as $key => $value) { ?>
                                        <?php $_salary = $this->db->get_where('salary',['date' => $value,'emp_id' => $employee])->row_array();  ?>
                                        <?php if($_salary && $_salary['salary'] > 0.00){ ?>
                                            <tr>
                                                <td class="text-center"><?= vd($value) ?></td>
                                                <th>Salary</th>
                                                <td class="text-center">
                                                    -
                                                </td>
                                                <td class="text-right"></td>
                                                <td class="text-right"><?= moneyFormatIndia($_salary['salary']); ?></td>
                                                <?php $credit_total += $_salary['salary']; ?>
                                            </tr>    
                                        <?php } ?>
                                        <?php $_paymentw = $this->db->get_where('transactions_w',['date' => $value,'client' => $employee,'type' => tsalarypay()])->row_array();  ?>
                                        <?php if($_paymentw && $_paymentw['credit'] > 0.00){ ?>
                                            <tr>
                                                <td class="text-center"><?= vd($value) ?></td>
                                                <th>Payment</th>
                                                <td class="text-center">
                                                    Invoice
                                                </td>
                                                <td class="text-right"><?= moneyFormatIndia($_paymentw['credit']); ?></td>
                                                <td class="text-right"></td>
                                                <?php $debit_total += $_paymentw['credit']; ?>
                                            </tr>    
                                        <?php } ?>
                                        <?php $_paymentb = $this->db->get_where('transactions_b',['date' => $value,'client' => $employee,'type' => tsalarypay()])->row_array();  ?>
                                        <?php if($_paymentb && $_paymentb['credit'] > 0.00){ ?>
                                            <tr>
                                                <td class="text-center"><?= vd($value) ?></td>
                                                <th>Payment</th>
                                                <td class="text-center">
                                                    Chalan
                                                </td>
                                                <td class="text-right"><?= moneyFormatIndia($_paymentb['credit']); ?></td>
                                                <td class="text-right"></td>
                                                <?php $debit_total += $_paymentb['credit']; ?>
                                            </tr>    
                                        <?php } ?>
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