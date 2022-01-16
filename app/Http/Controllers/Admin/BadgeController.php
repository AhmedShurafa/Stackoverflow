<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::get();
        return view('dashboard.badges.index',compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $badge = new Badge();
        return view('dashboard.badges.create',compact('badge'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|unique:badges,name',
            'type' => 'required|min:1',
            'score' => 'required|numeric',
            'content' => 'required|min:3',
        ]);

        Badge::create($request->all());

        session()->flash('success','Created Badge Successfully');
        return redirect()->route('badges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function show(Badge $badge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function edit(Badge $badge)
    {
        return view('dashboard.badges.edit',compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Badge $badge)
    {
        $request->validate([
            'name' => 'required|min:1|unique:badges,name,'.$badge->id,
            'type' => 'required|min:1',
            'score' => 'required|numeric',
            'content' => 'required|min:3',
        ]);

        $badge->update($request->all());

        session()->flash('success','Updated Badge Successfully');
        return redirect()->route('badges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\Badge  $badge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Badge $badge)
    {
        $badge->delete();

        session()->flash('success','Deleted Badge Successfully');
        return redirect()->route('badges.index');
    }
}
