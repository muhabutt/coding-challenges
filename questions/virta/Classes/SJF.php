<?php
/**
 * SJF Scheduling concept, means arrived
 */

namespace Virta\Classes;


class SJF
{
    public function compute($jobs, $index)
    {
        // array which contains the pID (processID) (processID) and clock_cycle value.
        $pBurstTime = [];
        /**
         * pBurstTime will have pID (processID) and clock cycle of each job ( or process)
         * pID (processID) = index of jobs
         * clock_cycles = time to complete the job in clock cycle
         */
        for ($i = 0; $i < count ($jobs); $i++) {
            $pBurstTime[] = [
                "pID" => $i,
                "clock_cycle" => $jobs[$i]];
        }

        /**
         * sort the pBurstTime by clock_cycle because we need shortest job first
         * and asc sort will do that
         */
        usort ($pBurstTime, function ($a, $b) {
            return $a["clock_cycle"] - $b["clock_cycle"];
        });

        //first arrived job waiting clock cycle is always zero
        $pWaitingTime[0] = 0;
        /**
         * waitingClockCycle calculation
         * now we have sorted pBurstTime. and we need calculate the waiting time of
         * each process, in order to get completion time.First pWaitingTime will be zero
         * previous job clock cycle + previous job waiting clock cycle = pWaitingTime
         *
         */
        for ($i = 1; $i < count ($pBurstTime); $i++) {
            $pWaitingTime[] = $pBurstTime[$i - 1]["clock_cycle"] + $pWaitingTime[$i - 1];
        }

        $pCompletionTime = [];
        /**
         * pCompletionTime calculation
         * now we have sorted pBurstTime.
         * pBurstTime job clock cycle + job waiting clock cycle = pCompletionTime
         */
        for ($i = 0; $i < count ($pBurstTime); $i++) {
            $pCompletionTime[] = [
                "pID" => $pBurstTime[$i]["pID"],
                "time" => $pBurstTime[$i]["clock_cycle"] + $pWaitingTime[$i]
            ];
        }
        /**
         * totalJobCompletion contains the sorted jobs, and completion time
         * pID = index
         */
        for ($i = 0; $i < count ($pCompletionTime); $i++) {
            if ($pCompletionTime[$i]["pID"] === $index) {
                return $pCompletionTime[$i]["time"];
            }
        }
    }
}
