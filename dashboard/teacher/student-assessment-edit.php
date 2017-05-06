<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teacher | Student Assessment</title>
  <?php include '../includes/head.php'; ?>
  <!--attendance-->
  <script type="text/javascript" src="js/jquery.canvasjs.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <style>
    #co-scholastic tbody td:last-child{width: 80px;}
  </style>

</head>
<body>
  <div id="wrapper">
  <?php
		if (isset($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['USER_NAME']) && !empty($_SESSION['USER']['ROLE_ID']) && ($_SESSION['USER']['ROLE_ID'] == 'Teacher')) {
			$user_id = $_SESSION['USER']['USER_NAME'];
			require_once('../../' . $_SESSION['USER']['DB_NAME'] . '/classes/connection.php');
			require_once('../../classes/assessment_class.php');
			$obj = new Assessment();
			//print_r($studentarr);
			$id=$_REQUEST['id'];
			if($id=='')
			{
				echo "<script>window.location='" . HTTP_SERVER . "dashboard/teacher/student-assessment.php';</script>";
			}
			else
			{
			  $classsectiondata = $obj->getstudata($id);
			  if($classsectiondata['usr_photo']=='')
			  {
				$classsectiondata['usr_photo']='images.png';
			  }
			  $allterms = $obj->allterms();
			  
			  #############CLASS AND SECTION #########################################
			  $classsection = $obj->findclasssectionofteacher($_SESSION['USER']['USER_ID']);
			  $sublist = $obj->allsubject($classsection[0]['section_id']);
			  //print_r($sublist);
			  
			  
			  
			
			}
			   
			


			
			
		} else {
			echo "<script>window.location='" . HTTP_SERVER . "/index.php';</script>";
		}

