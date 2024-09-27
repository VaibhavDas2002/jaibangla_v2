

<form id="register_form" enctype="multipart/form-data" class="submit-once" action="{{ route('JBFormStore', ['scheme_id' => $scheme_id]) }}" method="post">
    {{ csrf_field() }}

    <div class="form-group col-md-12 applnDiv">
        <label class="applnlbl"><b>Applying for</b></label>
        @foreach(Config::get('constants.scheme_code') as $key => $desc)
            <label>
                @if($scheme_id == $key)
                    {{ $desc }}
                @endif
            </label>
        @endforeach
    </div>
    <div class="tab-content" style="margin-top:16px;">
        <x-common.personal-details :scheme_id="$scheme_id" :ds_phases="$ds_phases" />
        <x-common.personal-id-number :scheme_id="$scheme_id" />
        <x-common.contact-details :scheme_id="$scheme_id" :districts="$districts" />
        @if ($scheme_id == 17)
            <x-common.land-details :confirm_submit="$confirm_submit" />
        @endif
        <x-common.bank-acc-details :scheme_id="$scheme_id" />
        <x-common.enclosure-list :scheme_id="$scheme_id" :document_msg="$document_msg" :doc_list_man="$doc_list_man"
            :doc_list_opt="$doc_list_opt" :profile_img="$profile_img" />
        @if ($scheme_id == 17)
            <x-common.additional-details :scheme_id="$scheme_id" />
        @endif
        <x-common.self-decleration :scheme_id="$scheme_id" />
        <x-common.confirm-submission :scheme_id="$scheme_id" :profile_img="$profile_img" />
    </div>
</form>