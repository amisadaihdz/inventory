
<?php
	include("../inc/config.inc.php");
	session_start();

if(!isset($_SESSION['userid'])){
header('Location: index.php'); // Redirecting To Home Page
}
	$idroveedor = $_SESSION['provid'];//$_POST['campus'];
	/*
	 * Script:    DataTables server-side script for PHP and MySQL
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array('a.nIdProducto', 'a.sku', 'a.nIdCategoria', 'a.sNombreProd', 'a.url', 'b.nstok', 'b.npedido', 'b.nDisponible', 'b.nComprado','a.nPrecio' , '\'\'', '\'\'' );
	$aVisibleColumns = array( $aColumns[0], $aColumns[1] , $aColumns[2], $aColumns[3], $aColumns[4], $aColumns[5], $aColumns[6], $aColumns[7], $aColumns[8], $aColumns[9]);
	
		
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = " LIMIT ".mysqli_real_escape_string( $WBD->LINK, $_GET['iDisplayStart'] ).", ".
			mysqli_real_escape_string( $WBD->LINK, $_GET['iDisplayLength'] );
	}
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				if ( $_GET['iSortCol_0'] != 0 ) {
					$sOrder .= $aVisibleColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						".mysqli_real_escape_string( $WBD->LINK, $_GET['sSortDir_'.$i] ) .", ".$aVisibleColumns[0]." asc, ";						
				} else {
					$sOrder .= $aVisibleColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
						".mysqli_real_escape_string( $WBD->LINK, $_GET['sSortDir_'.$i] ) .", ";									
				}
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = " WHERE 1 and (";
		for ( $i=1 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] != '\'\'' ) {
				$sWhere .= $aColumns[$i]." LIKE \'%".mysqli_real_escape_string( $WBD->LINK, $_GET['sSearch'] )."%\' OR ";
			}
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	} else {
		$sWhere = " WHERE 1 ";
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE \'%".mysqli_real_escape_string( $WBD->LINK, $_GET['sSearch_'.$i])."%\' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	if ( $_GET['sSearch'] != "" ) {
		$sColumns = str_replace(" , ", " ", implode(", ", $aColumns));
		$sQuery = "CALL ejhocomm_pos.SP_SELECT_INVENTARIO_PROVEEDORES_DT('$sLimit', '$sOrder', '$sWhere', '{$_GET['sSearch']}');";
	} else {
		$sColumns = str_replace(" , ", " ", implode(", ", $aColumns));
		$sQuery = "CALL ejhocomm_pos.SP_SELECT_INVENTARIO_PROVEEDORES_DT('$sLimit', '$sOrder', '$sWhere', '{$_GET['sSearch']}');";
	}
	$rResult = $WBD->SP( $sQuery );
	//echo $sQuery;
	/* Data set length after filtering */
	$sQuery = "CALL ejhocomm_pos.sp_select_conteo_datatable();";
	$rResultFilterTotal = $WBD->SP( $sQuery );
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	/* Total data set length */
/*	$sQuery = "CALL ejhocomm_sabdae.SP_SELECT_DT_ALUMNOS_POR_CAMPUS_CUENTA('$campus');";
	$rResultTotal = $WBD->SP( $sQuery );
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal['cuenta'];*/
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iFilteredTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);

	while ( $aRow = mysqli_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = (!preg_match('!!u', $aRow[$i]))? utf8_encode($aRow[$i]) : $aRow[$i];
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>
