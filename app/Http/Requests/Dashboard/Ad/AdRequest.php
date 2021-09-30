<?php

namespace App\Http\Requests\Dashboard\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
        $is_required = 'required';
        if($this->file_type == 'video'){
            $file = 'mimes:mp4,flv,m3u8,ts,3gp,mov,avi,wmv,ogx,oga,ogv,ogg,webm';
        }else{
            $file = 'image|mimes:jpeg,jpg,png,gif';
        }
        if($this->ad){
            $is_required = 'nullable';
        }
        return [
            'file' => $is_required . '|' . $file,
            'file_type' => 'required|in:video,image',
            'sponsor_id' => 'required|integer|exists:sponsors,id',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:' . now()->format('Y-m-d'),
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:' . $this->start_date,
            'url' => 'nullable',
            'desc' => 'nullable',
        ];
    }

     public function getValidatorInstance()
     {
         $data = $this->all();
         if (isset($data['start_date']) && $data['start_date'] != null) {
             $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
         }
         if (isset($data['end_date']) && $data['end_date'] != null) {
             $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));
         }
         $this->getInputSource()->replace($data);
         return parent::getValidatorInstance();
     }
}
