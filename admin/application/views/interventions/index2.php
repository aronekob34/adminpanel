<div class="content-wrapper">
    <!-- Content Header (Page header) show breads crumb-->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Expense</a></li>
            <li class="active">View All</li>
        </ol>
    </section>


    <section class="content ">   

<!--show the common messages to all-->

        <div class="row">


            <div class="box-body" style="overflow:scroll">
                <div class="col-md-6">
                    <div id="errorsDiv"></div>
                    <?php if (validation_errors()): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo validation_errors('<p>', '</p>'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('errors')): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('errors') ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('delete')): ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('delete'); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->session->flashdata('update')): ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $this->session->flashdata('update'); ?>
                        </div>
                    <?php endif; ?>
                </div>  
            </div>
        </div>


      
                <div class="panel panel-success">
                    <div class="panel-body box box-info">

                        <div class="panel-heading">
                            <ul  class="nav nav-pills">
                                <li class="<?php echo validation_errors() ? '' : 'active'; ?>">
                                    <a  href="#1b" data-toggle="tab">View all</a>
                                </li>
                                
                                
                            </ul>
                        </div>

                        <div class="tab-content clearfix">


<div class="row" style="border:1px solid #eee;padding:10px;">

<form action="<?php echo base_url("Expense/viewall");?>" method="post" onsubmit="return myFunction();"> 
        <div class="col-sm-12 col-md-3">
        <label>Sort By type</label>
        <select class="form-control"  id="expense_type" name="expense_type">
        <option value="" >--Please select--</option>

        <?php 
        if(!empty($exp_t)):
        foreach($exp_t as $value):
        ?>
        <option value="<?php echo  $value->title; ?>" <?php if($value->title == @$expense_type_checked){ echo "selected"; } ?> ><?php echo  $value->title; ?></option>

        <?php
        endforeach;
        endif;
        ?>

        </select> 
        </div>
        <div class="col-sm-12 col-md-3">
        <label>Sort By month</label>
        <select class="form-control"  id="month" name="month">
        <option value="" >--Please select--</option>

        <?php 
        $exp_t3434= array(

        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'Octobor',
        'November',
        'December'

        );
        if(!empty($exp_t3434)):
        foreach($exp_t3434 as $key=>$value):
        ?>
        <option value="<?php echo  $value; ?>" <?php if($value == @$created_month_checked){ echo "selected"; } ?> ><?php echo  $value; ?></option>

        <?php
        endforeach;
        endif;
        ?>

        </select> 
        </div>
        <div class="col-sm-12 col-md-3">
        <label>Sort By year</label>
        <select class="form-control"  name="year">

        <?php 
        $exp_t2= array(2010,2011,2013,2014,2015,2016,2017,2018,2019,2020,2021 );
        $created_year_checked=2016;
        if($created_year_checked2){
        $created_year_checked=$created_year_checked2;
        }
        
        if(!empty($exp_t2)):
        foreach($exp_t2 as $key=>$value):
        ?>
        <option value="<?php echo  $value; ?>" <?php if($value == @$created_year_checked)echo "selected";?>><?php echo  $value; ?></option>

        <?php
        endforeach;
        endif;
        ?>

        </select> 
        </div>

        <div class="col-sm-12 col-md-3">
        <lable>&nbsp;</lable>
        <input class="btn btn-block btn-info btn-lg" type="submit" name='Filter' value="Filter Now" />
        </div>

     </form>
</div>



<div class="clearfix"></div><br> 

<div class="tab-pane <?php echo validation_errors() ? '' : 'active'; ?>" id="1b" style="overflow:scroll;">
    <table id="example1" class="table table-striped table-bordered"   cellspacing="0" width="100%" style="overflow:scroll;">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Unite Price</th>
                                            <th>Tax Total</th>
                                            <th>Total</th>
                                            <th>created date</th>
                                            <th>Issue date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                       // print_r($all_data);
                                        if (isset($all_data)) {
                                            //print_r($all_data);
                                            foreach (array_reverse($all_data) as $value) {
                                                ?>

                                                <tr>

                                                    <td>
                                                        <p><?= $value->item ?> </p>
                                                    </td>
                                                    <td>
                                                        <p><?= $value->expense_type ?> </p>
                                                    </td>

                                                    <td>
                                                        <p><?= "$ ".round($value->unite_price,2) ?> </p>
                                                    </td>
                                                     <td>
                                                        <p><?= "$ ".round($value->tax_total,2) ?> </p>
                                                    </td>
                                                    <td>
                                                        <p> <b>= <?= "$ ".@ round(($value->unite_price+$value->tax_total),2) ?> </b></p>
                                                    </td>
                                                    <td>
                                                        <p><?= @$value->created_date ?> </p>
                                                    </td>
                                                    <td>
                                                        <p><?= @date('Y-m-d',strtotime($value->issues_date)) ?> </p>
                                                    </td>
                                                   
                                                  
                                                </tr>	
                                                <?php
                                            }
                                        }
                                        ?>


                                    </tbody>
                                </table>

                            </div>


                            <div class="tab-pane <?php echo validation_errors() ? 'active' : ''; ?>" id="2b">
                                <div class="col-md-8">
                                    <form class=" "  method="post" enctype="multipart/form-data" action="<?php echo base_url() . "Settings/category"; ?>">

                                        <div class="col-lg-8 col-sm-8 col-md-8">

                                            <label for="title">Title:</label>

                                            <input type="text"  name="title" required class="form-control"
                                                   placeholder="Title Name"  value="<?php echo set_value('title', ''); ?>">

                                        </div><div class="clearfix"></div><br>

                                       
                                 
                                  
                                    
                                        <div class="col-lg-8 col-sm-8 col-md-8">

                                            <label for="title">Category Color:</label>
                                            <input type='text' id="custom" onchange="change_color()" name="color_cat1" value="#f00"/>
                                         
                                            
                                        </div><div class="clearfix"></div><br>   
                                    
                                        <br/>
                                        <div class="col-lg-8 col-sm-8 col-md-8">

                                            <button class="btn btn-lg btn-primary btn-block" type="submit" >Submit</button>
                                        </div>
                                    </form>

                                </div>

                            </div>



                        </div>
                    </div>

            <!-- Modal view -->
            <div id="view" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Title</h4>
                        </div>
                        <div class="modal-body">
                            <p id="append_view_data"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Modal view -->
            <div id="edit" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit Title</h4>
                        </div>
                        <form action="<?= base_url() . 'Category/update' ?>" method="post" onsubmit="return update_data_title()" >
                            <div class="modal-body">

                                <input type="text" required id="append_edit_data" name="update_input" style="width:300px;padding:5px;" />
                                <input type="hidden" name="update_id" id="update_id" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default" >Submit</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>


            <!-- Main content -->
        </div>
    </section>
</div>

