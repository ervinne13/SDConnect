<?php

namespace App\Http\Controllers\Modules\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\System\GroupRequest;
use App\Modules\System\Group\Group;
use App\Modules\System\Group\Repository\GroupRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use function response_ajax_error;
use function view;

class GroupController extends Controller
{

    /** @var GroupRepository */
    protected $groupRepo;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepo = $groupRepo;
        $this->groupRepo->eagerLoadsRelationships(['owner']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('pages.user.group.index', [
            "groups" => $this->groupRepo->accessibleByUserAccount(Auth::user())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $group = new Group();
        $group->setColor("#EDF0F5");

        return view('pages.user.group.form', [
            "group"      => $group,
            "groupTypes" => $this->groupRepo->getTypes()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupRequest  $request
     * @return Response
     */
    public function store(GroupRequest $request)
    {
        try {
            $group = $request->getRequestModel();
            $group->setOwner(Auth::user());
            $this->groupRepo->create($group);

            return $group;
        } catch ( Exception $ex ) {
            return response_ajax_error($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $groupCode
     * @return Response
     */
    public function show($groupCode)
    {
        $group = $this->groupRepo->find($groupCode);

        if ( !$group ) {
            throw new NotFoundResourceException("Unable to find group {$groupCode}");
        }

        $members = $this->groupRepo->getMembers($group);

        return view('pages.user.group.group', [
            "group"   => $group,
            "members" => $members
        ]);
    }

    /**
     * Show the form for editing the specified resource.     
     * @param type $groupCode
     * @return Response
     */
    public function edit($groupCode)
    {
        $group = $this->groupRepo->find($groupCode);
        return view('pages.user.group.form', [
            "group"      => $group,
            "groupTypes" => $this->groupRepo->getTypes()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GroupRequest  $request
     * @param type $groupCode
     * @return Response
     */
    public function update(GroupRequest $request, $groupCode)
    {
        try {
            $group = $request->getRequestModel();
            return $this->groupRepo->update($group, $groupCode);
        } catch ( Exception $ex ) {
            return response_ajax_error($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *      
     * @param type $groupCode
     */
    public function destroy($groupCode)
    {
        try {
            $this->groupRepo->delete($groupCode);
        } catch ( Exception $ex ) {
            return response_ajax_error($ex);
        }
    }

}
