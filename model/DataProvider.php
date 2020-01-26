<?php
namespace CustomTheme\Model;

class DataProvider {
    const PER_PAGE_ITEMS = 10;
    const CACHE_LIFETIME = 12* 60 * 60 ;
    const CACHE_TRANSIENT_KEY = "api_info" ;
    const API_URL = "https://api.jsonbin.io/b/5dd7cefb040d843991f7183c" ;
    static $departments = [];
    static $jobsCount = 0;
    public static function getRawData() {
        $result = self::getCachedData();
        if( empty($result) ) {
            if ( false === $result ) {
                $request = wp_remote_get( self::API_URL );
                if( is_wp_error( $request ) ) {
                    return false; // Bail early
                }
                $body = wp_remote_retrieve_body( $request );
                $result = json_decode( $body );
                self::setCachedData($result);
            }
        }

        return $result;
    }

    public static function getCachedData() {
        return get_transient(self::CACHE_TRANSIENT_KEY);
    }

    public static function setCachedData($result) {
        set_transient( self::CACHE_TRANSIENT_KEY, $result, self::CACHE_LIFETIME );
    }

    public static function getDepartments() {
        $result = [];
        if (!empty(self::$departments)) {
            return self::$departments;
        }
        $rawData = self::getRawData();
        if ( isset($rawData->departments)) {
            foreach ($rawData->departments as $department) {
                $result[] = new Department($department);
            }
        }
        self::$departments = $result;
        return $result;
    }

    public static function getDepartment($id) {
        $departments = self::getDepartments();
        return array_shift(array_filter($departments, function ($data) use ($id){
            return $data->id === $id;
        }));
    }

    public static function getJobs($department = -1, $page = 0) {
        $result = [];
        $rawData = self::getRawData();
        if ( isset($rawData->jobs)) {
            foreach ($rawData->jobs as $job) {
                if ($department && in_array($department, $job->departments)) {
                    $result[] = new Job($job);
                } elseif ($department == -1) {
                    $result[] = new Job($job);
                }

            }
        }

        self::$jobsCount = count($result);

        $result = array_slice($result,($page) * self::PER_PAGE_ITEMS, self::PER_PAGE_ITEMS);

        return $result;
    }


}
