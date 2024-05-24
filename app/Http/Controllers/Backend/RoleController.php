<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class RoleController extends Controller {

  public function index() {
    return view('backend.role.index', []);
  }

  public function create() {
    return view('backend.role.create', []);
  }
}
