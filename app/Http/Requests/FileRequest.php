<?php

namespace App\Http\Requests;

use App\Models\Table;
use App\Models\UserFile;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $count = UserFile::query()
                        ->where('file_id', $this->id)
                        ->where('user_id', Auth::id())
                        ->count();
                    if( $count == 0 ){
                        $fail("File not found.");
                    }
                }
                ],
        ];
    }
}
