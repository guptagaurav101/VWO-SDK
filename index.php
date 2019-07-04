<?php
require_once('VWO/autoload.php');
session_start();
$customerHashlist=array(
    'gaurav',
    'aryan',
    'nidhi',
    'preeti',
    'nitin',
    'pankaj',
    'sumit',
    'ravi',
    'vikas',
    'swati',
);

use src\VWO as VWO;
$account_id=60781;
$sdk_key='ea87170ad94079aa190bc7c9b85d26fb';
$settings='';
if(isset($_GET['nocache']) && $_GET['nocache']==1){
    echo 'cleared cache<br>';
    unset($_SESSION['settings']);
}
if(isset($_SESSION['settings'])){

    $settings=  $_SESSION['settings'];
}else{
    $settings=VWO::fetchSettings($account_id,$sdk_key);
}

// object instead of many parameteres

// to check for empty schema


$config=['settings'=>$settings,
    'development_mode'=>1,
    'logger'=>''
];

$vwoClient = new VWO($config);
$_SESSION['settings']=$vwoClient->settings;

$campaign_name='FIRST';
echo 'Customer name:';
echo $customer_hash=$customerHashlist[rand(0,9)];

//$customer_hash='swati';
echo '<br>';echo '<br>';
echo "varient name: ";
 $varient=$vwoClient->activate($campaign_name,$customer_hash);
 $varient=$vwoClient->getVariant($campaign_name,$customer_hash);
 var_dump( $varient);
echo '<br>';
echo '<br>';echo '<br>';
$color='black';
switch ($varient){
    case 'Variation-1':
        $color ='red';
        break;
    case 'Control':
        $color="blue";
        break;
}
echo "My color is ".$color;

$w=$vwoClient->trackGoal($campaign_name,$customer_hash,'REVENUE');

