<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Config;
use Livewire\Component;
use App\Models\District;
use App\Models\DocumentType;
use App\Models\SchemeDocMap;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class GenericForm extends Component
{
    public $scheme_id;
    public $districts;
    public $document_msg = '';
    public $doc_profile_image_id = 999; // Set default as 999
    public $doc_list_man = [];
    public $doc_list_opt = [];
    public $is_active = 0;
    public $confirm_submit = 0;

    public function mount($scheme_id)
    {
        $this->scheme_id = $scheme_id;
        $this->districts = District::select(['district_code', 'district_name'])->get();
        $this->document_msg = '';
        $doc_profile_image = DocumentType::where('is_profile_pic', true)->first();
        if ($doc_profile_image) {
            $this->doc_profile_image_id = $doc_profile_image->id;
        }
        $doc_id_list = SchemeDocMap::select('doc_list_man', 'doc_list_opt', 'doc_list_man_group')
            ->where('scheme_code', $scheme_id)
            ->first();

        if ($doc_id_list) {
            $this->doc_list_man = !empty($doc_id_list->doc_list_man)
                ? DocumentType::select('id', 'doc_size_kb', 'doc_name', 'doc_type', 'doucument_group')
                    ->whereIn('id', json_decode($doc_id_list->doc_list_man))
                    ->get()
                    ->toArray()
                : [];

            $this->doc_list_opt = !empty($doc_id_list->doc_list_opt)
                ? DocumentType::select('id', 'doc_size_kb', 'doc_name', 'doc_type', 'doucument_group')
                    ->whereIn('id', json_decode($doc_id_list->doc_list_opt))
                    ->get()
                    ->toArray()
                : [];

            $doc_list_man_group = !empty($doc_id_list->doc_list_man_group)
                ? json_decode($doc_id_list->doc_list_man_group)
                : [];

            if (count($doc_list_man_group) > 0) {
                $this->generateDocumentMsg($doc_list_man_group);
            }
        }
    }

    private function generateDocumentMsg($doc_list_man_group)
    {
        $all_doc_id = array_merge(
            array_column($this->doc_list_man, 'id'),
            array_column($this->doc_list_opt, 'id')
        );

        foreach ($doc_list_man_group as $man_group) {
            $heading_msg = "At least one document must be uploaded for ";
            $doucument_group_name = $this->getGroupName($man_group);
            $heading_msg .= '<span style="color:red;font-weight:bold">' . $doucument_group_name . '</span>';

            $this->document_msg .= "<div class='form-group col-md-12'>";
            $this->document_msg .= "<p style='font-weight:bold;font-size:17px;'>" . $heading_msg . "</p>";
            $this->document_msg .= "<ul>";

            $results = DB::select("
                SELECT doc_name 
                FROM m_attached_doc 
                WHERE id IN (" . implode(',', $all_doc_id) . ") 
                  AND ? = ANY (doucument_group)
            ", [$man_group]);

            foreach ($results as $requiredmsg) {
                $this->document_msg .= "<li style='font-weight:bold;'>" . $requiredmsg->doc_name . "</li>";
            }

            $this->document_msg .= "</ul>";
            $this->document_msg .= "</div>";
        }
    }

    private function getGroupName($groupId)
    {
        $groupArr = Config::get('constants.document_group', []);
        return $groupArr[$groupId] ?? 'NA';
    }

    public function confirm()
    {
        // $this->confirm_submit = 1;
        // $this->dispatch('show-submissions-modal', confirmSubmitId: $this->confirm_submit);
    }

    public function render()
    {
        return view('livewire.generic-form', [
            'scheme_id' => $this->scheme_id,
            'confirm_submit' => $this->confirm_submit,
            'districts' => $this->districts,
            'document_msg' => $this->document_msg,
            'doc_list_man' => $this->doc_list_man,
            'doc_list_opt' => $this->doc_list_opt,
            'profile_img' => $this->doc_profile_image_id,
        ]);
    }
}
