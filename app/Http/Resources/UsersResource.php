<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'username'=>$this->username,
            'address'=>$this->address,
            'phone '=>$this->phone,
            'email'=>$this->email,
            'password'=>$this->password,
            'userType'=>$this->userType,
            'remember_token'=>$this->remember_token
        ];
    }
}
