<div class="row bg-title">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
<?php
$sqlciract = $obj->getCircularActivities();
$cirarray = array();
while ($rowcir = mysql_fetch_array($sqlciract)) {
    $cirarray[] = $rowcir;
}
?>
<h4 class="page-title">
    <span>
        <?php
        $i = 0;
        $size = count($cirarray);
        foreach ($cirarray as $cirvlue) {
            ?>
            <?php
            echo $cirvlue['subject'];
            echo ($size == ++$i) ? '' : ', ';
            ?>
        <?php
        }
        ?>
    </span>
</h4>
</div>
<?php
$crumbs = explode("/",$_SERVER["REQUEST_URI"]);
$aa='';
foreach($crumbs as $crumb){
$aa.=ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . ' ');
}
//echo $aa;
$arr=array();
$arr=explode(" ",$aa);
//print_r($arr);
$a="Dashboard";


$url='';
if($_SESSION['USER']['ROLE_ID']=='SAD')
{
	$url='../school-admin/school-admin.php';

}
else if($_SESSION['USER']['ROLE_ID']=='Principal')
{
	$url='../principal/principal.php';
}
else if($_SESSION['USER']['ROLE_ID']=='Teacher')
{
	$url='../teacher/teacher.php';

}
else if($_SESSION['USER']['ROLE_ID']=='Parent')
{
	$url='../parents/parents.php';
}
else
{
	$url='#';
}
?>
<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
    <ol class="breadcrumb bread-change">
            <li>
                <a href="<?php echo $url; ?>"><?php echo $a;?></a> <!--$arr[2]-->
            </li>
            <!--<li class="active"><?php /*echo substr($arr[4], 0, strpos($arr[4], "?"));*/?></li>-->
            <li class="active">
                <?php
                if(strstr($arr[4], '?')==true){
                echo strstr($arr[4], '?', true); ?>
            <?php
                }
            else{
				if($arr[3]=='Teacher-att')
				{
					$arr[3]='Attendance';
				}
				else if($arr[3]=='Eventsholidays')
				{
					$arr[3]='Event & Holidays';
				}
				else if($arr[3]=='Noticecircular')
				{
					$arr[3]='Notice & Circulars';
				}
				$newarr=explode('-',$arr[3]);
				//print_r($newarr);
				if(array_key_exists("1",$newarr))
				{
					$arr[3]=$newarr[1];
				}
				else
				{
					$arr[3]=$newarr[0];
				}
				echo $arr[3];
            }
?>
            </li>
        </ol>
</div>
</div>


