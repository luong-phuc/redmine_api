<?php

namespace Api;

class TimeEntry
{

    public function __construct($client)
    {
        $this->client = $client;
    }

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

    public function addMoreLogTime($issueId, $hours = 8, $spentOn  = null, $activityId = 9, $projectId = 88, $comments = null) {
        $result = $this->client->time_entry->create([
            'issue_id' => $issueId,
            'project_id' => $projectId,
            'spent_on' => $spentOn,
            'hours' => $hours,
            'activity_id' => $activityId,
            'comments' => $comments,
        ]);

        if($result === false) {
            throw new \Exception("Can't create Log Time.");
        }
    }

    public function remove($id) {
        $result = $this->client->time_entry->remove($id);
        var_dump($result);
    }

    public static function viewDetail(Array $timeEntrie)
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
