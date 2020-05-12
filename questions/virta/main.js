const compute = ($jobs, $index) =>
{

	//first arrived job clock cycle is always zero
	let $waitingTime = [0];

	// array which contains the job id and burst_time value.
	let $ganttChart = [];

	let $completionTime = [];
	/**
	 * ganttChart will have id and clock cycle of each job ( or process)
	 * id = index of jobs
	 * burst_times = time to complete the job in clock cycle
	 */
	for (let $i = 0; $i < $jobs.length; $i++) {
		$ganttChart.push({
			"id" : $i,
			"burst_time" : $jobs[$i]
		})
	}

	/**
	 * sort the ganttChart by burst_time because shortest job needs to run first after the job
	 * arrival of the first one
	 */
	$ganttChart.sort(function ($a, $b) {
		return $a.burst_time - $b.burst_time;
	});

	/**
	 * waitingClockCycle
	 * waitingTime = previous job clock cycle + previous job waiting clock cycle
	 * we need this time to calcualate the job completion time
	 */
	for (let $i = 1; $i < $ganttChart.length; $i++) {
		$waitingTime.push($ganttChart[$i - 1]["burst_time"] + $waitingTime[$i - 1]);
	}

	/**
	 * completionTime
	 * ganttChart job clock cycle + job waiting clock cycle
	 */
	for (let $i = 0; $i < $ganttChart.length; $i++) {
		$completionTime.push({
			"id":$ganttChart[$i].id,
			"time":$ganttChart[$i].burst_time + $waitingTime[$i]
		});
	}
	/**
	 * return totalJobCompletion time
	 * id = index
	 */
	for (let $i = 0; $i < $completionTime.length; $i++) {
		if ($completionTime[$i].id === $index) {
			return $completionTime[$i].time;
		}
	}
}

console.log (compute([100], 0), "should be " + 100);
console.log(compute([3,10,20,1,2], 0), "should be " + 6);
console.log (compute([3,10,20,1,2], 1), "should be " + 16);
