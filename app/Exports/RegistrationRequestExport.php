<?php

namespace App\Exports;

use App\Models\RegistrationRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationRequestExport implements FromCollection, WithHeadings
{
    protected $event_id;

    public function __construct($event_id)
    {
        $this->event_id = $event_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RegistrationRequest::join('event_registration_request','event_registration_request.registration_request_id','registration_request.id')
                            ->where('event_registration_request.event_id', $this->event_id)
                            ->get(['fname','lname','designation','organization','mobile','email','pickup_address']);

        //return RegistrationRequest::all();
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Designation',
            'Organization',
            'Mobile',
            'Email',
            'Pickup Address'
        ];
    }
}
