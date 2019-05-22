<?php

namespace App\Http\Requests\Web\Booking;

use App\Http\Requests\Contracts\Booking\CreateBookingRequest as CreateBookingRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest implements CreateBookingRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            self::DATE                                     => 'required|date_format:Y-m-d',
            self::TIME                                     => 'required|date_format:H:i:s',
            self::CUSTOMER_NAME                            => 'required|string|min:1|max:64',
            self::CUSTOMER_PHONE                           => 'required|string|min:1|max:15',
            self::GUEST                                    => 'nullable|array',
            sprintf('%1s.*.%2s', self::GUEST, self::NAME)  => sprintf('required_with:%1s|string|min:1|max:64', self::GUEST),
            sprintf('%1s.*.%2s', self::GUEST, self::EMAIL) => sprintf('required_with:%1s|string|min:1|max:320', self::GUEST),
        ];
    }
}
