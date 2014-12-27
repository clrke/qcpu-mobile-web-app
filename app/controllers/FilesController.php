<?php
/**
 * Created by PhpStorm.
 * User: Gipoy17
 * Date: 12/24/2014
 * Time: 4:56 PM
 */

class FilesController extends BaseController {

    public function index() {
        return View::make('validated.files.index');
    }

} 