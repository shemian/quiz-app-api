<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Models\Student;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountStatusController extends Controller
{
    public function changeAccountStatus()
    {
        try {
            $students = Student::where('account_status', AccountStatus::ACTIVE)->get();
            $subscriptionPlans = SubscriptionPlan::all();

            foreach ($students as $student) {
                foreach ($subscriptionPlans as $subscriptionPlan) {
                    if ($student->active_subscription === $subscriptionPlan->name) {
                        if (Carbon::parse($student->start_date)->addDays($subscriptionPlan->validity)->isPast()) {
                            $student->account_status = AccountStatus::SUSPENDED;
                            $student->active_subscription = null;
                            $student->save();
                        }
                        $student->credit -= $subscriptionPlan->price;
                        $student->save();
                    }
                }
            }

            Log::info('Cron job executed successfully!');
        } catch (\Exception $e) {
            Log::error('An error occurred in the cron job: ' . $e->getMessage());
        }
    }
}
