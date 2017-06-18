<?php namespace WoXuanWang\ActionLog\Controllers;

use App\Http\Requests\IndexRequest;
use App\Http\Requests\ShowRequest;
use WoXuanWang\ActionLog\Requests\CreateActionLogRequest;
use WoXuanWang\ActionLog\Requests\UpdateActionLogRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use WoXuanWang\ActionLog\Repositories\ActionLogRepository;
use Yajra\Datatables\Facades\Datatables;
use zgldh\Scaffold\AppBaseController;

class ActionLogController extends AppBaseController
{

    public function __construct(ActionLogRepository $actionlogRepo)
    {
        $this->repository = $actionlogRepo;
        $this->middleware("auth:admin");
    }

    /**
     * Display a listing of the ActionLog.
     *
     * @param IndexRequest $request
     * @return Response
     */
    public function index(IndexRequest $request)
    {
        if ($request->ajax()) {
            $with = $request->getWith();
            $data = $this->repository->datatables(null, $with);
            return $data;
        } else {
            return view('WoXuanWang\ActionLog::index');
        }
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

        $actionlog = $this->repository->create($input);

        return $this->sendResponse($actionlog, 'ActionLog saved successfully.');
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
        $this->repository->with($request->getWith());
        $actionlog = $this->repository->findWithoutFail($id);

        if (empty($actionlog)) {
            return $this->sendError('ActionLog not found');
        }

        return $this->sendResponse($actionlog, '');
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
        $actionlog = $this->repository->findWithoutFail($id);

        if (empty($actionlog)) {
            return $this->sendError('ActionLog not found');
        }

        $actionlog = $this->repository->update($request->all(), $id);

        return $this->sendResponse($actionlog, 'ActionLog updated successfully.');
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
        $actionlog = $this->repository->findWithoutFail($id);

        if (empty($actionlog)) {
            return $this->sendError('ActionLog not found');
        }

        $this->repository->delete($id);
        return $this->sendResponse($actionlog, 'ActionLog deleted successfully.');
    }
}
