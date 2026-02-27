<?php

class SavedJobController extends DrupalDefaultEntityController
{

    protected function attachLoad(&$queried_entities, $revision_id = FALSE)
    {
        parent::attachLoad($queried_entities, $revision_id);

        $nids = array();
        foreach ($queried_entities as $entity) {
            $nids[] = $entity->job_nid;
        }

        if (!empty($nids)) {
            $nodes = node_load_multiple(array_unique($nids));

            foreach ($queried_entities as &$entity) {
                $entity->job_node = isset($nodes[$entity->job_nid])
                    ? $nodes[$entity->job_nid]
                    : NULL;
            }
        }
    }

    public function loadByUser($uid)
    {
        $ids = db_query(
            "SELECT saved_job_id FROM {jobportal_saved_jobs}
       WHERE uid = :uid ORDER BY created DESC",
            array(':uid' => $uid)
        )->fetchCol();

        return $ids ? $this->load($ids) : array();
    }

    public function loadByUserAndJob($uid, $job_nid)
    {
        $id = db_query(
            "SELECT saved_job_id FROM {jobportal_saved_jobs}
       WHERE uid = :uid AND job_nid = :nid",
            array(':uid' => $uid, ':nid' => $job_nid)
        )->fetchField();

        if (!$id) {
            return FALSE;
        }

        $entities = $this->load(array($id));
        return reset($entities);
    }

    public function isSaved($uid, $job_nid)
    {
        return (bool) db_query(
            "SELECT 1 FROM {jobportal_saved_jobs} WHERE uid = :uid AND job_nid = :nid",
            array(':uid' => $uid, ':nid' => $job_nid)
        )->fetchField();
    }

    public function save($uid, $job_nid)
    {
        db_insert('jobportal_saved_jobs')
            ->fields(array(
                'uid'     => $uid,
                'job_nid' => $job_nid,
                'created' => REQUEST_TIME,
            ))
            ->execute();

        $this->resetCache();
    }

    public function delete($uid, $job_nid)
    {
        db_delete('jobportal_saved_jobs')
            ->condition('uid', $uid)
            ->condition('job_nid', $job_nid)
            ->execute();

        $this->resetCache();
    }
}
