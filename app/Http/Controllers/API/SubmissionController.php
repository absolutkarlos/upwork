<?php

namespace App\Http\Controllers\API;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Jobs\ProcessSubmission; 

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Retrieve Submissions (with Optional Filtering/Sorting)
        $submissions = Submission::query(); // Start with a query builder

        // Apply any filters or sorting based on request parameters if needed
        if ($request->has('name')) {
            $submissions->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // 2. Paginate Results (Recommended for large datasets)
        $submissions = $submissions->paginate(15); // 15 submissions per page

        // 3. Return JSON Response
        return response()->json($submissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        ProcessSubmission::dispatch($request->all());

        // 2. Return a success response
        return response()->json([
            'message' => 'Submission received. It will be processed shortly.'
        ], 202); // 202 Accepted
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        // 1. Check if Submission Exists
        if (!$submission) {
            return response()->json(['message' => 'Submission not found'], 404);
        }

        // 2. Return the Submission
        return response()->json($submission);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Submission $submission)
    {
        // 1. Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string',
            'email' => 'sometimes|email',
            'message' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Update the submission record
        $submission->update($request->all());

        // 3. Return a success response
        return response()->json([
            'message' => 'Submission updated successfully!',
            'submission' => $submission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        // 1. Delete the submission record
        $submission->delete();

        // 2. Return a success response
        return response()->json(['message' => 'Submission deleted successfully!'], 200);
    }
}
