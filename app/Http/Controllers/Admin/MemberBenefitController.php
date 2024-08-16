<?php

namespace App\Http\Controllers\admin;

use App\Traits\ImageTraits;
use Illuminate\Http\Request;
use App\Models\MemberBenefit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\admin\membership\member_benefit\UpdateMemberBenefitRequest;

class MemberBenefitController extends Controller
{
    use ImageTraits;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('membership');

        $main = MemberBenefit::where('type', 'main')->first();

        $data['main'] = $main;

        return view('admin.membership.member_benefit.index', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberBenefitRequest $request)
    {
        $this->authorize('membership_edit');

        $validated = $request->validated();

        $fileName = $validated['old_file'] ?? null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $fileName = $file->store('membership/member_benefit', 'public');

            if ($request->filled('old_file')) {
                $this->deleteFromStorage('public', $validated['old_file'], $isArray = false);
            }
        }
        $validated['file'] = $fileName;

        DB::transaction(function () use ($validated) {
            MemberBenefit::updateOrCreate(
                ['type' => $validated['type']],
                ['title' => $validated['title'], 'content' => $validated['content'], 'file' => $validated['file']]
            );
        });

        return redirect()->route('admin.membership.member-benefit')->with('success', 'Member Benefit updated successfully');
    }
}
