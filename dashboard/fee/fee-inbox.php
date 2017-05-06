<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Management System - SMS | School Inbox</title>
    <?php include '../includes/headteacher.php'; ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
   
</head>

<body>
    <!-- Preloader -->
    <!--<div class="preloader">
<div class="cssload-speeding-wheel"></div>
</div>-->
    <div id="wrapper">        
           <?php include'../includes/header-fee.php'; ?>        
        <!-- Left navbar-header -->
        <?php include'../includes/sidebar-fee.php'; ?>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper" class="bg-texture">
            <div>
                <div id="clouds">
                    <div class="cloud x1"></div>
                    <!-- Time for multiple clouds to dance around -->
                    <div class="cloud x2"></div>
                    <div class="cloud x3"></div>
                    <div class="cloud x4"></div>
                    <div class="cloud x5"></div>
                </div>

            </div>

            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <h4 class="page-title"><span>News & Notifications – admission for 2017-2018 Starting from 15 November 2016.</span></h4>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <ol class="breadcrumb">
                            <li>
                                <a href="javascript:void(0);">School</a>
                            </li>
                            <li class="active">Messages</li>
                        </ol>
                    </div>

                </div>

                <!--inbox st-->
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="my-box">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="inbox-center table-responsive">
            <table class="table table-hover" border="0">
            <thead>
            <tr><th width="30">
            <div class="checkbox m-t-0 m-b-0">
            <input id="checkbox0" class="checkbox-toggle" value="check all" type="checkbox">
            <label for="checkbox0"></label>
            </div>
            </th>
            <th colspan="4">
            <div class="btn-group drop-down">
               <select class="form-control no-style"> 
                   <option>Read</option>
                   <option>Unread</option>
                   <option>Delete</option>
                </select>
            </div>

            <div class="btn-group">
            <a href="" class="btn btn-default waves-effect waves-light border-round">
                <span class="fa fa-refresh"></span>
            </a>
            </div>
            
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-dafault btn-color waves-effect waves-light border-round" data-toggle="modal" data-target="#myCompose">New Message 
                <span class="fa fa-pencil-square-o"></span> 
                </button>
            </div>
            
            <button type="button" class="btn btn-info waves-effect waves-light border-round pull-right btn-trash">Trash 
            <span class="fa fa-trash"></span> 
            </button>    
            </th>

            <th>
            <nav aria-label="Page navigation" class="pull-left">
            <ul class="pagination page">
            <li><a href="#">1-50 of 624</a></li>
            </ul>
            </nav>
            <div class="dropdown pull-left">
            <a href="#" class="btn dropdown-toggle btn-caret" data-toggle="dropdown" data-placement="right">
            <strong class="caret"></strong>
            </a>
            <ul class="dropdown-menu drop-menu">
            <li class="dropdown-header">Show up to:</li>
            <li class="divider"></li>
            <li>
            <a href="#">5 items</a>
            </li> 
            <li>
            <a href="#">10 items</a>
            </li> 
            <li>
            <a href="#">15 items</a>
            </li> 
            <li>
            <a href="#">20 items</a>
            </li> 
            </ul>
            </div>
            </th>
            </tr></thead>
            <tbody>
            <tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open1" style="cursor: pointer;">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle" type="checkbox">
            <label for="checkbox0"></label>    
            </div>
            </td>            
            <td class="max-texts bold-text" colspan="2">
            <a href="javascript:void(0);"><span class="btn-link btn-name"><strong>Chirag Sharma</strong></span> <span class="label label-info m-r-10">Admin</span> Regarding Report card...</a>
            </td>

            <td colspan="3" class="bold-text"><span>11/Nov/2016</span> 12:30 PM</td>
            </tr>
            <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open1">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Chirag Sharma</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->    

            <tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open2" style="cursor: pointer;">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle" type="checkbox">
            <label for="checkbox0"></label>
            </div>
            </td>
            <td class="max-texts" colspan="2">
            <a href="javascript:void(0);"><span class="btn-link btn-name">Raman Singh</span> <span class="label label-success m-r-10">Principal</span> Lorem ipsum perspiciatis unde omnis iste natus error sit voluptatem</a>
            </td>

            <td colspan="3">
            <span>11/Nov/2016</span> 01:22 PM
            </td>
            </tr>
             <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open2">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Raman Singh</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->        

            <tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open3" style="cursor: pointer;">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle" type="checkbox">
            <label for="checkbox0"></label>
            </div>
            </td>
            
            <td class="max-texts" colspan="2">
            <a href="javascript:void(0);"><span class="btn-link btn-name">Aman Sharma</span><span class="label label-success m-r-10">Principal</span> Lorem ipsum perspiciatis unde omnis iste natus error sit voluptatem</a>
            </td>

            <td colspan="3">
            <span>11/Nov/2016</span> 10:22 AM
            </td>
            </tr>
             <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open3">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Aman Sharma</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->        
            <tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open4">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle" type="checkbox">
            <label for="checkbox0"></label>    
            </div>
            </td>            
            <td class="max-texts" colspan="2">
            <a href="javascript:void(0);"><span class="btn-link btn-name">Gaurav Pandey</span> <span class="label label-info m-r-10">Admin</span> Lorem ipsum perspiciatis unde omnis iste natus error sit voluptatem</a>
            </td>

            <td colspan="3"><span>11/Nov/2016</span> 12:30 PM</td>
            </tr>
                
             <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open4">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Gaurav Pandey</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->        
            <tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open5" style="cursor: pointer;">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle" type="checkbox">
            <label for="checkbox0"></label>
            </div>
            </td>
           
            <td class="max-texts" colspan="2">
            <a href="javascript:void(0);"><span class="btn-link btn-name">Puneet Singh</span> <span class="label label-success m-r-10">Teacher</span> Lorem ipsum perspiciatis unde omnis iste natus error sit voluptatem</a>
            </td>

            <td colspan="3">
            <span>11/Nov/2016</span> 01:22 PM
            </td>
            </tr>
                 <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open5">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Puneet Singh</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->    
            <tr class="unread accordion-toggle" data-toggle="collapse" data-target="#message-open6">
            <td>
            <div class="checkbox m-t-0 m-b-0">
            <input class="checkbox-toggle" type="checkbox">
            <label for="checkbox0"></label>
            </div>
            </td>
            
            <td class="max-texts" colspan="2">
            <a href="javascript:void(0);"><span class="btn-link btn-name">Aman Sharma</span> <span class="label label-info m-r-10">Admin</span> Lorem ipsum perspiciatis unde omnis iste natus error sit voluptatem</a>
            </td>

            <td colspan="3">
            <span>11/Nov/2016</span> 10:22 AM
            </td>
            </tr>
            
                 <!--open st-->
            <tr>
                <td colspan="6" class="hiddenRow">
                    <div class="panel panel-default accordian-body collapse" id="message-open6">
                    <div class="panel-heading text-right">
                            <a href="#" data-toggle="modal" data-target="#myReply" class="btn btn-default btn-color">
                            Reply <span class="fa fa-share"></span></a>
                    </div>
                    <div class="panel-wrapper">
                      <div class="panel-body">
                        <div class="row message-gap">  
                            <div class="sender col-sm-12 left-arrow pull-left"> 
                                <p class="info-user">
                                    <strong class="pull-left">Admin</strong>
                                    <span class="pull-right">11/Nov-2016 7:10PM</span>
                                </p>    
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                                <strong class="text-left btn-block">Attachment:  <a href="#"><span class="fa fa-download"></span> Report card</a></strong>
                            </div>    
                          </div>

                          <div class="row message-gap">
                              <div class="receiver col-sm-12 right-arrow pull-right">  
                                <p class="info-user">
                                    <span class="pull-left">11/Nov-2016 7:10PM</span>
                                    <strong class="pull-right">Aman Sharma</strong>
                                </p>
                                <p class="text-justify para-space">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                              </div>
                          </div>      
                      </div>
                    </div>
                  </div>
                </td>
            </tr>
            <!--open en-->     
            </tbody>

            <tfoot>
                <tr>
                    <th width="30">
                    <div class="checkbox m-t-0 m-b-0">
                    <input id="checkbox0" class="checkbox-toggle" value="check all" type="checkbox">
                    <label for="checkbox0"></label>
                    </div>
                    </th>
                    <th colspan="4">
                    <div class="btn-group">
                        <button type="button" class="btn btn-dafault dropdown-toggle btn-color waves-effect waves-light border-round" data-toggle="dropdown">Delete 
                            <span class="fa fa-trash"></span>
                        </button>
                    </div>

                    <div class="btn-group">
                        <a href="" type="button" class="btn btn-default waves-effect waves-light border-round">
                            <span class="fa fa-refresh"></span>
                        </a>
                    </div>                
                    </th>

                    <th>
                    <div class="btn-group pull-left">
                    <button type="button" class="btn btn-dafault btn-color waves-effect waves-light border-round" data-toggle="modal" data-target="#myCompose">New Message 
                    <span class="fa fa-pencil-square-o"></span> 
                    </button>
                    </div>  
                    </th>
                </tr>
                <tr>
                    <th colspan="6">
                        <nav aria-label="Page navigation" class="text-center">
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">«</span>
                              </a>
                            </li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">»</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </th>
                </tr>
            </tfoot>
            </table>
        </div>
                                            <!--en inbox table-->
                                        </div>
                                        <!--en panel body-->
                                    </div>
                                    <!--en panel-->
                                </div>
                                <!--en inbox col-->
                            </div>
                            <!--en row-->
                        </div>
                    </div>
                </div>
                <!--inbox en-->
            </div>
            <!-- .right-sidebar st here-->
        </div>
        <!-- /.container-fluid -->
        <?php include'../includes/footer.php'; ?>
    </div>

    <!-- /#wrapper -->


    <?php include '../includes/footschool.php'; ?>
   
    <!-- Modal -->
    <div class="modal fade" id="myCompose" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header-1">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Message</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">To:</label>
                            <div class="col-sm-10">
                                <select class="wd-select">
                                    <option>--select--</option>
                                    <option>Principal</option>
                                    <option>Admin</option>
                                    <option>Teacher</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group marg-bott">
                            <label for="textarea" class="col-sm-2 control-label">Message:</label>
                            <div class="col-sm-10">
                                <textarea rows="5" class="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2 col-xs-12"></div>
                                <div class="col-sm-10">
                                    <button href="#" class="btn btn-link pull-right marg-right"><span class="fa fa-paperclip"></span> Attachment</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <button type="button" class="btn btn-default btn-color border-round"><i class="fa fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->

    <!--reply modal st-->
    <div class="modal fade" id="myReply" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header-1">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Reply</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">To:</label>
                            <div class="col-sm-10">
                                <select class="wd-select">
                    <option>--select--</option>
                    <option>Principal</option>
                    <option>Admin</option>
                    <option>Teacher</option>
                 </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Subject:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Regarding Report card">
                            </div>
                        </div>
                        <div class="form-group marg-bott">
                            <label for="textarea" class="col-sm-2 control-label">Message:</label>
                            <div class="col-sm-10">
                                <textarea rows="5" class="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2 col-xs-12"></div>
                                <div class="col-sm-10">
                                    <button href="#" class="btn btn-link pull-right marg-right"><span class="fa fa-paperclip"></span> Attachment</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 pull-right text-center">
                            <button type="button" class="btn btn-default btn-color border-round"><i class="fa fa-paper-plane"></i> Send</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--reply modal en-->

</body>

</html>