<?
	//SYNC ABSEN ==========================================================================
	$conn 	= odbc_connect("absen", "", "T8Q 51MQ");
	$sync1  	= odbc_exec($conn, "SELECT * FROM Result_T");
	while($dA = odbc_fetch_array($sync1)){
		mysql_query("INSERT INTO abs_result (
										EmployeeID,
										Date,
										ShiftID,
										Scan1,
										Scan2,
										Scan3,
										Scan4,
										TotalScan,
										Late,
										BreakDuration,
										BreakOver,
										TimeOfWork,
										ComingOverTime,
										BackOverTime
										) 
								VALUES (
										'$dA[EmployeeID]',
										'$dA[Date]',
										'$dA[ShiftID]',
										'$dA[Scan1]',
										'$dA[Scan2]',
										'$dA[Scan3]',
										'$dA[Scan4]',
										'$dA[TotalScan]',
										'$dA[Late]',
										'$dA[BreakDuration]',
										'$dA[BreakOver]',
										'$dA[TimeOfWork]',
										'$dA[ComingOverTime]',
										'$dA[BackOverTime]')
					");
		}
		
	mysql_query("TRUNCATE abs_department");
	$sync2  	= odbc_exec($conn, "SELECT * FROM Department_T");
	while($dA = odbc_fetch_array($sync2)){
		mysql_query("INSERT INTO abs_department (
										DepartmentID,
										DepartmentName
										) 
								VALUES (
										'$dA[DepartmentID]',
										'$dA[DepartmentName]')
					");
		}
		
	mysql_query("TRUNCATE abs_employee");
	$sync3  	= odbc_exec($conn, "SELECT * FROM Employee_T");
	while($dA = odbc_fetch_array($sync3)){
		mysql_query("INSERT INTO abs_employee (
										EmployeeID,
										FirstName,
										LastName,
										DepartmentID,
										ScheduleID,
										PIN
										) 
								VALUES (
										'$dA[EmployeeID]',
										'$dA[FirstName]',
										'$dA[LastName]',
										'$dA[DepartmentID]',
										'$dA[ScheduleID]',
										'$dA[PIN]')
					");
		}
	//===================================================================================
	
	echo '<script>alert ("Database Absen Berhasil Terupdate!")</script>';
	print "<meta http-equiv='refresh' content='0;url=?opt=$opt&menu=$menu&submenu=abs_individu'/>";
	exit();
?>