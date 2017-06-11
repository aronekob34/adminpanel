<div class="content-wrapper" style="min-height: 946px;">    <!-- Content Header (Page header) -->    <section class="content-header">        <h1><?php echo $page_title; ?></h1>        <?php echo $breadcrumb; ?>    </section>    <!-- Main content -->    <section class="content">        <div class="row">            <div class="box-body">                <div class="col-md-6">                    <div id="errorsDiv"></div>                    <?php if ( validation_errors() ): ?>                        <div class="alert alert-danger alert-dismissible" role="alert">                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            <?php echo validation_errors('<p>', '</p>'); ?>                        </div>                    <?php endif; ?>                    <?php if ( $this->session->flashdata('errors') ): ?>                        <div class="alert alert-danger alert-dismissible" role="alert">                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            <?php echo $this->session->flashdata('errors') ?>                        </div>                    <?php endif; ?>                    <?php if ( $this->session->flashdata('success') ): ?>                        <div class="alert alert-success alert-dismissible" role="alert">                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            <?php echo $this->session->flashdata('success'); ?>                        </div>                    <?php endif; ?>                    <?php if ( $this->session->flashdata('delete') ): ?>                        <div class="alert alert-warning alert-dismissible" role="alert">                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            <?php echo $this->session->flashdata('delete'); ?>                        </div>                    <?php endif; ?>                    <?php if ( $this->session->flashdata('update') ): ?>                        <div class="alert alert-warning alert-dismissible" role="alert">                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>                            <?php echo $this->session->flashdata('update'); ?>                        </div>                    <?php endif; ?>                </div>              </div>        </div>        <div class="row">            <!-- right column -->            <div class="col-md-12">                <!-- Horizontal Form -->                <div class="box box-info">                    <div class="box-header with-border">                        <h3 class="box-title"></h3>                    </div><!-- /.box-header -->                    <!-- form start -->                        <div class="box-body">                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url() . "interventions/addnew"; ?>">                            <div class="col-sm-12 col-md-12 col-lg-12" >                                 <div class="col-sm-12 col-md-6">                                    <label for="title"><h3>Intervention Name:</h3></label>                                    <input type="text"  name="intervention_name"  class="form-control"                                           placeholder="Intervention Name"  value="<?php echo set_value('intervention_name', ''); ?>">                                </div>                                <div class="col-sm-12 col-md-3">                                    <div class="bootstrap-timepicker">                                        <label><h3>Intervention Date:</h3></label>                                        <div class="input-group">                                            <div class="input-group-addon">                                                <i class="fa fa-calendar"></i>                                            </div>                                            <input type="text" class="form-control pull-right" placeholder="Intervetion Date" name="intervention_date" id="intervention_date" value="<?php echo set_value('intervention_date')?>">                                        </div>                                    </div>                                </div>                            </div><div class="clearfix"></div>                            <br>                        <div class="box-footer">                            <button type="submit" class="btn btn-info pull-left">Save</button> &nbsp;                        </div><!-- /.box-footer -->                                              <div class="clearfix"></div>                    </form>                </div><!-- /.box -->                <!-- general form elements disabled -->            </div><!--/.col (right) -->        </div>   <!-- /.row -->    </section><!-- /.content --></div>       