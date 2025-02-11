<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    $visitors = Visitor::orderBy('id', 'desc')->paginate(10);
    return view('content.dashboard.dashboards-analytics', compact('visitors'));
  }
}
