<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\membership\member_benefit\StoreMemberBenefitRequest;
use App\Http\Requests\admin\membership\member_benefit\UpdateMemberBenefitRequest;
use App\Http\Requests\admin\membership\member_benefit\UpdateMemberBenefitStatusRequest;
use App\Models\MemberBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class MemberBenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('membership');

        $filterValues = [
            'name' => $request->name ?? null,
            'status' => $request->status ?? null,
        ];
        $list = MemberBenefit::orderBy('id', 'desc')
            ->where(function (Builder $query) use ($filterValues, $request) {
                $query->when($request->filled('name'), function (Builder $q) use ($filterValues) {
                    $q->where('name', 'like', '%' . $filterValues['name'] . '%');
                })
                    ->when($request->filled('status'), function (Builder $q) use ($filterValues) {
                        $q->where('status', $filterValues['status']);
                    });
            })
            ->get();

        $data['filterValues'] = $filterValues;
        $data['list'] = $list;
        $data['export_id'] = $list->pluck('id')->toArray();

        return view('admin.membership.member_benefit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('membership_create');

        return view('admin.membership.member_benefit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberBenefitRequest $request)
    {
        $this->authorize('membership_create');

        $validated = $request->validated();

        DB::transaction(function () use ($validated) {
            MemberBenefit::create([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.membership.member-benefit.index')->with('success', 'Member Benefit  created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MemberBenefit $member_benefit)
    {
        $this->authorize('membership_view');

        $data['member_benefit'] = $member_benefit;

        return view('admin.membership.member_benefit.view', $member_benefit);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MemberBenefit $member_benefit)
    {
        $this->authorize('membership_edit');

        $data['member_benefit'] = $member_benefit;

        return view('admin.membership.member_benefit.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberBenefitRequest $request, MemberBenefit $member_benefit)
    {
        $this->authorize('membership_edit');

        $validated = $request->validated();

        DB::transaction(function () use ($member_benefit, $validated) {
            $member_benefit->update([
                'name' => $validated['name'],
                'status' => $validated['status'],
            ]);
        });

        return redirect()->route('admin.membership.member-benefit.index')->with('success', 'Member Benefit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberBenefit $member_benefit)
    {
        $this->authorize('membership_delete');

        DB::transaction(function () use ($member_benefit) {
            $member_benefit->delete();
        });

        $data['error'] = false;
        $data['msg'] = 'Member Benefit Deleted';

        return response()->json($data, 200);
    }

    public function statusToggle(UpdateMemberBenefitStatusRequest $request)
    {
        $this->authorize('membership_status_edit');

        $validated = $request->validated();

        $typeData = MemberBenefit::find($validated['lid']);
        $status = $validated['lstatus'] == 1 ? '0' : '1';

        DB::transaction(function () use ($typeData, $status) {
            $typeData->update([
                'status' => $status
            ]);
        });

        $data['error'] = false;
        $data['msg'] = 'Member Benefit status updated';

        return response()->json($data, 200);
    }
}
