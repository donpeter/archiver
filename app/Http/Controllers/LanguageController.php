<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function setLocale($locale, Request $request)
    {
      $request->session()->put('locale', $locale);
      //dd(session('locale'));
      return redirect()->back();
    }
}
