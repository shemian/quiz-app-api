<?php

namespace App\Http\Controllers;

use App\Jobs\SendTeacherAccountEmail;
use App\Jobs\SendTeacherAccountSms;
use App\Models\BrainGame;
use App\Models\ChartOfAccounts;
use App\Models\MpesaTransaction;
use App\Models\Sms;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTeacherRequest;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Teacher;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherCreated;
use Illuminate\Support\Facades\Session;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customerCount = Guardian::count();
        $studentCount = Student::count();
        $teacherCount = User::where('role', 'teacher')->count();
//        $accountBalance = ChartOfAccounts::all();
        $latestCustomers = User::where('role', 'parent')->latest()->limit(6)->get();
//        $organization_revenue = $accountBalance[0]->account_balance;

        $totalWalletBalance = 0;
        $totalCentyBalance = 0;

        $students = Student::all();
        foreach ($students as $student) {
            $totalWalletBalance += $student->debit;
            $totalCentyBalance += $student->centy_balance;
        }

        //Get top students in the brain game
        $topStudensts = BrainGame::with('student')
            ->orderByDesc('yes_ans')
            ->take(5)
            ->get();
        return view('admin.dashboard', compact('latestCustomers', 'customerCount', 'studentCount', 'teacherCount', 'totalWalletBalance', 'totalCentyBalance', 'topStudensts', ));
    }


    public function get_sms(){
        $messages = Sms::all();
        return view('admin.sms', compact('messages'));
    }



    //Display Transaction Details
    public function get_transactions(){
        $transactions = MpesaTransaction::all();
        return view('admin.transactions', compact('transactions'));
    }

    //Display teacher's Details
    public function get_teachers(){
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.teacher', compact('teachers'));
    }

    public function get_customers(){
        $customers = Guardian::with('user')->get();
        return view('admin.customers', compact('customers'));
    }
    public function get_students()
    {
        $students = Student::with('user', 'guardian')->get();
        return view('admin.students', compact('students'));
    }

    //store teachers details
    public function store_teachers(CreateTeacherRequest $request){

        $data = $request->validated();
        $newUser = new User();
        $newUser->name=$data['name'];
        $newUser->email= $data['email'];
        $newUser->phone_number = $data['phone_number'];
        $newUser->role = 'teacher';
        $password = strval(mt_rand(1000, 9999));
        $newUser->password = $password;
        $newUser->save();

        // Create a new teacher

        $teacher = new Teacher();
        $teacher->user_id = $newUser->id;
        $teacher->save();

        // Send email with password
        dispatch(new SendTeacherAccountEmail($newUser, $password));

        // Send sms to the teacher with their credentials
        dispatch(new SendTeacherAccountSms($teacher, $password));

        // Clear form data

        Session::flash('formData', null);

    return redirect()->route('get_teachers')->with('success', 'Teacher added successfully!, Login Credentials Sent to the Email Address');

    }

    public function teacher_profile(){
        return view('teacher_profile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display top 6 students for the brain Game
     */


    /**
     * Display the specified resource.
     */
    public function parent_details(string $id)
    {
        $guardian = Guardian::find($id);
        $students = $guardian->students;
        return view('admin.view_parent_details', compact('guardian', 'students'));
    }

    /**
     * Update student the specified resource in storage.
     */


    public function update_student_account(Request $request, string $id)
    {
        $request->validate([
            'account_status' => 'required',
        ]);

        $student = Student::find($id);
        $student->account_status = $request->account_status;
        $student->save();

        return redirect()->route('view_students')
            ->with('success', 'Student account updated successfully.');
    }

    public function destroy_student_account(string $id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect()->route('view_students')
            ->with('success', 'Student account deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