?>

    <!-- Navigation -->
    <?php include '../includes/header-configuration.php'; ?>
    <!-- Left navbar-header -->
    <?php include '../includes/sidebar-teacher.php'; ?>   
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
               <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <?php include_once("../includes/header-notice-circular.php"); ?>
                    </div>
                <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                    <ol class="breadcrumb bread-change">
                        <li>
                            <a href="<?php echo TEACHER_DASHBOARD_LINK;?>">Dashboard</a>
                        </li>
                        <li class="active">Assessment</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <!--notice circular row st-->
        <div class="row">
          <div class="col-sm-12 col-xs-12">
            <div class="my-box">
              <div class="btn-block">
                <h3 class="box-title box-title pad-b-10">Assessment / Result</h3>
              </div>
              <section class="m-t-20" id="report-book">
               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                 <li role="presentation" class="active"><a href="#result" aria-controls="result" role="tab" data-toggle="tab">Result</a></li>
                 <li role="presentation"><a href="#grade" aria-controls="grade" role="tab" data-toggle="tab">Grade</a></li>
               </ul>

               <!-- Tab panes -->
               <div class="tab-content">
                 <div role="tabpanel" class="tab-pane fade in active" id="result">
                  <!-- Result -->
                  <section class="m-t-20">
                   <div class="row">
                    <div class="col-md-2 col-xs-12"><img src="../../<?php echo $_SESSION['USER']['DB_NAME']; ?>/uploads/student/<?php echo  $classsectiondata['usr_photo']; ?>" alt="user" class="img-responsive img-rounded img-thumbnail"></div>
                    <div class="col-md-9 col-xs-12">
                      <div class="panel panel-default">
                        <!--<div class="panel-heading">Student Contact Details</div>-->
                        <div class="panel-wrapper collapse in">
                          <table class="table table-hover">                    
                            <tbody>
                              <tr>
                                <td><strong>Name of Student</strong> </td>
                                <td><?php echo $classsectiondata['usr_fname']." ".$classsectiondata['usr_mname']."".$classsectiondata['usr_lname']?></td>
                              </tr>
                              <tr>
                                <td><strong>Admission Number</strong> </td>
                                <td><?php echo $classsectiondata['admission_no']; ?> </td>  
                              </tr>

                              <tr>
                                <td><strong>Date of Birth</strong> </td>
                                <td><?php echo $classsectiondata['usr_dob']; ?></td> 	
                              </tr>

                              <tr>
                                <td><strong>Residential Address & Telephone No.</strong></td>
                                <td><?php echo $classsectiondata['user_resident_local_address']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Board Registration No.</strong></td>
                                <td>-</td>
                              </tr>
                              <tr>
                                <td><strong>Mother's Name</strong></td>
                                <td><?php echo $classsectiondata['mother_name']; ?></td>
                              </tr>
                              <tr>
                                <td><strong>Father's Name</strong></td>
                                <td><?php echo $classsectiondata['father_name']; ?></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <h4><strong>Academic Performance: 1A</strong></h4>
                      <div class="table-responsive" id="report-book-grades">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th rowspan="3" width="150"><strong>SUBJECT</strong></th>
                              <!--<td colspan="5"><strong>TERM I</strong></td>
                              <td colspan="5"><strong>TERM II</strong></td>-->
							  
							   <?php 
							   echo '<pre>';
							    print_r($allterms);
								//print_r(array_keys($allterms));
							   $concatenate="";
							   
								  foreach($allterms as $key=>$termvalue)
								  {
									$count=0;
									$count=count($termvalue);
									$concatenate.=$key."+";
									
								  ?>
								  <td colspan="<?php echo $count;?>"><strong><?php echo $key;?></strong></td>
							      
								  <?php
								  }
								  $concatenate=rtrim($concatenate,'+');
							   ?>  
							  
                              <td colspan="1" width="150"><strong><?php echo $concatenate;?></strong></td>
                            </tr>
							
						
                            <tr>
							<?php
							foreach($allterms['Term 1'] as $key=>$termvalue)
							{  
							
							
							?>
                              <td id="<?php echo $termvalue['exam']."marks";?>"><?php echo $termvalue['marks'];?></td>
							<?php
							}
							?>
                            <?php
							foreach($allterms['Term 2'] as $key=>$termvalue)
							{  
							?>
                              <td id="<?php echo $key."".$termvalue['exam']."marks";?>"><?php echo $termvalue['marks'];?></td>
							  <?php
							  }
                             ?>
							<td>100</td>
                            </tr>
                            <tr>
                             <?php
							foreach($allterms['Term 1'] as $key=>$termvalue)
							{  
							?>
                              <td id="<?php echo $termvalue['exam']."exam";?>"><b><?php echo $termvalue['exam'];?></b></td>
							<?php
							}
							?>
                            <?php
							foreach($allterms['Term 2'] as $key=>$termvalue)
							{  
							?>
                              <td id="<?php echo $termvalue['exam']."marks";?>"><b><?php echo $termvalue['exam'];?></b></td>
							  <?php
							  }
                             ?>
							 <td>sdg</td>
                            </tr>
							
                          </thead>
                          <tbody>
						  <?php
						  foreach($sublist as $subvlaue)
						  {
						  ?>
                            <tr>
                              <th><?php echo $subvlaue['sub_id']; ?></th>
                              <?php
							  $i=1;
							foreach($allterms['Term 1'] as $key=>$termvalue)
							{  
								if (strpos($termvalue['exam'], 'Total') != false) {
									$subvlaue['sub_id']="TotalTerm".$i."".$subvlaue['sub_id'];
									$i++;
								}
								else
								{
									$id=$termvalue['exam']."-".$subvlaue['sub_id'];
								}

							?>
                               <td><input id="<?php echo $subvlaue['sub_id']; ?>" data-exam="<?php echo $id; ?>" type="text" class="form-control classval"  onkeypress="return isNumber(event)"></td>
							<?php
							
							}
							?>
                            <?php
							echo '<pre>';
							print_r($allterms['Term 2']);
							 $i=1;
							foreach($allterms['Term 2'] as $key=>$termvalue)
							{  
								echo strpos($termvalue['exam'], 'Total');
								if (strpos($termvalue['exam'], 'Total') != false) {
									$subvlaue['sub_id']="TotalTerm".$i."".$subvlaue['sub_id'];
									$i++;
									
								}
								else
								{
									$id=$termvalue['exam']."-".$subvlaue['sub_id'];
								}
							?>
                               <td><input id="<?php echo $subvlaue['sub_id']; ?>" data-exam="<?php echo $id; ?>"  type="text" class="form-control classval"  onkeypress="return isNumber(event)"></td>
							  <?php
							  }
                             ?>
							 <td><input  id="gradtotal" type="text" class="form-control"  onkeypress="return isNumber(event)"></td>
                            </tr>
                        <?php
						}
						?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="table-responsive m-t-20" id="co-scholastic">
                        <table class="table table-hover table-bordered">
                          <thead>
                            <tr>
                              <th colspan="3"><strong>Co-Scholastic</strong></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>2 A : Life Skills Thinking Skills</td>
                              <td>implement a well thought our decision and take responsibility</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2 A : Life Skills Social Skills</td>
                              <td>identify, verbalize and respond effectively to others' emotions in an empathetic manner</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2 A : Life Skills Emotional Skills</td>
                              <td>Comfortable with one's own self and overcome weaknesses for positive self-concept</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2B : Work Education</td>
                              <td>A collaborative approach to the process of learning.</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2C : Visual and Performing Arts</td>
                              <td>Is able to appreciate well written/spoken pieces in all genres (prose, poetry, plays) and all languages</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2 D : Attitude Towards Teachers</td>
                              <td>Shares a healthy rapport with peers/ mates</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2 D : Attitude Towards School Programmes</td>
                              <td>Is punctual and regular in attending school programmes</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>2 D : Value Systems</td>
                              <td>Shows a kind , helpful and responsible behavior/attitude</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>3 A : Scientific Skills</td>
                              <td>Reads, shows a high degree of awareness and is well informed</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>3 A : Aesthetic & Performing Art</td>
                              <td>Shows a keen interest and an aptitude towards a particular art form.</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>3 B : Health & Physical Education Sports/ Indigenous Sports</td>
                              <td>Shows patience and the tenacity to handle difficult/unpleasant situations</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                              <td>3 B : Health & Physical Education Gardening/ Shramdaan</td>
                              <td>Shows keenness and interest in Gardening</td>
                              <td><input type="text" class="form-control"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row m-t-20">
                    <div class="col-sm-12">
                      <h3 class="text-center">Grading System</h3>
                      <div class="col-md-10">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <tr>
                              <td>
                                <table class="table table-bordered" id="child-tbl">
                                  <thead>
                                    <tr>
                                      <td colspan="3" class="txt-center"><strong>SCHOLASTIC-A</strong></td>
                                    </tr> 
                                    <tr>
                                      <th class="text-center"><b>MARKS RANGE</b></th>
                                      <th class="text-center"><b>GRADE</b></th>
                                      <th class="text-center"><b>GRADE POINT</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>91-100</td>
                                      <td>A1</td>
                                      <td>10.0</td>
                                    </tr>
                                    <tr>
                                      <td>81-90</td>
                                      <td>A2</td>
                                      <td>9.0</td>
                                    </tr>
                                    <tr>
                                      <td>71-80</td>
                                      <td>B1</td>
                                      <td>8.0</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                              <td>
                                <table class="table table-bordered" id="child-tbl">
                                  <thead>
                                    <tr>
                                      <td colspan="3" class="txt-center"><strong>SCHOLASTIC-A</strong></td>
                                    </tr> 
                                    <tr>
                                      <th class="text-center"><b>MARKS RANGE</b></th>
                                      <th class="text-center"><b>GRADE</b></th>
                                      <th class="text-center"><b>GRADE POINT</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>61-70</td>
                                      <td>B2</td>
                                      <td>7.0</td>
                                    </tr>
                                    <tr>
                                      <td>51-60</td>
                                      <td>C1</td>
                                      <td>6.0</td>
                                    </tr>
                                    <tr>
                                      <td>41-50</td>
                                      <td>C2</td>
                                      <td>5.0</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                              <td>
                                <table class="table table-bordered" id="child-tbl">
                                  <thead>
                                    <tr>
                                      <td colspan="3" class="txt-center"><strong>SCHOLASTIC-A</strong></td>
                                    </tr> 
                                    <tr>
                                      <th class="text-center"><b>MARKS RANGE</b></th>
                                      <th class="text-center"><b>GRADE</b></th>
                                      <th class="text-center"><b>GRADE POINT</b></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>33-40</td>
                                      <td>D</td>
                                      <td>4.0</td>
                                    </tr>
                                    <tr>
                                      <td>21-32</td>
                                      <td>E1</td>
                                      <td></td>
                                    </tr>
                                    <tr>
                                      <td>00-20</td>
                                      <td>E2</td>
                                      <td></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <table class="table table-bordered" id="child-tbl">
                          <thead>
                            <tr>
                              <td class="txt-center"><strong>SCHOLASTIC-B</strong></td>
                            </tr> 
                            <tr>
                              <th class="text-center"><b>GRADE</b></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr><td>A</td></tr>
                            <tr><td>B</td></tr>
                            <tr><td>C</td></tr>
                            <tr><td>D</td></tr>
                            <tr><td>E</td></tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="bottom-download-btn">
                        <a href="javascript:void(0)" class="btn btn-default"> Save</a>
                        <a href="../result.pdf" class="btn btn-default"> Cancel</a>
                      </div>
                    </div>
                  </div> 
                </section>
              </div>
              <div role="tabpanel" class="tab-pane fade in" id="grade">
                <!-- Grade -->
                <div class="row">
                  <div class="col-sm-12">
                    <div class="titile-logo">
                      <img src="../images/logo.png" width="170" class="img-responsive" alt="">
                      <h2>Demo Intenational School</h2>
                      <p>( Affiliated to the C.B.S.E. Vide School Affiliation No. 2130006 )</p>
                      <h4>Patel Nagar, Bhopa Road, Muzaffarnagar, Uttar Pradesh</h4>
                    </div>
                    <div class="heading">
                      <p class="report-title">Report Book</p>
                      <p class="report-class">Class 9 A</p> 
                      <p class="report-session">Session : 2011-2012</p> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="table-responsive" id="report-book-format">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <th colspan="2"><h4>Student Profile</h4></th>
                          </tr>
                          <tr>
                            <th><strong>Name of Student</strong></th>
                            <td><strong>AAYUSH BHATT</strong></td>
                          </tr>
                          <tr>
                            <th><strong>Admission Number</strong></th>
                            <td>2008001122</td>
                          </tr>
                          <tr>
                            <th><strong>Date of Birth</strong></th>
                            <td>6/12/1997</td>
                          </tr>
                          <tr>
                            <th><strong>Residential Address & Telephone No.</strong></th>
                            <td>641 GANDHI COLONY LANE NO. 16 MUZAFFARNAGAR MO.NO. 9639862005</td>
                          </tr>
                          <tr>
                            <th><strong>Board Registration No.</strong></th>
                            <td>R/SE/13/08597/00001</td>
                          </tr>
                          <tr>
                            <th><strong>Mother's Name</strong></th>
                            <td>SEEMA SHARMA</td>
                          </tr>
                          <tr>
                            <th><strong>Father's Name</strong></th>
                            <td>SANJAY SHARMA</td>
                          </tr>
                          <tr>
                            <th colspan="2"><h4>Attendance:</h4></th>
                          </tr>
                          <tr>
                            <th>Total attendance of the student: 196 days</th>
                            <td>Total working days: 198</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <h4><strong>Academic Performance: 1A</strong></h4>
                    <div class="table-responsive" id="report-book-grades">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th rowspan="3"><strong>SUBJECT</strong></th>
                            <td colspan="5"><strong>TERM I</strong></td>
                            <td colspan="5"><strong>TERM II</strong></td>
                            <td colspan="2"><strong>TERM I+TERM II</strong></td>
                          </tr>
                          <tr>
                            <td>10</td>
                            <td>10</td>
                            <td>20</td>
                            <td>20</td>
                            <td>40</td>
                            <td>10</td>
                            <td>10</td>
                            <td>20</td>
                            <td>40</td>
                            <td>60</td>
                            <td>100</td>
                            <td>10.0</td>
                          </tr>
                          <tr>
                            <td><strong>FA1</strong></td>
                            <td><strong>FA2</strong></td>
                            <td><strong>Total <br>(FA)</strong></td>
                            <td><strong>SA1</td>
                            <td><strong>Total <br>(FA+SA1)</strong></td>
                            <td><strong>FA3</td>
                            <td><strong>FA4</td>
                            <td><strong>Total <br>(FA)</strong></td>
                            <td><strong>SA2</td>
                            <td><strong>Total <br>(FA+SA2)</strong></td>
                            <td><strong>Total <br>(TERM I+TERM II)</strong></td>
                            <td><strong>Grade Point</strong></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th>Language-1(English)</th>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A2</td>
                            <td>A2</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A2</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>10.0</td>
                          </tr>
                          <tr>
                            <th>Language-2(Hindi)</th>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A2</td>
                            <td>A2</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A2</td>
                            <td>A2</td>
                            <td>A2</td>
                            <td>9.0</td>
                          </tr>
                          <tr>
                            <th>Mathematics</th>
                            <td>B2</td>
                            <td>B1</td>
                            <td>B2</td>
                            <td>B2</td>
                            <td>B2</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A2</td>
                            <td>A1</td>
                            <td>A2</td>
                            <td>9.0</td>
                          </tr>
                          <tr>
                            <th>Science</th>
                            <td>A1</td>
                            <td>A2</td>
                            <td>A1</td>
                            <td>C1</td>
                            <td>B1</td>
                            <td>A2</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>B1</td>
                            <td>A2</td>
                            <td>A2</td>
                            <td>9.0</td>
                          </tr>
                          <tr>
                            <th>Social Studies</th>
                            <td>A2</td>
                            <td>A2</td>
                            <td>A2</td>
                            <td>B2</td>
                            <td>B1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>A1</td>
                            <td>B1</td>
                            <td>A2</td>
                            <td>B1</td>
                            <td>8.0</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <h4 class="m-t-20">Cumulative Grade Point Average (CGPA): 9</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="table-responsive m-t-20" id="co-scholastic">
                      <table class="table table-hover table-bordered">
                        <thead>
                          <tr>
                            <th colspan="3"><strong>Co-Scholastic</strong></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>2 A : Life Skills Thinking Skills</td>
                            <td>implement a well thought our decision and take responsibility</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>2 A : Life Skills Social Skills</td>
                            <td>identify, verbalize and respond effectively to others' emotions in an empathetic manner</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>2 A : Life Skills Emotional Skills</td>
                            <td>Comfortable with one's own self and overcome weaknesses for positive self-concept</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>2B : Work Education</td>
                            <td>A collaborative approach to the process of learning.</td>
                            <td>C</td>
                          </tr>
                          <tr>
                            <td>2C : Visual and Performing Arts</td>
                            <td>Is able to appreciate well written/spoken pieces in all genres (prose, poetry, plays) and all languages</td>
                            <td>D</td>
                          </tr>
                          <tr>
                            <td>2 D : Attitude Towards Teachers</td>
                            <td>Shares a healthy rapport with peers/ mates</td>
                            <td>B</td>
                          </tr>
                          <tr>
                            <td>2 D : Attitude Towards School Programmes</td>
                            <td>Is punctual and regular in attending school programmes</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>2 D : Value Systems</td>
                            <td>Shows a kind , helpful and responsible behavior/attitude</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>3 A : Scientific Skills</td>
                            <td>Reads, shows a high degree of awareness and is well informed</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>3 A : Aesthetic & Performing Art</td>
                            <td>Shows a keen interest and an aptitude towards a particular art form.</td>
                            <td>D</td>
                          </tr>
                          <tr>
                            <td>3 B : Health & Physical Education Sports/ Indigenous Sports</td>
                            <td>Shows patience and the tenacity to handle difficult/unpleasant situations</td>
                            <td>A</td>
                          </tr>
                          <tr>
                            <td>3 B : Health & Physical Education Gardening/ Shramdaan</td>
                            <td>Shows keenness and interest in Gardening</td>
                            <td>A</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row m-t-20">
                  <div class="col-sm-12">
                    <h3 class="text-center">Grading System</h3>
                    <div class="col-md-10">
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr>
                            <td>
                              <table class="table table-bordered" id="child-tbl">
                                <thead>
                                  <tr>
                                    <td colspan="3" class="txt-center"><strong>SCHOLASTIC-A</strong></td>
                                  </tr> 
                                  <tr>
                                    <th class="text-center"><b>MARKS RANGE</b></th>
                                    <th class="text-center"><b>GRADE</b></th>
                                    <th class="text-center"><b>GRADE POINT</b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>91-100</td>
                                    <td>A1</td>
                                    <td>10.0</td>
                                  </tr>
                                  <tr>
                                    <td>81-90</td>
                                    <td>A2</td>
                                    <td>9.0</td>
                                  </tr>
                                  <tr>
                                    <td>71-80</td>
                                    <td>B1</td>
                                    <td>8.0</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                            <td>
                              <table class="table table-bordered" id="child-tbl">
                                <thead>
                                  <tr>
                                    <td colspan="3" class="txt-center"><strong>SCHOLASTIC-A</strong></td>
                                  </tr> 
                                  <tr>
                                    <th class="text-center"><b>MARKS RANGE</b></th>
                                    <th class="text-center"><b>GRADE</b></th>
                                    <th class="text-center"><b>GRADE POINT</b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>61-70</td>
                                    <td>B2</td>
                                    <td>7.0</td>
                                  </tr>
                                  <tr>
                                    <td>51-60</td>
                                    <td>C1</td>
                                    <td>6.0</td>
                                  </tr>
                                  <tr>
                                    <td>41-50</td>
                                    <td>C2</td>
                                    <td>5.0</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                            <td>
                              <table class="table table-bordered" id="child-tbl">
                                <thead>
                                  <tr>
                                    <td colspan="3" class="txt-center"><strong>SCHOLASTIC-A</strong></td>
                                  </tr> 
                                  <tr>
                                    <th class="text-center"><b>MARKS RANGE</b></th>
                                    <th class="text-center"><b>GRADE</b></th>
                                    <th class="text-center"><b>GRADE POINT</b></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>33-40</td>
                                    <td>D</td>
                                    <td>4.0</td>
                                  </tr>
                                  <tr>
                                    <td>21-32</td>
                                    <td>E1</td>
                                    <td></td>
                                  </tr>
                                  <tr>
                                    <td>00-20</td>
                                    <td>E2</td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <table class="table table-bordered" id="child-tbl">
                        <thead>
                          <tr>
                            <td class="txt-center"><strong>SCHOLASTIC-B</strong></td>
                          </tr> 
                          <tr>
                            <th class="text-center"><b>GRADE</b></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr><td>A</td></tr>
                          <tr><td>B</td></tr>
                          <tr><td>C</td></tr>
                          <tr><td>D</td></tr>
                          <tr><td>E</td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <div class="bottom-download-btn">
                      <a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
                      <a href="../result.pdf" class="btn btn-default"><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div><!--en white-box-->
      </div><!--en col-->
    </div><!--en row-->
    <!--notice circular row en-->

  </div>
  <!-- .right-sidebar st here-->
