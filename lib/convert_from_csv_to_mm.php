  GNU nano 2.2.2                                        Datei: convert.php                                                                                        

<?php

  // User data
$host = 'localhost';
$pswd = null;
$user = null;
$db   = null;

  // Job Market data
$localTable = 'tx_jobmarket_main';

$relations  = array(
                'contractor'  => 'tx_jobmarket_main_mm_tx_jobmarket_contractor',
                'county'      => 'tx_jobmarket_main_mm_tx_jobmarket_county',
                'region'      => 'tx_jobmarket_main_mm_tx_jobmarket_region',
                'sector'      => 'tx_jobmarket_main_mm_tx_jobmarket_sector',
                'sectorgroup' => 'tx_jobmarket_main_mm_tx_jobmarket_sectorgroup',
                'type'        => 'tx_jobmarket_main_mm_tx_jobmarket_type'
              );


  // Backup?
$input = "N";
echo "Did you make a backup of " . $localTable . "? [y/N]: ";
if( $stdin = fopen( "php://stdin", "r" ) ) 
{
  $input = strtoupper( trim( fgets( $stdin ) ) );
  fclose( $stdin );
}
if( ! ( $input == "J" || $input == "Y" ) )
{
  echo "Please make a backup first, than restart this script." . PHP_EOL;
  return;
}
  // Backup?

  // Database
if( empty ( $db ) )
{
  echo "Name of the TYPO3 database: ";
  if( $stdin = fopen( "php://stdin", "r" ) ) 
  {
    $db = trim( fgets( $stdin ) );
    fclose( $stdin );
  }
}
if( empty ( $db ) )
{
  echo "Abort: no database." . PHP_EOL;
  return;
}
  // Database

  // User
if( empty ( $user ) )
{
  echo "Name of the TYPO3 database user: ";
  if( $stdin = fopen( "php://stdin", "r" ) ) 
  {
    $user = trim( fgets( $stdin ) );
    fclose( $stdin );
  }
}
if( empty ( $user ) )
{
  echo "Abort: no user." . PHP_EOL;
  return;
}
  // User

  // Password
if( empty ( $pswd ) )
{
  echo "Name of the TYPO3 database password (your input will be visible): ";
  if( $stdin = fopen( "php://stdin", "r" ) ) 
  {
    $pswd = trim( fgets( $stdin ) );
    fclose( $stdin );
  }
}
if( empty ( $pswd ) )
{
  echo "Abort: no password." . PHP_EOL;
  return;
}
  // Password


  // Connect to database server or die
$link = @mysql_connect( $host, $user, $pswd )
        or die( "Error: can't connect to database server: " . mysql_error() . PHP_EOL );

  // Prompt success
echo PHP_EOL;
echo "OK: database server is connected." . PHP_EOL;

  // Connect to database or die
mysql_select_db( $db )
  or die("Error: can't connect to database " . $db . PHP_EOL );

  // Prompt success
echo "OK: database " . $db . " is connected." . PHP_EOL;

  // MM tables empty?
foreach( $relations as $field => $mmTable )
{
    // Query the local table
  $query = "SELECT count( * ) AS 'count' FROM " . $mmTable;
  $result = mysql_query( $query )    
            or die("Error: " . mysql_error() . PHP_EOL );

    // LOOP : rows of the local table
  while( $row = mysql_fetch_array( $result, MYSQL_ASSOC ) )
  {
    if( $row["count"] > 0 )
    {
      echo "Error: " . $mmTable . " isn't empty: it contains #" . $row["count"] . " rows." . PHP_EOL;
      echo "* Take care of proper tables! " . PHP_EOL;
      echo "* Are you sure, that the database design of Job Market is the csv design (version 1.x)?" . PHP_EOL;
      echo "* Please truncate " . $mmTable . " first. Than restart this script." . PHP_EOL;
      echo "Abort. No datas are changed." . PHP_EOL;
      echo PHP_EOL;
      return;
    }
  }
  
  echo "OK: " . $mmTable . " is empty." . PHP_EOL;

  mysql_free_result($result);
}
echo PHP_EOL;

  // Last confirmation
$input = "N";
echo "Data will converted now." . PHP_EOL;
echo "If there will be any error, please do the following:" . PHP_EOL;
echo "* truncate all MM tables (see the tables above)" . PHP_EOL;
echo "* recover " . $localTable . " with the backup" . PHP_EOL;
echo "* investigate, what went wrong" . PHP_EOL;
echo "* start the conversion again" . PHP_EOL;
echo PHP_EOL;

echo "Should data converted now? [y/N]: ";
if( $stdin = fopen( "php://stdin", "r" ) ) 
{
  $input = strtoupper( trim( fgets( $stdin ) ) );
  fclose( $stdin );
}
if( ! ( $input == "J" || $input == "Y" ) )
{
  echo "Aborted: no data is changed." . PHP_EOL;
  echo PHP_EOL;
  return;
}
  // Last confirmation


  // LOOP : fields
$transactionCounter = 0;
foreach( $relations as $field => $mmTable )
{
  echo $field . ": " . $mmTable . PHP_EOL;
  
    // Query the local table
  $query = "SELECT uid, " . $field . " FROM " . $localTable;
  $resLocalTable = mysql_query( $query )    
                   or die("Error: " . mysql_error() . PHP_EOL );

    // LOOP : rows of the local table
  while( $row = mysql_fetch_array( $resLocalTable, MYSQL_ASSOC ) )
  {
    $uid          = $row["uid"];
    $uidsRelation = explode( ',', $row[$field] );
    $sumRelations = count( $uidsRelation );
    
      // LOOP : relations
    $arrInsertValues = array( );
    foreach( $uidsRelation as $uidForeign )
    {
      $arrInsertValues[] = "('" . $uid . "', '" . $uidForeign . "' )";
    }
      // LOOP : relations

      // Insert values in MM table
    $strInsertValues = implode( ', ', $arrInsertValues );
    $query  = "INSERT INTO " . $mmTable . " ( `uid_local`, `uid_foreign` ) " . 
              "VALUES " . $strInsertValues . ";";
    echo $query . PHP_EOL;
    $result = mysql_query( $query )    
              or die("Error: " . mysql_error() . PHP_EOL );
    $transactionCounter++;
    
      // Update local table
    $query  = "UPDATE " . $localTable . " SET " . $field . " = '" . $sumRelations . "' " .
              "WHERE " . $localTable . ".uid = " . $uid . ";";
    echo $query . PHP_EOL;
    $result = mysql_query( $query )    
              or die("Error: " . mysql_error() . PHP_EOL );
    $transactionCounter++;
    
  }
    // LOOP : rows of the local table

  mysql_free_result( $resLocalTable );
}
  // LOOP : fields
 
mysql_close( $link );

echo PHP_EOL;
echo "Success: #" . $transactionCounter . " SQL transactions were counted." . PHP_EOL; 
echo PHP_EOL;
echo "Thanks for using TYPO3 Job Market." . PHP_EOL; 
echo "Buy." . PHP_EOL; 
echo PHP_EOL;
echo PHP_EOL;

?>

