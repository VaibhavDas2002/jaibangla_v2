<form method="post" id="register_form" action="{{url('pensionform')}}" enctype="multipart/form-data"
    class="submit-once">
    {{ csrf_field() }}
    <div class="tab-content" style="margin-top:16px;">

        <x-common.personal-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
        <x-common.personal-id-number :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
        <x-common.contact-details :scheme_id="$scheme_id" :districts="$districts" :confirm_submit="$confirm_submit" />
        @if ($scheme_id == 17)
            <x-common.land-details :confirm_submit="$confirm_submit" />
        @endif
        <x-common.bank-acc-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
        <x-common.enclosure-list :scheme_id="$scheme_id" :document_msg="$document_msg" :doc_list_man="$doc_list_man"
            :doc_list_opt="$doc_list_opt" :profile_img="$profile_img" :confirm_submit="$confirm_submit" />
        @if ($scheme_id == 17)
            <x-common.additional-details :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
        @endif
        <x-common.self-decleration :scheme_id="$scheme_id" :confirm_submit="$confirm_submit" />
        <x-common.confirm-submission :scheme_id="$scheme_id" :profile_img="$profile_img"/>
   

    </div>

</form>