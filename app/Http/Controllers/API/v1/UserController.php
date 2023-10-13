<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $users = User::all();
        return new ApiSuccessResponse(
            $users,
            Response::HTTP_CREATED
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request) {
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'passwd' => bcrypt($request->password),
                'is_activated' => isset($request->is_activated) ? $request->is_activated : false,
                'cle_user' => isset($request->cle_user) ? $request->cle_user : null,
                'departement_id' => isset($request->departement_id) ? $request->departement_id : null,
                'usertype_id' => isset($request->usertype_id) ? $request->usertype_id : null,
            ]);
        } catch (Throwable $ex) {
            return new ApiErrorResponse(
                'An error occurred while trying to create the user',
                $ex
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
