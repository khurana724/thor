<?php
	include 'config.inc';
	$user = $_GET['member'];
	$today_date = date("Y-m-d");
?>
<html>
	<title>THOR :: AUTO (Fill Tracking)</title>
	<body>
		<fieldset>
			<h4 align='right'>Welcome, <?php echo $_SESSION['name'] ?> [ <a href='logout.php'>Logout</a> ]</h4>
		</fieldset>
		<br>
		<fieldset>
			<?php include 'templates/links.html' ?>
		</fieldset>
		<br>
		<fieldset>
			<h4 align = 'center'>Tracking Sheet Data : : <?php echo $today_date ?></h4>
			<table align='center' border=1>
				<tr align='center'>
					<td colspan=2>Script Details</td><td colspan=3>Count For</td><td colspan=5>Time Spent On</td>
				</tr>
				<tr align='center'>
					<td>Category/Script Name</td><td>Test Case Summary</td><td>Test Cases Automated</td>
					<td>Test Cases Executed</td><td>Defects</td><td>Functional Understanding</td><td>Meeting / Calls</td>
					<td>Script / Validations</td><td>Framework Development</td><td>Feedback Implementation</td>
				</tr>
				<?php
					$tracking_row = select_all('tracking_sheet',['date',$today_date,'member',$user]);
				?>
				<form name='tracking_data' method='post'>
					<tr>
						<?php
							if(sizeof($tracking_row)==0){
						?>
								<td><textarea name='script_name' id='script_name'></textarea></td>
								<td><textarea name='tc_summary' id='tc_summary'></textarea></td>
								<td><input type='text' name='tc_automated' id='tc_automated' /></td>
								<td><input type='text' name='tc_executed' id='tc_executed' /></td>
								<td><input type='text' name='defects' id='defects' /></td>
								<td><input type='text' name='functional_understanding' id='functional_understanding' /></td>
								<td><input type='text' name='meetings_calls' id='meetings_calls' /></td>
								<td><input type='text' name='scripts_validations' id='scripts_validations' /></td>
								<td><input type='text' name='framework_development' id='framework_development' /></td>
								<td><input type='text' name='feedback_implementation' id='feedback_implementation' /></td>
						<?php
							}
							else{
						?>
								<td><textarea name='script_name' id='script_name'><?php echo $tracking_row[0]['script_name'] ?></textarea></td>
								<td><textarea name='tc_summary' id='tc_summary'><?php echo $tracking_row[0]['tc_summary'] ?></textarea></td>
								<td><input type='text' name='tc_automated' id='tc_automated' value=<?php echo $tracking_row[0]['tc_automated'] ?> /></td>
								<td><input type='text' name='tc_executed' id='tc_executed' value=<?php echo $tracking_row[0]['tc_executed'] ?> /></td>
								<td><input type='text' name='defects' id='defects' value=<?php echo $tracking_row[0]['defects'] ?> /></td>
								<td><input type='text' name='functional_understanding' id='functional_understanding' value=<?php echo $tracking_row[0]['functional_understanding'] ?> /></td>
								<td><input type='text' name='meetings_calls' id='meetings_calls' value=<?php echo $tracking_row[0]['meetings_calls'] ?> /></td>
								<td><input type='text' name='scripts_validations' id='scripts_validations' value=<?php echo $tracking_row[0]['scripts_validations'] ?> /></td>
								<td><input type='text' name='framework_development' id='framework_development' value=<?php echo $tracking_row[0]['framework_development'] ?> /></td>
								<td><input type='text' name='feedback_implementation' id='feedback_implementation' value=<?php echo $tracking_row[0]['feedback_implementation'] ?> /></td>
						<?php
							}
						?>
					</tr>
					<tr align='center'>
						<td colspan=10><input type='submit' name='save_tracking' id='save_tracking' value='Save Tracking Data' /></td>
					</tr>
				</form>
			</table>
		</fieldset>
		<?php
			if(isset($_POST['script_name'])){
				$script_name = $_POST['script_name']; $tc_summary = $_POST['tc_summary'];
				$tc_automated = $_POST['tc_automated']; $tc_executed = $_POST['tc_executed']; $defects = $_POST['defects'];
				$functional_understanding = $_POST['functional_understanding']; $meetings_calls = $_POST['meetings_calls']; 
				$scripts_validations = $_POST['scripts_validations']; $framework_development = $_POST['framework_development'];
				$feedback_implementation = $_POST['feedback_implementation'];
				
				if(sizeof($tracking_row) > 0){
					update(['script_name','tc_summary','tc_automated','tc_executed','defects','functional_understanding','meetings_calls','scripts_validations',
					'framework_development','feedback_implementation'],[$script_name,$tc_summary,$tc_automated,$tc_executed,$defects,$functional_understanding,
					$meetings_calls,$scripts_validations,$framework_development,$feedback_implementation],'tracking_sheet',['date',$today_date,'member',$user]);
				}
				else{
					insert(['date','member','script_name','tc_summary','tc_automated','tc_executed','defects','functional_understanding','meetings_calls'
					,'scripts_validations','framework_development','feedback_implementation'],[$today_date,$user,$script_name,$tc_summary,$tc_automated
					,$tc_executed,$defects,$functional_understanding,$meetings_calls,$scripts_validations,$framework_development,$feedback_implementation]
					,'tracking_sheet');
				}
				header('Location: tracking_sheet.php');
			}
		?>
	</body>
</html>