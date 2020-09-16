<?php

namespace Api;

class Issues extends AbstractApi
{
    private $statusList = [
        'New',
        'In Progress',
        'Request Review',
        'In Review',
        'Close',
        'Deny',
    ];

    private $statusInfo = [];

    public function getStatusListOfIssueId($issueId)
    {
        $statusList = $this->client->issue_status->listing(['issue_id' => $issueId]);

        $content = "\nStatus List of issue $issueId : \n";

        foreach ($statusList as $name => $id) {
            if (in_array($name, $this->statusList)) {
                $content .= " $id : $name \n";
                $this->statusInfo[$id] = $name;
            }
        }

        echo $content;
    }
    public function getInfo($issueId)
    {
        $issues = $this->client->issue->show($issueId);

        if (isset($issues['issue'])) {
            $issue = $issues['issue'];
        } else {
            $this->logger->error("We did not found issue {$issueId} .");
        }

        $content = "\nInformation of Issue {$issueId} \n";
        $content .= " Id: {$issue['id']} \n";
        $content .= " Status: {$issue['status']['name']} ({$issue['status']['id']}) \n";
        $content .= " Assigned to: {$issue['assigned_to']['name']} ({$issue['assigned_to']['id']}) \n";

        echo $content;
    }

    public function getStatus($issueId)
    {
        $issues = $this->client->issue->show($issueId);

        if (isset($issues['issue'])) {
            $issue = $issues['issue'];
        } else {
            $this->logger->warning("We did not found issue {$issueId} .");
        }

        echo " {$issue['id']} : {$issue['status']['name']} ({$issue['status']['id']}) \n";
    }

    public function updateStatus($issueId, $statusId, $userId)
    {
        if (!isset($this->statusInfo[$statusId])) {
            $this->logger->error("We did not found status id : {$statusId}");
        }

        $params = array(
            'status_id' => $statusId,
            'assigned_to_id' => $userId
        );

        $this->client->issue->update($issueId, $params);

        $this->logger->warning("Update issue : {$issueId} with status : {$statusId}.");

        $this->logger->info("Update Success.");
    }
}
