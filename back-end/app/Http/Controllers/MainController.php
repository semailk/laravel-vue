<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Rent;
use App\Services\MainService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * @var MainService
     */
    private $mainService;

    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->mainService->getAllBookings(), Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addClient(Request $request): JsonResponse
    {
        $this->mainService->clientCreate($request);

        return response()->json($this->mainService->getDataJsonResponse('client'), Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addEmployee(Request $request): JsonResponse
    {
        $this->mainService->employeeCreate($request);

        return response()->json($this->mainService->getDataJsonResponse('employee'), Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addRent(Request $request): JsonResponse
    {
        $this->mainService->rentCreate($request);

        return response()->json($this->mainService->getDataJsonResponse('rent'), Response::HTTP_CREATED);
    }

    public function booking(Request $request): JsonResponse
    {
        $this->mainService->bookingCreate($request);

        return response()->json($this->mainService->getDataJsonResponse('booking'), Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     */
    public function getAllTables(): JsonResponse
    {
        $response = ['employees' => Employee::all(), 'rents' => Rent::active()->get(), 'clients' => Client::all()];

        return \response()->json($response, Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function closeBooking(Request $request): JsonResponse
    {
        $this->mainService->bookingClosing($request);

        return response()->json(['status' => 'success'], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function editBooking(Request $request): array
    {
        return $this->mainService->showBooking($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteBooking(Request $request): JsonResponse
    {
        DB::select("DELETE FROM client_employee_rent WHERE id=$request->id");

        return \response()->json('delete', Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateBooking(Request $request): JsonResponse
    {
        return $this->mainService->updateBookingService($request);
    }
}
