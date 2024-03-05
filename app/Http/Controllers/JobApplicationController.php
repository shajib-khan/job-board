<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(Job $job)
    {
        return view('job_application.create', ['job' => $job]);
    }

    public function store(Job $job, Request $request)
    {
        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:10000000'
        ]);
        $validatedData['user_id'] = auth()->id();

        $job->jobApplications()->create($validatedData);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted.');
    }

    public function destroy(string $id)
    {
        //
    }
}
