<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Show the voting options and current vote counts
    public function index()
    {
        // Get vote counts for both options
        $optionA = Vote::where('option_name', 'Option A')->first();
        $optionB = Vote::where('option_name', 'Option B')->first();

        return view('welcome', compact('optionA', 'optionB'));
    }

    // Handle voting for Option A or Option B
    public function vote($option)
    {
        // Find the vote record for the selected option
        $vote = Vote::where('option_name', $option)->first();

        if ($vote) {
            $vote->increment('vote_count'); // Increment the vote count
            return response()->json(['vote_count' => $vote->vote_count]);
        }

        return response()->json(['message' => 'Option not found'], 404);
    }
}
