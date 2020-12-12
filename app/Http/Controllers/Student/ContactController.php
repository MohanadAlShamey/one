<?php

namespace App\Http\Controllers\Student;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function index(){
       return view('student.contact.index');
   }

   public function getAllMsg(){
       return Contact::where('user_id',auth()->id())->latest()->paginate();
   }
}
