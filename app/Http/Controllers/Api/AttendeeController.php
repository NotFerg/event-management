<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendee;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        $attendees = $event->attendees()->latest()->paginate();

        return AttendeeResource::collection($attendees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Event $event)
    {
        $attendees = $event->attendees()->create([
            'user_id' => 1,
        ]);

        return new AttendeeResource($attendees);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, Attendee $attendee)
    {
        return new AttendeeResource($attendee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $event, Attendee $attendee)
    {
        $attendee->delete();

        return response(status:204);
    }
}
