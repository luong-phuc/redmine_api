<?php

namespace Api;

class TimeEntry extends AbstractApi
{
    public function getAll($issueId, $userId, $limit = 5)
    {
        $timeEntries = $this->client->time_entry->all([
            'issue_id' => $issueId,
            'user_id' => $userId,
            'limit' => $limit
        ]);

        if (count($timeEntries['time_entries']) > 0) {
            return $timeEntries['time_entries'];
        }

        return array();
    }

    public function addMoreLogTime($issueId, $spentOn  = null, $hours = 8, $activityId = 9, $projectId = 88, $comments = null)
    {
        $result = $this->client->time_entry->create([
            'issue_id' => $issueId,
            'project_id' => $projectId,
            'spent_on' => $spentOn,
            'hours' => $hours,
            'activity_id' => $activityId,
            'comments' => $comments,
        ]);

        if ($result === false) {
            $this->logger->error("Can't create Log Time.");
        }
    }

    public function remove($id)
    {
        $this->client->time_entry->remove($id);
    }

    public static function viewDetail(array $timeEntrie)
    {
        $content = "id: {$timeEntrie['id']} ";
        $content .= "project: {$timeEntrie['project']['name']} ";
        $content .= ",issue: {$timeEntrie['issue']['id']} ";
        $content .= ",user: {$timeEntrie['user']['name']} ";
        $content .= ",activity: {$timeEntrie['activity']['name']} ";
        $content .= ",hours: {$timeEntrie['hours']} ";
        $content .= ",spent_on: {$timeEntrie['spent_on']} \n";

        echo $content;
    }
}
