<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MainService
{
    /**
     * @return array
     */
    public function getAllBookings(): array
    {
        $response = DB::select('SELECT e.name employee_name,cer.deactivated_at, cer.id,c.name client_name, r.name rend_name, if(r.status = 1, \'Занят\',\'Свободен\') rend_status, cer.created_at FROM laravel.client_employee_rent cer
                                    INNER JOIN employees e ON e.id = cer.employee_id
                                    INNER JOIN clients c ON cer.client_id = c.id
                                    INNER JOIN rents r ON cer.rent_id = r.id;');

        return $response;
    }

    /**
     * @param $request
     * @return Client
     */
    public function clientCreate($request): Client
    {
        $client = new Client();
        $client->name = $request->name;
        $client->save();

        return $client;
    }

    public function rentCreate($request): Rent
    {
        $rent = new Rent();
        $rent->name = $request->name;
        $rent->save();

        return $rent;
    }

    /**
     * @param $request
     * @return Employee
     */
    public function employeeCreate($request): Employee
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->save();

        return $employee;
    }

    /**
     * @param $request
     * @return bool
     */
    public function bookingCreate($request): bool
    {
        $nowTime = Carbon::now()->toDateTimeString();
        /** @var Rent $rentActive */
        $rentActive = Rent::active()->where('id', $request->rent_id)->first();
        if (!is_null($rentActive)) {
            $rentActive->status = 1;
            $rentActive->save();
            DB::select("INSERT INTO client_employee_rent (employee_id, client_id, rent_id, created_at) VALUES ($request->employee_id, $request->client_id, $request->rent_id, '$nowTime' )");
        }
        return true;
    }

    /**
     * @param $request
     * @return bool
     */
    public function bookingClosing($request): bool
    {
        DB::table('client_employee_rent')
            ->where('id', '=', $request->id)
            ->update(['deactivated_at' => Carbon::now()->toDateTimeString()]);

        $rentId = DB::select("SELECT rent_id FROM client_employee_rent WHERE id=$request->id");

        Rent::query()->find($rentId[0]->rent_id)->update([
            'status' => 0
        ]);

        return true;
    }

    /**
     * @param $modal
     * @return string
     */
    public function getDataJsonResponse(string $modal): string
    {
        return 'The ' . $modal . ' successfully added';
    }

    /**
     * @param $request
     * @return array
     */
    public function showBooking($request): array
    {
        $booking = DB::select("SELECT * FROM client_employee_rent WHERE id=$request->id LIMIT 1");
        $clientId = $booking[0]->client_id;
        $employeeId = $booking[0]->employee_id;
        $rentId = $booking[0]->rent_id;

        $clients = DB::select("SELECT * FROM clients ORDER BY FIELD(ID,$clientId) DESC");
        $employees = DB::select("SELECT * FROM employees ORDER BY FIELD(ID,$employeeId) DESC");
        $rents = DB::select("SELECT * FROM rents ORDER BY FIELD(ID,$rentId) DESC");

        $response = ['employees' => $employees, 'rents' => $rents, 'clients' => $clients];

        return $response;
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function updateBookingService($request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request){
                $rentId = DB::select("SELECT rent_id FROM client_employee_rent WHERE id=$request->id LIMIT 1");

                Rent::query()->find($rentId[0]->rent_id)->update([
                    'status' => 0
                ]);

                DB::select("UPDATE client_employee_rent SET client_id=$request->client_id, rent_id=$request->rent_id, employee_id=$request->employee_id WHERE id=$request->id");

                Rent::query()->find($request->rent_id)->update([
                    'status' => 1
                ]);
            });
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['status' => 'success'], Response::HTTP_OK);
    }
}
