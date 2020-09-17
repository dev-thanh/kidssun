<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // public function __construct() {
    //     $this->redirect = route('home.post-recruitment', ['slug' => $slug, 'contactError' => 'true']);
    // }

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
            'name'      => 'required|min:5|max:50',
            'phone'     => 'required|numeric|regex:/(0)[0-9]{9}/',
            'email'     => 'required|email:rfc,dns,filter',
            'fileCV'    => 'required|mimes:docx,pdf|max:5120',
        ];
    }
    public function messages()
    {
        return [
            'name.required'     => trans('message.ban_chua_nhap_ho_ten'),
            'name.min'          => trans('message.ho_ten_khong_the_nho_hon_5_ki_tu'),
            'email.required'    => trans('message.ban_chua_nhap_email'),
            'email.email'       => trans('message.email_phai_la_mot_dia_chi_email_hop_le'),
            'email.rfc'         => trans('message.email_phai_la_mot_dia_chi_email_hop_le'),
            'email.dns'         => trans('message.email_phai_la_mot_dia_chi_email_hop_le'),
            'email.filter'      => trans('message.email_phai_la_mot_dia_chi_email_hop_le'),
            'phone.required'    => trans('message.ban_chua_nhap_so_dien_thoai'),
            'phone.regex'       => trans('message.so_dien_thoai_sai'),
            'phone.numeric'     => trans('message.so_dien_thoai_sai'),
            'fileCV.required'   => trans('message.ban_chua_upload_file'),
            'fileCV.mimes'      => trans('message.khong_dung_dinh_dang'),
            'fileCV.max'        => trans('message.dung_luong_file_qua_lon'),
        ];
    }
}
