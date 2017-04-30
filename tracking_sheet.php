<?php
	include 'config.inc';
	$user = $_SESSION['name'];
?>
<html>
	<title>THOR :: AUTO (Tracking Sheet)</title>
	<body>
		<fieldset>
			<h4 align='right'>Welcome, <?php echo $user ?> [ <a href='logout.php'>Logout</a> ]</h4>
		</fieldset>
		<br>
		<fieldset>
			<?php include 'templates/links.html' ?>
		</fieldset>
		<br>
		<fieldset>
			<h4 align = 'center'>Tracking Sheet (<a href = "tracking_data.php?member=<?php echo $_SESSION['name'] ?>">Fill Today's Data</a>)</h4>
			<table align='center' border=1>
				<tr align='center'>
				<td rowspan=2>Date</td><td colspan=2>Script Details</td><td colspan=3>Count For</td><td colspan=5>Time Spent On</td>
				</tr>
				<tr align='center'>
					<td>Category/Script Name</td><td>Test Case Summary</td><td>Test Cases Automated</td>
					<td>Test Cases Executed</td><td>Defects</td><td>Functional Understanding</td><td>Meeting / Calls</td>
					<td>Script / Validations</td><td>Framework Development</td><td>Feedback Implementation</td>
				</tr>
				<?php
					$tracking_row = select_all('tracking_sheet',['member',$user]);
					for($i=0;$i<sizeof($tracking_row);$i++){
						echo "<tr>";
							echo "<td>".$tracking_row[$i]['date']."</td>";
							echo "<td>".nl2br($tracking_row[$i]['script_name'])."</td>";
							echo "<td>".nl2br($tracking_row[$i]['tc_summary'])."</td>";
							echo "<td align='center'>".$tracking_row[$i]['tc_automated']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['tc_executed']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['defects']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['functional_understanding']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['meetings_calls']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['scripts_validations']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['framework_development']."</td>";
							echo "<td align='center'>".$tracking_row[$i]['feedback_implementation']."</td>";
						echo "</tr>";
					}
				?>
			</table>
		</fieldset>
	</body>
</html>