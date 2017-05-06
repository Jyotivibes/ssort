<?php

	//############# LOGIN ##################################
	if(isset($_REQUEST['action']) && ($_REQUEST['action']=='attendanceregister') ){
		require_once(''.$_REQUEST['session'].'/classes/connection.php');
		require_once('classes/general_class.php');
		$obj = new General();

		if(  ($_REQUEST['user_email']=='') && ($_REQUEST['user_password']=='')){
				echo 1;exit;// require Parametre missing
		}else{
			 for ($i = 4; $i < 16; $i++) {

                $monthNum = $i;
                if ($monthNum == 13) {
                    $monthNum = 01;
                } else if ($monthNum == 14) {
                    $monthNum = 02;
                } else if ($monthNum == 15) {
                    $monthNum = 03;
                } else {
                    $monthNum = $monthNum;
                }
                $dateObj = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F');
                $number = cal_days_in_month(CAL_GREGORIAN, $monthNum, date("Y")); // 31
                ?>

                <tr>
                    <td><?php echo $monthName;?></td>
                    <?php
                    for ($y = 1; $y <= $number; $y++) {

                        $date = date("Y") . "-" . $monthNum . "-" . $y;
                        $date = date('Y-m-d', strtotime($date));
                        require_once('../../' .$_REQUEST['session'] . '/classes/connection.php');
                        require_once('../../classes/general_class.php');
                        $obj = new General();
                        $status = $obj->getCurrentAttendenece($date, $_REQUEST['id']);
                        if ($status == 'AB') {
                            $tag = 'absent';
                            $status = 'A';
                        } else if ($status == 'PR') {
                            $tag = 'present';
                            $status = 'P';
                        } else if ($status == 'LV') {
                            $tag = 'cancel';
                            $status = 'L';
                        } else {


                        }
                        ?>
                        <td class="<?php echo $tag; ?>"><?php if($tag == 'present'){
                            ?><a href="#" data-toggle="tooltip"
                                 data-original-title="In Time: 9:30AM<br/> Out Time: 2:30PM">
                                <?php
                                }
                                ?><?php echo $status;?></a>
                        </td>
                    <?php
                    }
                    ?>


                </tr>
            <?php
            }

            ?>
			<?php
		}
	}
	//############# LOGIN ##################################

	//################################################################################################
	

#######################################################################

?>