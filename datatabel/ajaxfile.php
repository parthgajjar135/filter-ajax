<?php
include 'config.php';

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];



$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value*/

## Date search value
$searchByFromdate = mysqli_real_escape_string($con,$_POST['searchByFromdate']);
$searchByTodate = mysqli_real_escape_string($con,$_POST['searchByTodate']);

## Search 
$searchQuery = " ";
if($searchValue != ''){
    $searchQuery = " and (vendor_id like '%".$searchValue."%' or invoice_no like '%".$searchValue."%' or round_of_amount like'%".$searchValue."%' ) ";
}

// Date filter
if($searchByFromdate != '' && $searchByTodate != ''){
    $searchQuery .= " and (invoice_date between '".$searchByFromdate."' and '".$searchByTodate."' ) ";
}

## Total number of records without filtering
 $sel = mysqli_query($con,"select count(*) as allcount from purchase_inward");
 $records = mysqli_fetch_assoc($sel);
 $totalRecords = $records['allcount'];

## Total number of records with filtering
$sel = mysqli_query($con,"select count(*) as allcount from purchase_inward WHERE 1 ".$searchQuery);
 $records = mysqli_fetch_assoc($sel);
 $totalRecordwithFilter = $records['allcount'];

## Fetch records
/*$DataQuery = "select * from purchase_inward";*/
 $DataQuery = "select * from purchase_inward WHERE ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$Datarecoreds = mysqli_query($con, $DataQuery);
$data = array();

echo $data; 

while ($row = mysqli_fetch_assoc($Datarecoreds)) {
    $data[] = array(   
    "vendor_id" => $row["vendor_id"],
    "branch_id"=>$row["branch_id"],
    "invoice_no" => $row["invoice_no"],
    "round_of_amount" => $row["round_of_amount"],
    "invoice_date" => $row["invoice_date"],
    "delivery_note" => $row["delivery_note"],
    "buyer_order_no" => $row["buyer_order_no"],
    "buyer_order_date" => $row["buyer_order_date"],
    "order_customer_name" => $row["order_customer_name"],
    "delivery_date" => $row["delivery_date"],
    "dispatch_through" => $row["dispatch_through"]
    );
}




## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
die;