</div>



<script>
<?php
foreach($sublist as $subvalue)
{
?>
var totalterm1<?php echo $subvalue['sub_id'];?>=0;
var totalterm2<?php echo $subvalue['sub_id'];?>=0;
<?php
}
?>
$(document).ready(function(){
$(".classval").keyup(function(){
    //get Subject
	var sub = $(this).attr('id');
	alert(sub);
	var mynumber=$("#"+sub).val();
	//get Exam name like FA1,SA1 with text (Field Id)
	var exam=$(this).attr("data-exam");
	//Split Array to find Exam name
	var examarr = exam.split("-");
	//get Exam
	var exam=examarr[0];
	if(["FA1", "FA2", "SA1"].includes(exam)==true && sub=='English')
	{
		window.totalterm1English = parseInt(mynumber)+parseInt(totalterm1English);
		$("#TotalTerm1English").val(totalterm1English);
	 
	}
	
	if(["FA3", "FA4"].includes(exam)==true && sub=='English')
	{
		window.totalterm2English = parseInt(mynumber)+parseInt(totalterm2English);
		$("#TotalTerm2English").val(totalterm2English);
	 
	}
	
	if(["FA1", "FA2", "SA1"].includes(exam)==true && sub=='Maths')
	{
		window.totalterm1Maths = parseInt(mynumber)+parseInt(totalterm1Maths);
		$("#totalterm1Maths").val(totalterm1English);
	 
	}
	
	if(["FA3", "FA4"].includes(exam)==true && sub=='Maths')
	{
		window.totalterm2Maths = parseInt(mynumber)+parseInt(totalterm2Maths);
		$("#TotalTerm2English").val(totalterm2Maths);
	 
	}
	
	
	
	
		 
		 
	
	
	
		 

});

});


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

</script>

<!-- /.container-fluid -->
<?php include'../includes/footer.php'; ?>
</div>
<!-- /#page-wrapper -->

<!-- /#wrapper -->


<?php include '../includes/foot.php'; ?>


<!--reply modal st-->

<!--reply modal en-->    

</body>
</html>

