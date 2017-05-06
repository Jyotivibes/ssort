<header class="header">
    <div class="container clearfix">
        <div class="logo logo-mob">
            <a href="index.php">
                <img src="img/demo/logo.png" alt="">
            </a>
        </div>

        <div class="menu-toggle">
            <span>&nbsp;</span>
            <span>&nbsp;</span>
            <span>&nbsp;</span>
        </div>

        <div class="clearfix mob-clear">&nbsp;</div>

        <nav class="menu clearfix" role="navigation">
            <ul class="clearfix">
                    <li><a href="#slider" class="current">Home</a></li>
                    <li><a href="#sec_features">Features</a></li>
                    <li><a href="#sec_pricing">Enquiry</a></li>
                    <li><a href="#sec_testimonials">Testimonials</a></li>                                      
                    <li><a href="#sec_contact">Contact Us</a></li>
                    <li id="signin"><a href="javascript:void(0)"><span class="fa fa-sign-in"></span> Sign In</a></li>   
            </ul>
                            <!--mega menu st-->
                            <ul class="mega-menu up-arrow">          
                                    <form class="form-horizontal no-margin-bott">
                                        <div class="panel no-margin-bott">  
                                                <div class="panel-body no-padd">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-building-o"></i>
                                                                </div>
                                                                 <input id="tags" type="text" class="form-control" placeholder="School name"  id="country_id">

																<div id="tag"></div>
                                                                <!--<div class="ui-widget">
                                                                    <label for="tags">Tags: </label>
                                                                    <input id="tags">
                                                                </div>-->
                                                            </div>       
                                                         </div>      
                                                    </div>    
                                                </div><!--en panel-body--> 
                                            <div class="panel-footer text-center">
                                            <button type="button"  class="btn btn-info login-open submitmain">Submit</button><!--onclick="window.location.href='<?php echo HTTP_SERVER;?>mismtc/'"-->
                                            </div>
                                        </div><!--en panel-->                                       
                                    </form>                                           
                           </ul><!-- dropdown-menu -->
                                    <!--mega menu en-->  
            
        </nav>

    </div>

</header>
<?php
$sql = "SELECT sch_reg_no,sch_name FROM essort_school_info";
$res=mysql_query($sql) or die(mysql_error());
$list=array();
while($data=mysql_fetch_array($res))
{
    $list[]=$data;
}
?>

