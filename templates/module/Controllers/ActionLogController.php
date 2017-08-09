<?php namespace $NAME$\ActionLog\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\ShowRequest;
use $NAME$\ActionLog\Requests\CreateActionLogRequest;
use $NAME$\ActionLog\Requests\UpdateActionLogRequest;
use $NAME$\ActionLog\Repositories\ActionLogRepository;
use Illuminate\Http\JsonResponse;
use zgldh\Scaffold\AppBaseController;

class ActionLogController extends AppBaseController
{

    public function __construct(ActionLogRepository $actionlogRepo)
    {
        $this->repository = $actionlogRepo;
        $this->middleware("auth");
    }

    /**
     * Display a listing of the ActionLog.
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
     * Store a newly created ActionLog in storage.
     *
     * @param CreateActionLogRequest $request
     * @return JsonResponse
     */
    public function store(CreateActionLogRequest $request)
    {
        $input = $request->all();

        $actionLog = $this->repository->create($input);
        $actionLog->load($request->getWith());

        return $this->sendResponse($actionLog, 'ActionLog saved successfully.');
    }

    /**
     * Display the specified ActionLog.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function show($id, ShowRequest $request)
    {
        $actionLog = $this->repository->findWithoutFail($id);
        $actionLog->load($request->getWith());

        if (empty($actionLog)) {
            return $this->sendError('ActionLog not found');
        }

        return $this->sendResponse($actionLog, '');
    }

    /**
     * Update the specified ActionLog in storage.
     *
     * @param  int $id
     * @param UpdateActionLogRequest $request
     *
     * @return JsonResponse
     */
    public function update($id, UpdateActionLogRequest $request)
    {
        $actionLog = $this->repository->findWithoutFail($id);

        if (empty($actionLog)) {
            return $this->sendError('ActionLog not found');
        }

        $actionLog = $this->repository->update($request->all(), $id);
        $actionLog->load($request->getWith());

        return $this->sendResponse($actionLog, 'ActionLog updated successfully.');
    }

    /**
     * Remove the specified ActionLog from storage.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $actionLog = $this->repository->findWithoutFail($id);

        if (empty($actionLog)) {
            return $this->sendError('ActionLog not found');
        }

        $this->repository->delete($id);
        return $this->sendResponse($actionLog, 'ActionLog deleted successfully.');
    }
}
