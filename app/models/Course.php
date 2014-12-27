<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/5/2014
 * Time: 12:03 PM
 */

class Course extends Eloquent {
    protected $table = 'course';
    protected $guarded = array('CourseID');
}