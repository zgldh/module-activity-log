<?php namespace $NAME$\ActivityLog\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\ShowRequest;
use $NAME$\ActivityLog\Requests\CreateActivityLogRequest;
use $NAME$\ActivityLog\Requests\UpdateActivityLogRequest;
use $NAME$\ActivityLog\Repositories\ActivityLogRepository;
use Illuminate\Http\JsonResponse;
use zgldh\Scaffold\AppBaseController;

class ActivityLogController extends AppBaseController
{

    public function __construct(ActivityLogRepository $activitylogRepo)
    {
        $this->repository = $activitylogRepo;
        $this->middleware("auth");
    }

    /**
     * Display a listing of the ActivityLog.
     *
     * @param IndexRequest $request
     * @return Response
     */
    public function index(IndexRequest $request)
    {
        $with = $request->getWith();
        $data = $this->repository->datatables(null, $with);
        return $data;
    }

    /**
     * Store a newly created ActivityLog in storage.
     *
     * @param CreateActivityLogRequest $request
     * @return JsonResponse
     */
    public function store($request)
    {
    }

    /**
     * Display the specified ActivityLog.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function show($id, ShowRequest $request)
    {
        $activityLog = $this->repository->findWithoutFail($id);
        $activityLog->load($request->getWith());

        if (empty($activityLog)) {
            return $this->sendError('ActivityLog not found');
        }

        return $this->sendResponse($activityLog, '');
    }

    /**
     * Update the specified ActivityLog in storage.
     *
     * @param  int $id
     * @param UpdateActivityLogRequest $request
     *
     * @return JsonResponse
     */
    public function update($id, $request)
    {
    }

    /**
     * Remove the specified ActivityLog from storage.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
    }
}
