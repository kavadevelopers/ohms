<?php 

    $user  = $this->session->userdata('id');
    $user = $this->auth->get_admin($user);



    function menu($path,$array)
    {
        foreach($array as $a)
        {
            if($path === $a)
            {
                print_r(array("active","menu-open",));
                break;  
            }
        }
    }
?> 
    
    <style type="text/css">
        .nav-treeview .nav-item a{
            font-style: italic;
            font-size: 14px;
        }

        ::placeholder {
              color: #a3a4a5 !important;
              font-weight: 700;
              opacity: 1;
        }
    </style>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    
        <a href="<?= base_url('dashboard'); ?>" class="brand-link text-center">
            
            <span class="brand-text font-weight-light">
                <?= $this->config->config["projectName"]; ?>        
            </span>
         
        </a>

    
        <div class="sidebar">
      
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= base_url(); ?><?=$this->config->config["logoFile"]?>" style="width: 40px; height:40px;" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">
                        <?= $user->name; ?>        
                    </a>
                    <span style="color: #c2c7d0;">
                        <small>
                            <?php
                                if($user->user_type == 'user')
                                {
                                    echo "User";
                                }
                                else if($user->user_type == 'admin')
                                {
                                    echo "Admin";
                                }
                            ?>
                        </small>
                    </span>
                </div>
            </div>

      
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
                    <li class="nav-item">
                        <a href="<?= base_url('dashboard'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("dashboard"))[0]; ?>">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("products","clients","prod_pricing","employees"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("products","clients","prod_pricing","employees"))[0]; ?>">
                            <i class="nav-icon fa fa-gear"></i>
                            <p>Settings
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">
                            
                            <li class="nav-item">
                                <a href="<?= base_url('products'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("products"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Products
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('clients'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("clients"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Clients
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('prod_pricing'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("prod_pricing"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Products Price
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('employees'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("employees"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Employees
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    
                    

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("sales","salespayments"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("sales","salespayments"))[0]; ?>">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>Sales
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('sales'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("sales"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Sales
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('salespayments'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("salespayments"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Sale Payments
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("purchase","purchasepay"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("purchase","purchasepay"))[0]; ?>">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>Purchase
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('purchase'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("purchase"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Purchase
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('purchasepay'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("purchasepay"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Purchase Payments
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("loans"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("loans"))[0]; ?>">
                            <i class="nav-icon fa fa-money"></i>
                            <p>Loan
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('loans'); ?>" class="nav-link <?php menu($this->uri->segment(1),array("loans"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Loan
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("salary","increment_salary"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("salary","increment_salary"))[0]; ?>">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Salary
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="<?= base_url('salary/monthly'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'salary'){ menu($this->uri->segment(2),array("monthly"))[0]; } ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Monthly Salary
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('salary/attendance'); ?>" class="nav-link <?php menu($this->uri->segment(2),array("attendance"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Attendance
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('increment_salary'); ?>" class="nav-link <?php if($this->uri->segment(2) != 'report'){ menu($this->uri->segment(1),array("increment_salary"))[0]; } ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Salary Increment
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="<?= base_url('increment_salary/report'); ?>" class="nav-link <?php if($this->uri->segment(1) == 'increment_salary'){ menu($this->uri->segment(2),array("report"))[0]; } ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Increment Report
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?php menu($this->uri->segment(1),array("reports"))[1]; ?>">
            
                        <a href="#" class="nav-link <?php menu($this->uri->segment(1),array("reports"))[0]; ?>">
                            <i class="nav-icon fa fa-flag"></i>
                            <p>Reports
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="<?= base_url('reports/ledger'); ?>" class="nav-link <?= menu($this->uri->segment(2),array("ledger","ledger_result"))[0]; ?>">
                                    <i class="nav-icon fa fa-circle-o"></i>
                                    <p>
                                        Ledger
                                    </p>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('dashboard/logout'); ?>" class="nav-link ">
                            <i class="nav-icon fa fa-sign-out"></i>
                            <p>
                                Sign Out
                            </p>
                        </a>
                    </li>
        
                </ul>
            </nav>
        </div>
    </aside>

  
    <div class="content-wrapper">
