<?php
namespace CustomTheme\Model;

/**
 * Class Job
 * @package CustomTheme\Model
 * @property Location $location
 * @property string $absolute_url
 * @property integer $id
 * @property integer $internal_job_id
 * @property string $updated_at
 * @property string $requisition_id
 * @property string $title
 * @property Department[] $departments
 * @property Metadata[] $metadata
 */
class Job {
    public $absolute_url;
    public $internal_job_id;
    public $id;
    public $updated_at;
    public $requisition_id;
    public $title;
    private $location;
    private $departments;
    private $metadata;

    public function __construct($job) {
        $this->absolute_url = $job->absolute_url;
        $this->internal_job_id = $job->internal_job_id;
        $this->id = $job->id;
        $this->updated_at = $job->updated_at;
        $this->requisition_id = $job->requisition_id;
        $this->title = $job->title;
        $this->setLocation($job->location);
        $this->setDepartments($job->departments);
        $this->setMetadata($job->metadata);
    }


    /**
     * @return Location
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation($location ): void {
        $this->location = new Location($location);
    }

    /**
     * @return Department[]
     */
    public function getDepartments(): array {
        return $this->departments;
    }

    /**
     * @param integer[] $departments
     */
    public function setDepartments( array $departments ): void {
        foreach ( $departments as $department ) {
            $this->departments[] = DataProvider::getDepartment($department);
        }
    }

    /**
     * @return Metadata[]
     */
    public function getMetadata(): array {
        return $this->metadata;
    }

    /**
     * @param Metadata[] $metadata
     */
    public function setMetadata( array $metadata ): void {
        foreach ($metadata as $metadataUnit) {
            $this->metadata[] = new Metadata($metadataUnit);
        }
    }


}
